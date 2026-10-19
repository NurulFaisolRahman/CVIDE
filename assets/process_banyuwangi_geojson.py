import urllib.request
import json
import os
import math

os.makedirs('assets/geojson', exist_ok=True)
url = 'https://raw.githubusercontent.com/JfrAziz/indonesia-district/master/id35_jawa_timur/id3510_banyuwangi/id3510_banyuwangi.geojson'
print('Downloading raw GeoJSON...')
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
with urllib.request.urlopen(req) as resp:
    raw_content = resp.read().decode('utf-8')
    data = json.loads(raw_content)

print(f"Total features loaded: {len(data.get('features', []))}")

# Palet warna tematik harmonis untuk 25 kecamatan Banyuwangi
colors = [
    '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
    '#EC4899', '#06B6D4', '#84CC16', '#F97316', '#6366F1',
    '#14B8A6', '#D946EF', '#EAB308', '#64748B', '#0EA5E9',
    '#22C55E', '#A855F7', '#F43F5E', '#38BDF8', '#4ADE80',
    '#FB923C', '#818CF8', '#2DD4BF', '#F472B6', '#A3E635'
]

# Kelompokkan data per kecamatan
districts = {}
color_idx = 0

for feat in data['features']:
    props = feat['properties']
    dist = props.get('district', 'Lainnya')
    geom = feat.get('geometry', {})
    
    if dist not in districts:
        districts[dist] = {
            'district_code': props.get('district_code'),
            'regency': props.get('regency', 'Banyuwangi'),
            'province': props.get('province', 'Jawa Timur'),
            'color': colors[color_idx % len(colors)],
            'villages': [],
            'polygons': []
        }
        color_idx += 1
        
    vill = props.get('village')
    if vill and vill not in districts[dist]['villages']:
        districts[dist]['villages'].append(vill)
        
    # Kumpulkan koordinat poligon
    if geom.get('type') == 'Polygon':
        districts[dist]['polygons'].append(geom.get('coordinates', []))
    elif geom.get('type') == 'MultiPolygon':
        for poly in geom.get('coordinates', []):
            districts[dist]['polygons'].append(poly)

# Buat FeatureCollection Kecamatan Banyuwangi
kecamatan_features = []
districts_meta = {}

for dist_name, dist_info in sorted(districts.items()):
    # Hitung centroid sederhana dan bounding box
    all_coords = []
    for poly in dist_info['polygons']:
        for ring in poly:
            for pt in ring:
                if len(pt) >= 2:
                    all_coords.append(pt)
    
    if all_coords:
        min_lng = min(pt[0] for pt in all_coords)
        max_lng = max(pt[0] for pt in all_coords)
        min_lat = min(pt[1] for pt in all_coords)
        max_lat = max(pt[1] for pt in all_coords)
        center_lng = sum(pt[0] for pt in all_coords) / len(all_coords)
        center_lat = sum(pt[1] for pt in all_coords) / len(all_coords)
    else:
        min_lng = max_lng = center_lng = 114.36
        min_lat = max_lat = center_lat = -8.21

    districts_meta[dist_name] = {
        'district_code': dist_info['district_code'],
        'color': dist_info['color'],
        'center': [round(center_lat, 6), round(center_lng, 6)],
        'bounds': [[round(min_lat, 6), round(min_lng, 6)], [round(max_lat, 6), round(max_lng, 6)]],
        'total_desa': len(dist_info['villages']),
        'villages': sorted(dist_info['villages'])
    }
    
    # Buat geometri MultiPolygon untuk kecamatan
    geom_type = 'MultiPolygon' if len(dist_info['polygons']) > 1 else 'Polygon'
    coords = dist_info['polygons'] if geom_type == 'MultiPolygon' else dist_info['polygons'][0]

    feature = {
        'type': 'Feature',
        'properties': {
            'district': dist_name,
            'district_code': dist_info['district_code'],
            'regency': dist_info['regency'],
            'province': dist_info['province'],
            'color': dist_info['color'],
            'center': [round(center_lat, 6), round(center_lng, 6)],
            'bounds': [[round(min_lat, 6), round(min_lng, 6)], [round(max_lat, 6), round(max_lng, 6)]],
            'total_desa': len(dist_info['villages']),
            'villages': sorted(dist_info['villages'])
        },
        'geometry': {
            'type': geom_type,
            'coordinates': coords
        }
    }
    kecamatan_features.append(feature)

# Output GeoJSON Kecamatan
output_geojson = {
    'type': 'FeatureCollection',
    'name': 'Batas_Kecamatan_Kabupaten_Banyuwangi',
    'crs': { 'type': 'name', 'properties': { 'name': 'urn:ogc:def:crs:OGC:1.3:CRS84' } },
    'features': kecamatan_features
}

output_path = 'assets/geojson/banyuwangi_kecamatan_real.geojson'
with open(output_path, 'w', encoding='utf-8') as f:
    json.dump(output_geojson, f, ensure_ascii=False)

# Simpan juga metadata kecamatan & desa untuk lookup cepat (dropdown dinamis form survei dll)
meta_path = 'assets/geojson/banyuwangi_districts_meta.json'
with open(meta_path, 'w', encoding='utf-8') as f:
    json.dump(districts_meta, f, ensure_ascii=False, indent=2)

file_size_kb = os.path.getsize(output_path) / 1024
print(f"Success! Created {output_path} ({file_size_kb:.2f} KB) with {len(kecamatan_features)} districts.")
print(f"Created metadata at {meta_path} with {len(districts_meta)} districts.")
