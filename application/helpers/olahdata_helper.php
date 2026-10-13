<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helper Data Kategori & Sub-Kategori Standar Indikator Daerah (5 Kategori Makro Pembangunan)
 */
if (!function_exists('get_master_kategori_olah_data')) {
  function get_master_kategori_olah_data() {
    return array(
      '1' => array(
        'nomor' => '1',
        'nama' => 'GEOGRAFI DAN DEMOGRAFI (KEPENDUDUKAN)',
        'slug' => 'geografi-demografi',
        'icon' => 'fa-solid fa-earth-asia',
        'gradient' => 'linear-gradient(135deg, #0284c7 0%, #0369a1 100%)',
        'badge_color' => '#0284c7',
        'deskripsi' => 'Kondisi geografis, lingkungan hidup, tutupan lahan, kerawanan bencana, serta demografi kependudukan.',
        'sub' => array(
          'A' => array(
            'kode' => 'A',
            'nama' => 'Kondisi Geografis & Lingkungan',
            'deskripsi' => 'Luas wilayah, topografi, iklim cuaca, tutupan lahan, kebencanaan, dan indeks kualitas lingkungan.',
            'indikator' => array(
              array('nama' => 'Luas wilayah total (daratan dan perairan)', 'satuan' => 'km²'),
              array('nama' => 'Luas wilayah per kecamatan/desa/kelurahan', 'satuan' => 'km²'),
              array('nama' => 'Ketinggian wilayah (topografi) dan kemiringan lereng', 'satuan' => 'mdpl / %'),
              array('nama' => 'Curah hujan rata-rata, suhu, dan kelembapan udara', 'satuan' => 'mm / °C / %'),
              array('nama' => 'Luasan tutupan lahan (hutan, pertanian, permukiman, industri)', 'satuan' => 'Ha / km²'),
              array('nama' => 'Luasan dan jumlah titik lokasi rawan bencana (banjir, longsor, gempa)', 'satuan' => 'Titik / Ha'),
              array('nama' => 'Indeks Kualitas Lingkungan Hidup (IKLH) meliputi indeks kualitas air, udara, dan tutupan lahan', 'satuan' => 'Poin (0-100)')
            )
          ),
          'B' => array(
            'kode' => 'B',
            'nama' => 'Demografi',
            'deskripsi' => 'Statistik jumlah penduduk, rasio gender, laju pertumbuhan, kepadatan, kelompok umur, dan migrasi.',
            'indikator' => array(
              array('nama' => 'Jumlah penduduk total', 'satuan' => 'Jiwa'),
              array('nama' => 'Jumlah penduduk laki-laki dan perempuan (Rasio Jenis Kelamin / Sex Ratio)', 'satuan' => 'Rasio'),
              array('nama' => 'Laju pertumbuhan penduduk per tahun', 'satuan' => '%'),
              array('nama' => 'Kepadatan penduduk (jiwa per km²)', 'satuan' => 'Jiwa/km²'),
              array('nama' => 'Jumlah Kepala Keluarga (KK)', 'satuan' => 'KK'),
              array('nama' => 'Komposisi penduduk berdasarkan kelompok umur (balita, usia sekolah, usia produktif, lansia)', 'satuan' => 'Jiwa / %'),
              array('nama' => 'Rasio Ketergantungan (Dependency Ratio)', 'satuan' => 'Poin'),
              array('nama' => 'Angka Kelahiran Kasar (CBR) dan Angka Kelahiran Total (TFR)', 'satuan' => 'Per 1.000 / Anak'),
              array('nama' => 'Angka Kematian Kasar (CDR)', 'satuan' => 'Per 1.000'),
              array('nama' => 'Tingkat migrasi (penduduk masuk dan keluar)', 'satuan' => 'Jiwa / %')
            )
          )
        )
      ),
      '2' => array(
        'nomor' => '2',
        'nama' => 'KESEJAHTERAAN MASYARAKAT (SOSIAL)',
        'slug' => 'kesejahteraan-sosial',
        'icon' => 'fa-solid fa-heart-pulse',
        'gradient' => 'linear-gradient(135deg, #059669 0%, #047857 100%)',
        'badge_color' => '#059669',
        'deskripsi' => 'Derajat kesehatan masyarakat, akses pendidikan & IPM, kemiskinan, ketenagakerjaan, serta perlindungan sosial.',
        'sub' => array(
          'A' => array(
            'kode' => 'A',
            'nama' => 'Kesehatan',
            'deskripsi' => 'Angka harapan hidup, prevalensi stunting, AKI/AKB, status gizi balita, cakupan imunisasi, dan prevalensi penyakit.',
            'indikator' => array(
              array('nama' => 'Angka Harapan Hidup (AHH) pada saat lahir', 'satuan' => 'Tahun'),
              array('nama' => 'Prevalensi stunting pada balita', 'satuan' => '%'),
              array('nama' => 'Angka Kematian Ibu (AKI) per 100.000 kelahiran hidup', 'satuan' => 'Per 100.000 KH'),
              array('nama' => 'Angka Kematian Bayi (AKB) per 1.000 kelahiran hidup', 'satuan' => 'Per 100.000 KH'),
              array('nama' => 'Persentase gizi buruk dan gizi kurang pada balita', 'satuan' => '%'),
              array('nama' => 'Cakupan imunisasi dasar lengkap', 'satuan' => '%'),
              array('nama' => 'Prevalensi penyakit menular (Tuberkulosis, HIV/AIDS, Demam Berdarah Dengue, Malaria)', 'satuan' => 'Kasus / %'),
              array('nama' => 'Prevalensi penyakit tidak menular (Hipertensi, Diabetes Melitus)', 'satuan' => 'Kasus / %')
            )
          ),
          'B' => array(
            'kode' => 'B',
            'nama' => 'Pendidikan',
            'deskripsi' => 'Indeks Pembangunan Manusia, angka partisipasi sekolah (APK/APM), rata-rata & harapan lama sekolah.',
            'indikator' => array(
              array('nama' => 'Indeks Pembangunan Manusia (IPM)', 'satuan' => 'Poin'),
              array('nama' => 'Harapan Lama Sekolah (HLS)', 'satuan' => 'Tahun'),
              array('nama' => 'Rata-rata Lama Sekolah (RLS)', 'satuan' => 'Tahun'),
              array('nama' => 'Angka Partisipasi Kasar (APK) PAUD, SD/MI, SMP/MTs, dan SMA/SMK/MA', 'satuan' => '%'),
              array('nama' => 'Angka Partisipasi Murni (APM) SD/MI, SMP/MTs, dan SMA/SMK/MA', 'satuan' => '%'),
              array('nama' => 'Angka Putus Sekolah per jenjang pendidikan', 'satuan' => '%'),
              array('nama' => 'Angka Melek Huruf usia 15 tahun ke atas', 'satuan' => '%')
            )
          ),
          'C' => array(
            'kode' => 'C',
            'nama' => 'Kemiskinan, Sosial & Ketenagakerjaan',
            'deskripsi' => 'Tingkat kemiskinan, garis kemiskinan, pengangguran terbuka (TPT), partisipasi angkatan kerja (TPAK), PMKS.',
            'indikator' => array(
              array('nama' => 'Persentase penduduk miskin', 'satuan' => '%'),
              array('nama' => 'Jumlah penduduk miskin ekstrem', 'satuan' => 'Jiwa / %'),
              array('nama' => 'Garis Kemiskinan (Rupiah/kapita/bulan)', 'satuan' => 'Rp/kapita/bln'),
              array('nama' => 'Indeks Kedalaman Kemiskinan (P1) dan Indeks Keparahan Kemiskinan (P2)', 'satuan' => 'Poin'),
              array('nama' => 'Tingkat Pengangguran Terbuka (TPT)', 'satuan' => '%'),
              array('nama' => 'Tingkat Partisipasi Angkatan Kerja (TPAK)', 'satuan' => '%'),
              array('nama' => 'Jumlah Penyandang Masalah Kesejahteraan Sosial (PMKS) yang tertangani', 'satuan' => 'Orang / %'),
              array('nama' => 'Jumlah kasus kekerasan terhadap perempuan dan anak', 'satuan' => 'Kasus')
            )
          )
        )
      ),
      '3' => array(
        'nomor' => '3',
        'nama' => 'INFRASTRUKTUR DAN PELAYANAN UMUM',
        'slug' => 'infrastruktur-pelayanan-umum',
        'icon' => 'fa-solid fa-road',
        'gradient' => 'linear-gradient(135deg, #d97706 0%, #b45309 100%)',
        'badge_color' => '#d97706',
        'deskripsi' => 'Infrastruktur jalan & jembatan, irigasi, RTH, air minum, sanitasi, permukiman, serta sarana fasilitas publik.',
        'sub' => array(
          'A' => array(
            'kode' => 'A',
            'nama' => 'Infrastruktur Pekerjaan Umum & Penataan Ruang',
            'deskripsi' => 'Kondisi kemantapan jalan, jembatan, jaringan irigasi, ruang terbuka hijau, drainase, dan kepatuhan RTRW.',
            'indikator' => array(
              array('nama' => 'Panjang jalan total dan persentase jalan dalam kondisi mantap (baik dan sedang)', 'satuan' => 'km / %'),
              array('nama' => 'Panjang dan kondisi jembatan', 'satuan' => 'm / % Mantap'),
              array('nama' => 'Persentase jaringan irigasi dalam kondisi baik', 'satuan' => '%'),
              array('nama' => 'Luasan Ruang Terbuka Hijau (RTH) publik', 'satuan' => 'Ha / %'),
              array('nama' => 'Persentase kesesuaian pemanfaatan ruang dengan Rencana Tata Ruang Wilayah (RTRW)', 'satuan' => '%'),
              array('nama' => 'Panjang sistem drainase dan persentase yang berfungsi baik', 'satuan' => 'km / %')
            )
          ),
          'B' => array(
            'kode' => 'B',
            'nama' => 'Perumahan, Kawasan Permukiman & Lingkungan',
            'deskripsi' => 'Akses air minum layak, sanitasi, rumah layak huni (RLH), penanganan kawasan kumuh, sampah, dan elektrifikasi.',
            'indikator' => array(
              array('nama' => 'Persentase rumah tangga dengan akses air minum layak dan aman', 'satuan' => '%'),
              array('nama' => 'Persentase rumah tangga dengan akses sanitasi layak dan aman', 'satuan' => '%'),
              array('nama' => 'Persentase rumah layak huni', 'satuan' => '%'),
              array('nama' => 'Luasan kawasan permukiman kumuh yang tertangani', 'satuan' => 'Ha'),
              array('nama' => 'Volume timbulan sampah dan persentase sampah yang terkelola', 'satuan' => 'Ton / %'),
              array('nama' => 'Persentase rumah tangga yang teraliri listrik (Rasio Elektrifikasi)', 'satuan' => '%')
            )
          ),
          'C' => array(
            'kode' => 'C',
            'nama' => 'Fasilitas Pelayanan Publik & Perhubungan',
            'deskripsi' => 'Ketersediaan RS/Puskesmas, tempat tidur RS, fasilitas sekolah, pasar modern/tradisional, dan konektivitas.',
            'indikator' => array(
              array('nama' => 'Jumlah Rumah Sakit, Puskesmas (Rawat Inap/Non-Rawat Inap), dan Posyandu', 'satuan' => 'Unit'),
              array('nama' => 'Rasio ketersediaan tempat tidur rumah sakit per 1.000 penduduk', 'satuan' => 'TT/1.000 pddk'),
              array('nama' => 'Jumlah gedung sekolah (SD, SMP, SMA) dan rasio ruang kelas', 'satuan' => 'Gedung / Rasio'),
              array('nama' => 'Jumlah pasar tradisional dan pasar modern', 'satuan' => 'Unit'),
              array('nama' => 'Persentase wilayah bebas blank spot (memiliki akses sinyal seluler/internet)', 'satuan' => '%'),
              array('nama' => 'Jumlah terminal angkutan darat, pelabuhan, dan bandara (jika ada)', 'satuan' => 'Unit')
            )
          )
        )
      ),
      '4' => array(
        'nomor' => '4',
        'nama' => 'EKONOMI DAN DAYA SAING DAERAH',
        'slug' => 'ekonomi-daya-saing',
        'icon' => 'fa-solid fa-chart-line',
        'gradient' => 'linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%)',
        'badge_color' => '#7c3aed',
        'deskripsi' => 'Pertumbuhan PDRB ADHB/ADHK, inflasi, Gini Ratio, NTP/NTN, UMKM, investasi PMDN/PMA, pariwisata & ekspor-impor.',
        'sub' => array(
          'A' => array(
            'kode' => 'A',
            'nama' => 'Indikator Makro Ekonomi',
            'deskripsi' => 'PDRB atas dasar harga berlaku & konstan, PDRB per kapita, laju pertumbuhan ekonomi (LPE), inflasi, dan gini ratio.',
            'indikator' => array(
              array('nama' => 'Produk Domestik Regional Bruto (PDRB) atas dasar harga berlaku (ADHB)', 'satuan' => 'Miliar Rp'),
              array('nama' => 'PDRB atas dasar harga konstan (ADHK)', 'satuan' => 'Miliar Rp'),
              array('nama' => 'PDRB per Kapita', 'satuan' => 'Juta Rp/kapita'),
              array('nama' => 'Laju Pertumbuhan Ekonomi (LPE)', 'satuan' => '%'),
              array('nama' => 'Tingkat Inflasi daerah', 'satuan' => '%'),
              array('nama' => 'Indeks Gini (Gini Ratio) / Ketimpangan Pendapatan', 'satuan' => 'Poin (0-1)')
            )
          ),
          'B' => array(
            'kode' => 'B',
            'nama' => 'Sektoral & Daya Saing',
            'deskripsi' => 'Kontribusi sektoral PDRB, Nilai Tukar Petani/Nelayan, komoditas unggulan, UMKM, investasi, dan sektor pariwisata.',
            'indikator' => array(
              array('nama' => 'Kontribusi sektoral terhadap PDRB', 'satuan' => '%'),
              array('nama' => 'Nilai Tukar Petani (NTP) dan Nilai Tukar Nelayan (NTN)', 'satuan' => 'Poin'),
              array('nama' => 'Volume dan nilai produksi komoditas unggulan daerah', 'satuan' => 'Ton / Miliar Rp'),
              array('nama' => 'Jumlah Usaha Mikro, Kecil, dan Menengah (UMKM) aktif dan binaan', 'satuan' => 'Unit UMKM'),
              array('nama' => 'Nilai investasi Penanaman Modal Dalam Negeri (PMDN) dan Penanaman Modal Asing (PMA)', 'satuan' => 'Miliar Rp'),
              array('nama' => 'Nilai dan volume ekspor serta impor daerah', 'satuan' => 'Juta USD / Ton'),
              array('nama' => 'Jumlah kunjungan wisatawan nusantara dan mancanegara', 'satuan' => 'Orang/Tahun'),
              array('nama' => 'Tingkat Penghunian Kamar (TPK) hotel/penginapan', 'satuan' => '%'),
              array('nama' => 'Kontribusi sektor pariwisata terhadap PDRB', 'satuan' => '%')
            )
          )
        )
      ),
      '5' => array(
        'nomor' => '5',
        'nama' => 'KAPASITAS KEUANGAN DAERAH',
        'slug' => 'kapasitas-keuangan',
        'icon' => 'fa-solid fa-vault',
        'gradient' => 'linear-gradient(135deg, #db2777 0%, #be185d 100%)',
        'badge_color' => '#db2777',
        'deskripsi' => 'Realisasi PAD, pendapatan transfer (DAU/DAK/DBH), belanja operasi & modal, pembiayaan, serta kemandirian fiskal.',
        'sub' => array(
          'A' => array(
            'kode' => 'A',
            'nama' => 'Kinerja Pendapatan Daerah',
            'deskripsi' => 'Target & realisasi pendapatan total, Pendapatan Asli Daerah (pajak/retribusi/kekayaan), dan pendapatan transfer.',
            'indikator' => array(
              array('nama' => 'Target dan Realisasi Pendapatan Daerah total', 'satuan' => 'Miliar Rp / %'),
              array('nama' => 'Realisasi Pendapatan Asli Daerah (PAD)', 'satuan' => 'Miliar Rp'),
              array('nama' => 'Rincian PAD: Pajak Daerah, Retribusi Daerah, Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan, Lain-lain PAD yang Sah', 'satuan' => 'Miliar Rp'),
              array('nama' => 'Realisasi Pendapatan Transfer (Transfer Pemerintah Pusat dan Transfer Antar-Daerah)', 'satuan' => 'Miliar Rp'),
              array('nama' => 'Rincian Transfer: DAU, DAK Fisik/Non-Fisik, DBH, DID, Dana Desa', 'satuan' => 'Miliar Rp')
            )
          ),
          'B' => array(
            'kode' => 'B',
            'nama' => 'Kinerja Belanja & Pembiayaan',
            'deskripsi' => 'Target & realisasi belanja daerah total, proporsi belanja operasi & modal, BTT, belanja transfer, dan pembiayaan netto.',
            'indikator' => array(
              array('nama' => 'Target dan Realisasi Belanja Daerah total', 'satuan' => 'Miliar Rp / %'),
              array('nama' => 'Proporsi Belanja Operasi (Belanja Pegawai, Barang/Jasa, Bunga, Subsidi, Hibah, Bansos)', 'satuan' => '% / Miliar Rp'),
              array('nama' => 'Proporsi Belanja Modal (Tanah, Peralatan/Mesin, Gedung/Bangunan, Jalan/Irigasi/Jaringan)', 'satuan' => '% / Miliar Rp'),
              array('nama' => 'Realisasi Belanja Tidak Terduga (BTT) dan Belanja Transfer', 'satuan' => 'Miliar Rp'),
              array('nama' => 'Realisasi Penerimaan Pembiayaan (SILPA tahun sebelumnya, Pencairan Dana Cadangan, Pinjaman Daerah)', 'satuan' => 'Miliar Rp'),
              array('nama' => 'Realisasi Pengeluaran Pembiayaan (Pembentukan Dana Cadangan, Penyertaan Modal Daerah, Pembayaran Cicilan Pokok Utang)', 'satuan' => 'Miliar Rp')
            )
          ),
          'C' => array(
            'kode' => 'C',
            'nama' => 'Indikator Kemampuan Fiskal',
            'deskripsi' => 'Rasio kemandirian keuangan daerah, efektivitas PAD, efisiensi belanja, ruang fiskal, dan indeks kapasitas fiskal.',
            'indikator' => array(
              array('nama' => 'Rasio Kemandirian Keuangan Daerah (Proporsi PAD terhadap total pendapatan)', 'satuan' => '%'),
              array('nama' => 'Rasio Efektivitas PAD (Realisasi PAD dibanding target)', 'satuan' => '%'),
              array('nama' => 'Rasio Efisiensi Belanja Daerah', 'satuan' => '%'),
              array('nama' => 'Ruang Fiskal (Fiscal Space) daerah', 'satuan' => '% / Miliar Rp'),
              array('nama' => 'Kapasitas Fiskal Daerah (Rendah/Sedang/Tinggi) sesuai indeks Kementerian Keuangan', 'satuan' => 'Kategori / Poin')
            )
          )
        )
      )
    );
  }
}
