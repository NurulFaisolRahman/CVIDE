<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>IDE Consultant</title>
  <!-- Favicons -->
  <link href="../assets/img/favicon.ico" rel="icon">
  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">
  <!-- <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet"> -->
  <!-- Template Main CSS File -->
  <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mt-2">
          <div class="card-header bg-primary text-light">
            <b>Lokasi Responden</b>
          </div>
          <div style="background-color: yellow;" class="card-body border border-primary">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Nomor KK</b></label>
                    </div>
                    <input class="form-control" type="text" id="NomorKK" placeholder="Nomor KK">
                  </div>
                </div> 
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Provinsi</b></label>
                    </div>
                    <select class="custom-select" id="Provinsi">  
                      <?php foreach ($Provinsi as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                      <?php } ?>                  
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Kabupaten</b></label>
                    </div>
                    <select class="custom-select" id="Kabupaten">                    
                      <?php foreach ($Kabupaten as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                      <?php } ?>                  
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Kecamatan</b></label>
                    </div>
                    <select class="custom-select" id="Kecamatan">  
                      <?php foreach ($Kecamatan as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                      <?php } ?>                  
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Desa/Kelurahan</b></label>
                    </div>
                    <select class="custom-select" id="Desa">                    
                      <?php foreach ($Desa as $key) { ?>
                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                      <?php } ?>                  
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Dusun</b></label>
                    </div>
                    <input class="form-control" type="text" id="Dusun" placeholder="Nama Dusun">
                  </div>
                </div>
                <div class="col-sm-2 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>RT</b></label>
                    </div>
                    <input class="form-control" type="text" id="RT" placeholder="Nomor RT">
                  </div>
                </div>
                <div class="col-sm-2 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>RW</b></label>
                    </div>
                    <input class="form-control" type="text" id="RW" placeholder="Nomor RW">
                  </div>
                </div>
                <div class="col-sm-8 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Alamat</b></label>
                    </div>
                    <input class="form-control" type="text" id="Alamat" placeholder="Alamat">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <div class="card">
          <div class="card-header bg-primary text-light">
            <b>Informasi Anggota Keluarga (Ditanyakan Untuk Semua Anggota Keluarga)</b>
          </div>
          <div style="background-color: yellow;" class="card-body border border-primary">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-12">
                  <div class="table-resp'ons'ive mt-1">
                    <table id="TabelSurveyor" class="table table-bordered table-striped">
                      <thead class="bg-success">
                        <tr class="text-light">
                          <th class="text-center align-middle">No</th>
                          <th class="align-middle">Nama</th>
                          <th class="align-middle">Status</th>
                          <th class="align-middle">Jenis Kelamin</th>
                          <th class="align-middle">Usia</th>
                          <th class="text-center align-middle">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="KK"></tbody>
                    </table>
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>NIK</b></label>
                    </div>
                    <input class="form-control" type="text" id="NIK" placeholder="Nomor Induk Keluarga">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Nama Anggota</b></label>
                    </div>
                    <input class="form-control" type="text" id="NamaAnggota">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Jenis Kelamin</b></label>
                    </div>
                    <select class="custom-select" id="Gender">                    
                      <option value="1">Laki-Laki</option>
                      <option value="2">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Usia</b></label>
                    </div>
                    <input class="form-control" type="text" id="Usia">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Status Anggota</b></label>
                    </div>
                    <select class="custom-select" id="StatusAnggota">                    
                      <option value="1">Suami</option>
                      <option value="2">Istri</option>
                      <option value="3">Anak Ke 1</option>
                      <option value="4">Anak Ke 2</option>
                      <option value="5">Anak Ke 3</option>
                      <option value="6">Anak Ke 4</option>
                      <option value="7">Anak Ke 5</option>
                      <option value="8">Anak Ke 6</option>
                      <option value="9">Anak Ke 7</option>
                      <option value="10">Anak Ke 8</option>
                      <option value="11">Anak Ke 9</option>
                      <option value="12">Anak Ke 10</option>
                      <option value="13">Anak Ke 11</option>
                      <option value="14">Anak Ke 12</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Status Perkawinan</b></label>
                    </div>
                    <select class="custom-select" id="StatusPerkawinan">                    
                      <option value="1">Belum Kawin</option>
                      <option value="2">Kawin</option>
                      <option value="3">Cerai Hidup</option>
                      <option value="4">Cerai Mati</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Pendapatan Bersih Per Bulan</b></label>
                    </div>
                    <input class="form-control" type="text" id="Pendapatan">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Pekerjaan</b></label>
                    </div>
                    <select class="custom-select" id="Pekerjaan">         
                      <option value="11">Tidak Bekerja</option>           
                      <option value="1">Pegawai level bawah (staff, Pegawai negeri gol II, Tentara gol letnan bawah)</option>
                      <option value="2">Pegawai golongan menengah (Kabag,Manager,Direktur,PNS gol III Keatas,Tentara Pangkat Kapten Keatas,Dosen)</option>
                      <option value="3">Profesional (Dokter, Pengacara, Notaris, Seniman dll)</option>
                      <option value="4">Wiraswasta / Pedagang Besar (Karyawan > 10 orang)</option>
                      <option value="5">Wiraswasta / Pedagang Besar (Karyawan > 10 orang)</option>
                      <option value="6">Mahasiswa / Pelajar</option>
                      <option value="7">Pekerja Terlatih (Salesman, Teknisi, montir, Tukang bangunan, tukang kayu, dll)</option>
                      <option value="8">Pekerjaan tidak terlatih (Buruh tani, tukang becak, penjaga toko dll)</option>
                      <option value="9">Pemilik usaha (Petani, petambak, Peternak dll)</option>
                      <option value="10">Pensiunan</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Jenis Pekerjaan</b></label>
                    </div>
                    <select class="custom-select" id="JenisPekerjaan">         
                      <option value="1">Tidak Bekerja</option>           
                      <option value="2">Berusaha Sendiri</option>
                      <option value="3">Dibantu Buruh Tidak Tetap / Tidak Dibayar</option>
                      <option value="4">Dibantu Buruh Tidak Tetap / Dibayar</option>
                      <option value="5">Buruh / Karyawan / Pegawai</option>           
                      <option value="6">Pekerja Bebas Di Pertanian</option>
                      <option value="7">Pekerja Bebas Di Non Pertanian</option>
                      <option value="8">Pekerja Keluarga/Tidak Dibayar</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Jam Kerja</b></label>
                    </div>
                    <select class="custom-select" id="JamKerja">    
                      <?php for ($i=0; $i < 25; $i++) { ?>
                        <option value="<?=$i?>"><?=$i.' Jam'?></option>           
                      <?php } ?>          
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Keahlian Yang Dimiliki</b></label>
                    </div>
                    <input class="form-control" type="text" id="Keahlian">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Kegiatan Seminggu Lalu</b></label>
                    </div>
                    <select class="custom-select" id="KegiatanSeminggu">         
                      <option value="1">Tidak Bekerja</option>  
                      <option value="2">Bekerja</option>           
                      <option value="3">Bersekolah</option>
                      <option value="4">Mengurus Rumah Tangga</option>
                      <option value="5">Mencari Pekerjaan</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Alasan Mencari Kerja</b></label>
                    </div>
                    <select class="custom-select" id="AlasanMencariKerja">         
                      <option value="1">Tamat Sekolah</option>           
                      <option value="2">Mencari Nafkah</option>
                      <option value="3">Alasan Lainnya</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-8 my-1">
                  <div class="input-group">
                    <input class="form-control" type="text" id="AlasanMencariKerjaLainnya" placeholder="Sebutkan Jika Alasan Lainnya">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Lokasi Bekerja</b></label>
                    </div>
                    <select class="custom-select" id="LokasiKerja">         
                      <option value="1">Dalam Kabupaten</option>           
                      <option value="2">Luar Kabupaten</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-8 my-1">
                  <div class="input-group">
                    <input class="form-control" type="text" id="AlasanLokasiBekerja" placeholder="Alasan Jika Bekerja Diluar Kabupaten">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Pertolongan Saat Di Lahirkan</b></label>
                    </div>
                    <select class="custom-select" id="PertolonganKelahiran">                    
                      <option value="1">Dokter</option>
                      <option value="2">Bidan</option>
                      <option value="3">Tenaga Medis Lainnya</option>
                      <option value="4">Dukun Bersalin</option>
                      <option value="5">Family</option>
                      <option value="6">lainnya</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Memiliki Kartu jaminan Kesehatan</b></label>
                    </div>
                    <select class="custom-select" id="KJK">                    
                      <option value="0">NA</option>
                      <option value="1">BPJS</option>
                      <option value="2">Jamkesda</option>
                      <option value="3">Asuransi Swasta</option>
                      <option value="4">lainnya</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Pernah diberi ASI</b></label>
                    </div>
                    <select class="custom-select" id="Asi">                    
                      <option value="1">Ya</option>
                      <option value="2">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Pernah mendapat Imunisasi</b></label>
                    </div>
                    <select class="custom-select" id="Imunisasi">                    
                      <option value="1">Ya</option>
                      <option value="2">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Partisipasi Sekolah</b></label>
                    </div>
                    <select class="custom-select" id="PartisipasiSekolah">                    
                      <option value="1">Tidak Pernah Sekolah</option>
                      <option value="2">Masih Sekolah</option>
                      <option value="3">Tidak Sekolah Lagi</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Pendidikan Tertinggi</b></label> 
                    </div>
                    <select class="custom-select" id="PendidikanTertinggi">                    
                      <option value="1">SD/SDLB</option>
                      <option value="2">MI</option>
                      <option value="3">Paket A</option>
                      <option value="4">SMP/SMLB</option>
                      <option value="5">M.Ts</option>
                      <option value="6">Paket B</option>
                      <option value="7">SMA/SMLB</option>
                      <option value="8">MA</option>
                      <option value="9">SMK</option>
                      <option value="10">Paket C</option>
                      <option value="11">D1</option>
                      <option value="12">D2</option>
                      <option value="13">D3</option>
                      <option value="14">D4/S1</option>
                      <option value="15">S2</option>
                      <option value="16">S3</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Kelas Yang Pernah/Sedang Diduduki</b></label>
                    </div>
                    <select class="custom-select" id="StatusSekolah">                    
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">Tamat</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Santri Aktif</b></label>
                    </div>
                    <select class="custom-select" id="Santri">                    
                      <option value="1">Ya</option>
                      <option value="2">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Ijazah Tertinggi</b></label>
                    </div>
                    <select class="custom-select" id="IjazahTertinggi">                    
                      <option value="1">Tdk Punya Ijazah</option>
                      <option value="2">SD/SDLB</option>
                      <option value="3">MI</option>
                      <option value="4">Paket A</option>
                      <option value="5">SMP/SMLB</option>
                      <option value="6">M.Ts</option>
                      <option value="7">Paket B</option>
                      <option value="8">SMA/SMLB</option>
                      <option value="9">MA</option>
                      <option value="10">SMK</option>
                      <option value="11">Paket C</option>
                      <option value="12">D1</option>
                      <option value="13">D2</option>
                      <option value="14">D3</option>
                      <option value="15">D4/S1</option>
                      <option value="16">S2</option>
                      <option value="17">S3</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Bisa Baca Tulis</b></label>
                    </div>
                    <select class="custom-select" id="BacaTulis">                    
                      <option value="1">Huruf Latin</option>
                      <option value="2">Huruf Arab</option>
                      <option value="3">Huruf Lain</option>
                      <option value="4">All</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>SD</b></label>
                    </div>
                    <input class="form-control" type="text" id="SD" placeholder="Nama Sekolah/Lokasi">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>SMP</b></label>
                    </div>
                    <input class="form-control" type="text" id="SMP" placeholder="Nama Sekolah/Lokasi">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>SMA</b></label>
                    </div>
                    <input class="form-control" type="text" id="SMA" placeholder="Nama Sekolah/Lokasi">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Kampus</b></label>
                    </div>
                    <input class="form-control" type="text" id="Universitas" placeholder="Nama Kampus/Lokasi">
                  </div>
                </div>
                <div class="col-sm-4 my-1">
                  <button type="button" class="btn btn-primary text-light" id="SimpanResponden"><b>Simpan</b></button> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <div class="card">
          <div class="card-header bg-primary text-light">
            <b>Kondisi Fertilitas (Ditanyakan Pada Istri)</b>
          </div>
          <div style="background-color: yellow;" class="card-body border border-primary">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Usia Istri Saat Pernikahan Pertama</b></label>
                    </div>
                    <input class="form-control" type="text" id="UsiaMenikah">
                    <label class="input-group-text bg-danger text-light"><b>Tahun</b></label>
                  </div>
                </div> 
                <div class="col-sm-6 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Jumlah Tahun Dalam Ikatan Pernikahan</b></label>
                    </div>
                    <input class="form-control" type="text" id="UsiaPernikahan">
                    <label class="input-group-text bg-danger text-light"><b>Tahun</b></label>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="table-resp'ons'ive mt-1">
                    <table class="table table-bordered table-striped">
                      <thead class="bg-success">
                        <tr class="text-light">
                          <th class="text-center align-middle">No</th>
                          <th class="align-middle">Anak Ke</th>
                          <th class="align-middle">Anak Lahir Hidup</th>
                          <th class="align-middle">Anak Masih Hidup</th>
                          <th class="align-middle">Anak Sudah Meninggal</th>
                          <th class="align-middle">Usia</th>
                          <th class="text-center align-middle">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="Fertilitas"></tbody>
                    </table>
                  </div> 
                </div>
                <div class="col-sm-3 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>A.K Lahir Hidup</b></label>
                    </div>
                    <select class="custom-select" id="AnakLahirHidup">                    
                      <option value="1">Ya</option>
                      <option value="2">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>A.K Masih Hidup</b></label>
                    </div>
                    <select class="custom-select" id="AnakMasihHidup">                    
                      <option value="1">Ya</option>
                      <option value="2">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>A.K Sudah Wafat</b></label>
                    </div>
                    <select class="custom-select" id="AnakSudahMeninggal">                    
                      <option value="1">Ya</option>
                      <option value="2">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Usia Anak</b></label>
                    </div>
                    <input class="form-control" type="text" id="UsiaAnak">&emsp;
                    <button type="button" class="btn btn-primary text-light" id="SimpanFertilitas"><b>Simpan</b></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <div class="card">
          <div class="card-header bg-primary text-light">
            <b>Harapan Kesehatan</b>
          </div>
          <div style="background-color: yellow;" class="card-body border border-primary">
            <div class="container-fluid">
              <div class="row">
                <?php $Kesehatan = array('Dokter','Bidan Desa','Polides','Peralatan Persalinan','RS Swasta','Klinik Bersalin Swasta','Puskesmas',
                                    'Posyandu','Pemeriksaan Kehamilan','Vaksinasi','Pemberian Vitamin','Obat-Obatan','Biaya Persalinan'); 
                foreach ($Kesehatan as $key => $value) { ?>
                  <div class="col-sm-3 my-1">
                    <label class="input-group-text bg-success text-light justify-content-center"><b><?=$value?></b></label>
                  </div>
                  <div class="col-sm-auto my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Ketercukupan</b></label>
                      </div>
                      <select class="custom-select" id="<?='KetercukupanKesehatan'.($key+1)?>">                    
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                      </select>
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Keterlayanan</b></label>
                      </div>
                      <select class="custom-select" id="<?='KeterlayananKesehatan'.($key+1)?>">                    
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                      </select>
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Prioritas Dikembangkan</b></label>
                      </div>
                      <select class="custom-select" id="<?='PrioritasKesehatan'.($key+1)?>">                    
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                      </select>
                    </div>
                  </div>
                <?php }?>
                  <div class="col-sm-auto my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Jelaskan Beberapa Kendala Dalam Mendapatkan Fasilitas Kesehatan</b></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 my-1">
                    <textarea id="KendalaKesehatan" rows="4" cols="119"></textarea>
                  </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <div class="card">
          <div class="card-header bg-primary text-light">
            <b>Harapan Fasilitas Pendidikan</b>
          </div>
          <div style="background-color: yellow;" class="card-body border border-primary">
            <div class="container-fluid">
              <div class="row">
                <?php $Pendidikan = array('Gedung Sekolah','Ruang Kelas','Guru','Buku Pelajaran','Jarak','Sekolah Swasta','Biaya Sekolah'); 
                foreach ($Pendidikan as $key => $value) { ?>
                  <div class="col-sm-3 my-1">
                    <label class="input-group-text bg-primary text-light justify-content-center"><b><?=$value?></b></label>
                  </div>
                  <div class="col-sm-auto my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Ketercukupan</b></label>
                      </div>
                      <select class="custom-select" id="<?='KetercukupanPendidikan'.($key+1)?>">                    
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                      </select>
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Keterlayanan</b></label>
                      </div>
                      <select class="custom-select" id="<?='KeterlayananPendidikan'.($key+1)?>">                    
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                      </select>
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Prioritas Dikembangkan</b></label>
                      </div>
                      <select class="custom-select" id="<?='PrioritasPendidikan'.($key+1)?>">                    
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                      </select>
                    </div>
                  </div>
                <?php }?>
                <div class="col-sm-auto my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Tingkat Pendidikan Maksimal Yang Bisa Diusahakan</b></label>
                    </div>
                    <select class="custom-select" id="KesanggupanPendidikan">                    
                      <option value="1">SD/Sederajat</option>
                      <option value="2">SMP/Sederajat</option>
                      <option value="3">SMA/Sederajat</option>
                      <option value="4">Diploma</option>
                      <option value="5">Sarjana</option>
                      <option value="6">Pasca Sarjana</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-auto my-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text bg-danger text-light"><b>Keluhan Pendidikan</b></label>
                    </div>
                    <select class="custom-select" id="KeluhanPendidikan">                    
                      <option value="1">Kurikulum Pendidikan</option>
                      <option value="2">Biaya Sekolah</option>
                      <option value="3">Ketersediaan Fasilitas Pendidikan</option>
                      <option value="4">Jarak Fasilitas Pendidikan</option>
                      <option value="5">Minat Bersekolah</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 mt-3">
        <div class="card">
          <div class="card-header bg-primary text-light">
            <b>PENGELUARAN PERKAPITA (Ditanyakan untuk 1 keluarga mengenai konsumsi selama 1minggu)</b>
          </div>
          <div style="background-color: yellow;" class="card-body border border-primary">
            <div class="container-fluid">
              <div class="row">
                <?php $Komoditas = array('Beras','Tepung terigu','Ketela pohon/singkong','Kentang','Tongkol/tuna/cakalang','Kembung','Bandeng','Mujair','Mas','Lele','Ikan segar lainnya','Daging sapi','Daging ayam ras','Daging ayam kampung','Telur ayam ras','Susu kental manis','Susu bubuk','Susu bubuk bayi','Bayam','Kangkung','Kacang panjang','Bawang merah','Bawang putih','Cabe merah','Cabe rawit','Tahu','Tempe','Jeruk','Mangga','Salak','Pisang ambon','Pisang raja','Pisang lainnya','Pepaya','Minyak kelapa','Minyak goreng lainnya','Kelapa','Gula pasir','Teh','Kopi','Garam','Kecap','Penyedap masakan/vetsin','Mie instan','Roti manis/roti lainnya','Kue kering','Kue basah','Makanan gorengan','Gado-gado/ketoprak','Nasi campur/rames','Nasi goreng','Nasi putih','Lontong/ketupat sayur','Soto/gule/sop/rawon/cincang','Sate/tongseng','Mie bakso/mie rebus/mie goreng','Makanan ringan anak','Ikang (goreng/bakar dll)','Ayam/daging (goreng dll)','Makanan jadi lainnya','Air kemasan galon','Minuman jadi lainnya','Es lainnya','Roko kretek filter','Rokok kretek tanpa filter','Rokok putih','Perawatan rumah sendiri/bebas sewa','Rumah kontrak','Rumah sewa','Rumah dinas','Listrik','Air PAM','LPG','Minyak tanah','Lainnya(batu baterai,aki,korek,obat nyamuk dll)','Perlengkapan mandi','Barang kecantikan','Perawatan kulit,muka,kuku,rambut','Sabun cuci','Biaya RS Pemerintah','Biaya RS Swasta','Puskesmas/pustu','Praktek dokter/poliklinik','SPP','Bensin','Transportasi/pengangkutan umum','Pos dan Telekomunikasi','Pakaian jadi laki-laki dewasa','Pakaian jadi perempuan dewasa','Pakaian jadi anak-anak','Alas kaki','Minyak Pelumas','Meubelair','Peralatan Rumah Tangga','Perlengkapan perabot rumah tangga','Alat-alat Dapur/Makan'); 
                      $Satuan = array('Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','ml','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Kg','Liter','Liter','Butir','ons','ons','ons','ons','ml','ons','Bungkus','Bungkus','ons','buah','Bungkus','Bungkus','Bungkus','Bungkus','Bungkus','Bungkus','Piring','Piring','Piring','Bungkus','Kg','Kg','Bungkus','Gallon','ml','ml','Bungkus','Bungkus','Bungkus','Rp','Rp','Rp','Rp','Rp','M3','Kg','Liter','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Rp','Liter','Rp','Rp','Rp','Rp');
                foreach ($Komoditas as $key => $value) { ?>
                  <div class="col-sm-5 my-1">
                    <label class="input-group-text bg-primary text-light justify-content-center"><b><?=$value.' ('.$Satuan[$key].')'?></b></label>
                  </div>
                  <div class="col-sm-2 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Banyaknya</b></label>
                      </div>                
                      <input class="form-control" type="text" id="<?='VolumeKomoditas'.($key+1)?>">
                    </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Harga</b></label>
                      </div>
                      <input class="form-control" type="text" id="<?='HargaKomoditas'.($key+1)?>">
                    </div>
                  </div>
                <?php } ?>
                  <div class="col-sm-6 my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>5 Komoditas Yang Memberatkan</b></label>
                      </div>
                      <input class="form-control" type="text" id="KomoditasMemberatkan">
                    </div>
                  </div>
                  <div class="col-sm-auto my-1">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Penyebab Pengangguran</b></label>
                      </div>
                      <select class="custom-select" id="PenyebabPengangguran">                    
                        <option value="1">Rendahnya Kualitas Pendidikan</option>
                        <option value="2">Sedang Mencari Pekerjaan</option>
                        <option value="3">Minimnya Lowongan Pekerjaan</option>
                        <option value="4">Lainnya</option>
                      </select>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function(){
        
      var BaseURL = '<?=base_url()?>'

      $("#Provinsi").change(function (){
        var Provinsi = { Kode: $("#Provinsi").val() }
        $.post(BaseURL+"IDE/Kabupaten", Provinsi).done(function(Respon) {
          $('#Kabupaten').html(Respon)
          var Kabupaten = { Kode: $("#Kabupaten").val() }
          $.post(BaseURL+"IDE/Kecamatan", Kabupaten).done(function(Respon) {
            $('#Kecamatan').html(Respon)
            var Desa = { Kode: $("#Kecamatan").val() }
            $.post(BaseURL+"IDE/Desa", Desa).done(function(Respon) {
              $('#Desa').html(Respon)
            })  
          })  
        })    
      })

      $("#Kabupaten").change(function (){
        var Kabupaten = { Kode: $("#Kabupaten").val() }
        $.post(BaseURL+"IDE/Kecamatan", Kabupaten).done(function(Respon) {
          $('#Kecamatan').html(Respon)
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/Desa", Desa).done(function(Respon) {
            $('#Desa').html(Respon)
          })  
        })    
      })
      
      $("#Kecamatan").change(function (){
        var Desa = { Kode: $("#Kecamatan").val() }
        $.post(BaseURL+"IDE/Desa", Desa).done(function(Respon) {
          $('#Desa').html(Respon)
        })    
      })

      $("#AnakLahirHidup").change(function (){
          if ($('#AnakLahirHidup').val() == 2) {
            $("#AnakMasihHidup").val(2);
            $("#AnakSudahMeninggal").val(1);
            $("#AnakMasihHidup").prop('disabled', true);
            $("#AnakSudahMeninggal").prop('disabled', true);
          } else {
            $("#AnakMasihHidup").val(1);
            $("#AnakSudahMeninggal").val(2);
            $("#AnakMasihHidup").prop('disabled', false);
            $("#AnakSudahMeninggal").prop('disabled', false);
          }  
        })

        $("#AnakMasihHidup").change(function (){
          if ($('#AnakMasihHidup').val() == 2) {
            $("#AnakSudahMeninggal").val(1);
            $("#AnakSudahMeninggal").prop('disabled', true);
          } else {
            $("#AnakSudahMeninggal").val(2);
            $("#AnakSudahMeninggal").prop('disabled', false);
          }  
        })

        var KK = []
        var ModeEditKK = false
        var IdEditKK = 0
        var Status = ['Suami','Istri','Anak Ke 1','Anak Ke 2','Anak Ke 3','Anak Ke 4','Anak Ke 5','Anak Ke 6','Anak Ke 7','Anak Ke 8','Anak Ke 9','Anak Ke 10','Anak Ke 11','Anak Ke 12']
        var Gender = ['Laki-Laki','Perempuan']

        $("#SimpanResponden").click(function() {
          if (ModeEditKK) {
            KK[IdEditKK].NIK = $('#NIK').val()
            KK[IdEditKK].Nama = $('#NamaAnggota').val()
            KK[IdEditKK].Gender = $('#Gender').val()
            KK[IdEditKK].Usia = $('#Usia').val()
            KK[IdEditKK].StatusAnggota = $('#StatusAnggota').val()
            KK[IdEditKK].StatusPerkawinan = $('#StatusPerkawinan').val()
            KK[IdEditKK].Pendapatan = $('#Pendapatan').val()
            KK[IdEditKK].Pekerjaan = $('#Pekerjaan').val()
            KK[IdEditKK].JamKerja = $('#JamKerja').val()
            KK[IdEditKK].Keahlian = $('#Keahlian').val()
            KK[IdEditKK].KegiatanSeminggu = $('#KegiatanSeminggu').val()
            KK[IdEditKK].AlasanMencariKerja = $('#AlasanMencariKerja').val()
            KK[IdEditKK].AlasanMencariKerjaLainnya = $('#AlasanMencariKerjaLainnya').val()
            KK[IdEditKK].LokasiKerja = $('#LokasiKerja').val()
            KK[IdEditKK].AlasanLokasiBekerja = $('#AlasanLokasiBekerja').val()
            KK[IdEditKK].PertolonganKelahiran = $('#PertolonganKelahiran').val()
            KK[IdEditKK].KJK = $('#KJK').val()
            KK[IdEditKK].ASI = $('#ASI').val()
            KK[IdEditKK].Imunisasi = $('#Imunisasi').val()
            KK[IdEditKK].PartisipasiSekolah = $('#PartisipasiSekolah').val()
            KK[IdEditKK].PendidikanTertinggi = $('#PendidikanTertinggi').val()
            KK[IdEditKK].StatusSekolah = $('#StatusSekolah').val()
            KK[IdEditKK].Santri = $('#Santri').val()
            KK[IdEditKK].IjazahTertinggi = $('#IjazahTertinggi').val()
            KK[IdEditKK].BacaTulis = $('#BacaTulis').val()
            KK[IdEditKK].SD = $('#SD').val()
            KK[IdEditKK].SMP = $('#SMP').val()
            KK[IdEditKK].SMA = $('#SMA').val()
            KK[IdEditKK].Universitas = $('#Universitas').val()
            TabelKK(KK)
            ModeEditKK = false
          } else {
            var Responden = {}
            Responden['NIK'] = $('#NIK').val()
            Responden['Nama'] = $('#NamaAnggota').val()
            Responden['Gender'] = $('#Gender').val()
            Responden['Usia'] = $('#Usia').val()
            Responden['StatusAnggota'] = $('#StatusAnggota').val()
            Responden['StatusPerkawinan'] = $('#StatusPerkawinan').val()
            Responden['Pendapatan'] = $('#Pendapatan').val()
            Responden['Pekerjaan'] = $('#Pekerjaan').val()
            Responden['JamKerja'] = $('#JamKerja').val()
            Responden['Keahlian'] = $('#Keahlian').val()
            Responden['KegiatanSeminggu'] = $('#KegiatanSeminggu').val()
            Responden['AlasanMencariKerja'] = $('#AlasanMencariKerja').val()
            Responden['AlasanMencariKerjaLainnya'] = $('#AlasanMencariKerjaLainnya').val()
            Responden['LokasiKerja'] = $('#LokasiKerja').val()
            Responden['AlasanLokasiBekerja'] = $('#AlasanLokasiBekerja').val()
            Responden['PertolonganKelahiran'] = $('#PertolonganKelahiran').val()
            Responden['KJK'] = $('#KJK').val()
            Responden['ASI'] = $('#ASI').val()
            Responden['Imunisasi'] = $('#Imunisasi').val()
            Responden['PartisipasiSekolah'] = $('#PartisipasiSekolah').val()
            Responden['PendidikanTertinggi'] = $('#PendidikanTertinggi').val()
            Responden['StatusSekolah'] = $('#StatusSekolah').val()  
            Responden['Santri'] = $('#Santri').val()
            Responden['IjazahTertinggi'] = $('#IjazahTertinggi').val()
            Responden['BacaTulis'] = $('#BacaTulis').val()
            Responden['SD'] = $('#SD').val()
            Responden['SMP'] = $('#SMP').val()
            Responden['SMA'] = $('#SMA').val()
            Responden['Universitas'] = $('#Universitas').val()
            KK.push(Responden)	
            TabelKK(KK)
          }
        })

        $(document).on("click",".Edit",function(){
          var Edit = KK[$(this).attr('Edit')]
          $('#NIK').val(Edit.NIK)
          $('#NamaAnggota').val(Edit.Nama)
          $('#Gender').val(Edit.Gender)
          $('#Usia').val(Edit.Usia)
          $('#StatusAnggota').val(Edit.StatusAnggota)
          $('#StatusPerkawinan').val(Edit.StatusPerkawinan)
          $('#Pendapatan').val(Edit.Pendapatan)
          $('#Pekerjaan').val(Edit.Pekerjaan)
          $('#JamKerja').val(Edit.JamKerja)
          $('#Keahlian').val(Edit.Keahlian)
          $('#KegiatanSeminggu').val(Edit.KegiatanSeminggu)
          $('#AlasanMencariKerja').val(Edit.AlasanMencariKerja)
          $('#AlasanMencariKerjaLainnya').val(Edit.AlasanMencariKerjaLainnya)
          $('#LokasiKerja').val(Edit.LokasiKerja)
          $('#AlasanLokasiBekerja').val(Edit.AlasanLokasiBekerja)
          $('#PertolonganKelahiran').val(Edit.PertolonganKelahiran)
          $('#KJK').val(Edit.KJK)
          $('#ASI').val(Edit.ASI)
          $('#Imunisasi').val(Edit.Imunisasi)
          $('#PartisipasiSekolah').val(Edit.PartisipasiSekolah)
          $('#PendidikanTertinggi').val(Edit.PendidikanTertinggi)
          $('#StatusSekolah').val(Edit.StatusSekolah)
          $('#Santri').val(Edit.Santri)
          $('#IjazahTertinggi').val(Edit.IjazahTertinggi)
          $('#BacaTulis').val(Edit.BacaTulis)
          $('#SD').val(Edit.SD)
          $('#SMP').val(Edit.SMP)
          $('#SMA').val(Edit.SMA)
          $('#Universitas').val(Edit.Universitas)
          IdEditKK = $(this).attr('Edit')
          ModeEditKK = true
        })

        $(document).on("click",".Hapus",function(){
          var Hapus = $(this).attr('Hapus')
					var Konfirmasi = confirm("Yakin Ingin Menghapus?")
      		if (Konfirmasi == true) {
            KK.splice(Hapus,1)
            TabelKK(KK)
					}
        })
        
        var ModeEditFertilitas = false
        var IdEditAnak = 0
        var Fertilitas = []

        $("#SimpanFertilitas").click(function() {
          if (ModeEditFertilitas) {
            Fertilitas[IdEditAnak].AnakLahirHidup = $('#AnakLahirHidup').val()
            Fertilitas[IdEditAnak].AnakMasihHidup = $('#AnakMasihHidup').val()
            Fertilitas[IdEditAnak].AnakSudahMeninggal = $('#AnakSudahMeninggal').val()
            Fertilitas[IdEditAnak].UsiaAnak = $('#UsiaAnak').val()
            TabelFertilitas(Fertilitas)
            $('#AnakLahirHidup').val(1)
            $('#AnakMasihHidup').val(1)
            $('#AnakSudahMeninggal').val(1)
            $('#UsiaAnak').val('')
            ModeEditFertilitas = false
          } else {
            var Anak = {}
            Anak['AnakLahirHidup'] = $('#AnakLahirHidup').val()
            Anak['AnakMasihHidup'] = $('#AnakMasihHidup').val()
            Anak['AnakSudahMeninggal'] = $('#AnakSudahMeninggal').val()
            Anak['UsiaAnak'] = $('#UsiaAnak').val()
            Fertilitas.push(Anak)	
            TabelFertilitas(Fertilitas)
          }
        })

        $(document).on("click",".EditFertilitas",function(){
          var Edit = Fertilitas[$(this).attr('EditFertilitas')]
          $('#AnakLahirHidup').val(Edit.AnakLahirHidup)
          $('#AnakMasihHidup').val(Edit.AnakMasihHidup)
          $('#AnakSudahMeninggal').val(Edit.AnakSudahMeninggal)
          $('#UsiaAnak').val(Edit.UsiaAnak)
          IdEditAnak = $(this).attr('EditFertilitas')
          ModeEditFertilitas = true
        })

        $(document).on("click",".HapusFertilitas",function(){
          var Hapus = $(this).attr('HapusFertilitas')
					var Konfirmasi = confirm("Yakin Ingin Menghapus?")
      		if (Konfirmasi == true) {
            Fertilitas.splice(Hapus,1)
            TabelFertilitas(Fertilitas)
					}
        })

    })

    function TabelKK(kk) {
      var Status = ['Suami','Istri','Anak Ke 1','Anak Ke 2','Anak Ke 3','Anak Ke 4','Anak Ke 5','Anak Ke 6','Anak Ke 7','Anak Ke 8','Anak Ke 9','Anak Ke 10','Anak Ke 11','Anak Ke 12']
      var Gender = ['Laki-Laki','Perempuan']
      var	rows = '';
      $.each(kk, function(key,value) {
        rows = rows + '<tr class="bg-light font-weight-bold">';
        rows = rows + '<td class="text-center align-middle">'+(key+1)+'</td>';
        rows = rows + '<td class="align-middle">'+value.Nama+'</td>';
        rows = rows + '<td class="align-middle">'+Status[value.StatusAnggota-1]+'</td>';
        rows = rows + '<td class="align-middle">'+Gender[value.Gender-1]+'</td>';
        rows = rows + '<td class="align-middle">'+value.Usia+'</td>';
        rows = rows + '<td class="text-center align-middle">';
          rows = rows + '<button Edit="'+key+'" class="btn btn-sm btn-warning mr-1 Edit"><i class="fas fa-edit"></i></button>';
          rows = rows + '<button Hapus="'+key+'" class="btn btn-sm btn-danger ml-1 Hapus"><i class="fas fa-trash"></i></button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';
      })
      $("#KK").html(rows)
    }

    function TabelFertilitas(fertilitas) {
      var OpsiFertilitas = ['Ya','Tidak']
      var	rows = ''
      $.each(fertilitas, function(key,value) {
        rows = rows + '<tr class="bg-light font-weight-bold">';
        rows = rows + '<td class="text-center align-middle">'+(key+1)+'</td>';
        rows = rows + '<td class="text-center align-middle">'+(key+1)+'</td>';
        rows = rows + '<td class="align-middle">'+OpsiFertilitas[value.AnakLahirHidup-1]+'</td>';
        rows = rows + '<td class="align-middle">'+OpsiFertilitas[value.AnakMasihHidup-1]+'</td>';
        rows = rows + '<td class="align-middle">'+OpsiFertilitas[value.AnakSudahMeninggal-1]+'</td>';
        rows = rows + '<td class="align-middle">'+value.UsiaAnak+'</td>';
        rows = rows + '<td class="text-center align-middle">';
          rows = rows + '<button EditFertilitas="'+key+'" class="btn btn-sm btn-warning mr-1 EditFertilitas"><i class="fas fa-edit"></i></button>';
          rows = rows + '<button HapusFertilitas="'+key+'" class="btn btn-sm btn-danger ml-1 HapusFertilitas"><i class="fas fa-trash"></i></button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';
      })
      $("#Fertilitas").html(rows)
    }
  </script>
</body>

</html>