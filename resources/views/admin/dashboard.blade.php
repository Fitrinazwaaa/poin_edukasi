<?php

use App\Models\DataUser;
use App\Models\PoinPeringatan;

$datauser = DataUser::all();
$dataperingatan = PoinPeringatan::all();
?>
@extends('navbar/nav-dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Petunjuk Penggunaan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <style>
    body {
      margin: 0;
      padding: 0 20px 20px 20px;
      background-color: white;
      color: #333;
    }

    .dropdown-menu {
      max-height: 300px;
      overflow-y: auto;
    }

    .card {
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #388DD8;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }

    .card-body {
      font-size: 14px;
      color: #4d779c;
    }

    .collapse-inner {
      margin-top: 10px;
      border-left: 2px solid #388DD8;
      padding-left: 15px;
    }

    .card-header span{
      font-size: 14px;
      font-weight: 500;
    }

    li{
      font-size: 14px;
      color: #4d779c;
    }

    /* kebijakan */
    .kebijakan {
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      padding: 20px;
      margin-bottom: 40px;
    }

    /* Header */
    header {
      text-align: center;
      margin-bottom: 30px;
    }

    header h1 {
      font-size: 20px;
      font-weight: bold;
      color: white;
      background-color: #388DD8;
      padding: 13px;
      border-radius: 5px;
      margin-bottom: 7px;
    }

    header p {
      font-size: 15px;
      color: #4d779c;
      margin-top: -15px;
    }

    /* Section */
    .section {
      margin-bottom: 30px;
      /* text-align: center; */
    }

    .section h2 {
      font-size: 17px;
      color: #183c5a;
      margin-bottom: -10px;
      display: inline-block;
      padding-bottom: 5px;
    }

    p{
      font-size: 14px;
      color: #4d779c;
    }

    /* Categories */
    .categories {
      display: flex;
      gap: 20px;
      margin-top: 15px;
    }

    .kartu1 {
      flex: 1;
      background: #E2F1FF;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
    }
    .kartu1:hover {
      transform: scale(1.03);
    }

    .kartu1 h3 {
      font-size: 20px;
      margin-bottom: 10px;
      color: #183c5a;
    }
    
    .kartu1 ul {
      list-style: disc;
      padding-left: 20px;
    }

    .kartu1 ul li{
      color: #183c5a;
    }

    .Tujuan {
      max-width: 100%;
      margin: 50px auto;
      padding: 30px;
      background: #388DD8;
      border-radius: 12px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 20px;
      color: white;
      text-align: center;
      margin-bottom: 20px;
    }

    .list {
      margin-top: 20px;
    }

    .item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 20px;
      padding: 15px;
      border-radius: 10px;
      background-color: #ffffff;
      color: white;
      transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
    }

    .item:hover {
      transform: scale(1.03);
      background-color: #ffffff;
      color: #388DD8;
    }

    .number {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 45px;
      height: 45px;
      background: #204D70;
      color: white;
      font-size: 18px;
      font-weight: bold;
      border-radius: 50%;
      margin-right: 20px;
      flex-shrink: 0;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .item:hover .number {
      background-color: #183C5A;
      color: white;
    }

    .item p {
      margin: 0;
      line-height: 1.6;
      transition: color 0.3s ease;
      font-size: 14px;
    }

    .item p strong {
      display: block;
      font-size: 14px;
      margin-bottom: 5px;
    }
    .bi-chevron-down {
      font-size: 1rem; /* Pastikan ukuran font */
      color: #fff;    /* Warna ikon */
    }
    .toggle-icon {
      transition: transform 0.3s ease; /* Efek animasi rotasi */
    }

    .card-header.collapsed .toggle-icon {
      transform: rotate(0deg); /* Default: menghadap ke bawah */
    }

    .card-header:not(.collapsed) .toggle-icon {
      transform: rotate(180deg); /* Terbalik: menghadap ke atas */
    }

  </style>

</head>
<body>
  <!-- GRAFIK - START -->
    <div id="grafik"></div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var grafikData = <?php echo json_encode($grafik_data); ?>;
    
        // Konversi menjadi array yang dimengerti Highcharts
        var seriesData = Object.keys(grafikData).map(function (tahunAngkatan) {
            return {
                name: tahunAngkatan,
                data: grafikData[tahunAngkatan].map(function (kelas) {
                    return {
                        name: kelas.name,
                        y: parseInt(kelas.y) // Konversi nilai y menjadi integer
                    };
                })
            };
        });
    
        Highcharts.chart('grafik', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Jumlah Poin Negatif Pada Kelas di SMK Negeri 1 Kawali',
              align: 'center', // Mengatur teks menjadi rata tengah
              style: {
                  color: '#183c5a', // Warna titleFRAA
                  fontSize: '28px', // Ukuran font
                  fontWeight: 'bold', // Ketebalan font
              }
          },
          xAxis: {
              type: 'category',
              title: {
                  text: 'Kelas'
              }
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah Poin Negatif'
              }
          },
          series: seriesData
        });
    </script>
    <br><hr>
  <!-- GRAFIK - END -->


  <!-- TUJUAN EDU POINT - START -->
    <div class="Tujuan">
      <h1>Apa Tujuan Utama Dibuatnya EDU-POIN?</h1>
      <div class="list">
        <div class="item">
          <div class="number">1</div>
          <p><strong>Meningkatkan Transparansi</strong>Mempermudah akses data siswa, pencatatan poin, dan laporan yang relevan, sehingga seluruh pihak dapat mengetahui informasi secara jelas dan akurat.</p>
        </div>
        <div class="item">
          <div class="number">2</div>
          <p><strong>Mendukung Pendidikan Karakter</strong>Memberikan apresiasi terhadap perilaku positif dan memberikan pengingat untuk perbaikan dari perilaku yang tidak sesuai, sebagai bagian dari pembentukan karakter siswa.</p>
        </div>
        <div class="item">
          <div class="number">3</div>
          <p><strong>Mempermudah Pengelolaan Data</strong>Memfasilitasi proses administrasi dan pengelolaan data seperti pencatatan poin, data siswa, hingga pengaturan kelas, dengan cara yang efisien dan mudah diakses.</p>
        </div>
        <div class="item">
          <div class="number">4</div>
          <p><strong>Mempermudah Pelaporan dan Evaluasi</strong>Menyediakan fitur laporan untuk membantu guru, orang tua, dan pihak sekolah dalam mengevaluasi perkembangan siswa secara berkala.</p>
        </div>
        <div class="item">
          <div class="number">5</div>
          <p><strong>Meningkatkan Efisiensi Proses</strong>Menghemat waktu dan tenaga dalam pengelolaan data serta pelaksanaan evaluasi melalui digitalisasi sistem.</p>
        </div>
        <div class="item">
          <div class="number">6</div>
          <p><strong>Mendukung Kolaborasi</strong>Menyediakan platform yang memungkinkan komunikasi dan kolaborasi yang lebih baik antara guru, siswa, serta pihak sekolah.</p>
        </div>
      </div>
    </div>
  <!-- TUJUAN EDU POINT - END -->

  <!-- KEBIJAKAN - START -->
    <div class="kebijakan">
      <header>
        <div>
          <h1>Kebijakan Poin</h1>
        </div>
        <!-- <p>Sistem evaluasi kepribadian dan disiplin siswa.</p> -->
      </header>

      <section class="section">
        <h2>Definisi Poin</h2><hr>
        <p>
          <ul style="text-align: justify;">
            <li><b>Poin Positif:</b> Untuk penghargaan atas perilaku baik.</li>
            <li><b>Poin Negatif:</b> Untuk pemberlakuan aturan dan perbaikan sikap.</li>
          </ul>
        </p>
      </section>

      <section class="section">
        <h2>Kategori Poin</h2><hr>
        <div class="categories">
          <div class="kartu1">
            <h3>Poin Positif</h3>
            <ul>
              <li>Prestasi Lomba</li>
              <li>Prestasi Keagamaan</li>
              <li>Prestasi Organisasi</li>
              <li>Perilaku Teladan</li>
            </ul>
          </div>
          <div class="kartu1">
            <h3>Poin Negatif</h3>
            <ul>
              <li>Pakaian</li>
              <li>Rambut</li>
              <li>Aksesoris</li>
            </ul>
          </div>
        </div>
      </section>

      <section class="section">
        <h2>Batas dan Sanksi</h2><hr>
        <p>
          <ul style="text-align: justify;">
            <li>total poin negatif {{ $dataperingatan->firstWhere('id_peringatan', '1')->max_poin ?? '' }} - {{ $dataperingatan->firstWhere('id_peringatan', '2')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '1')->peringatan ?? '' }}</li>
            <li>total poin negatif {{ $dataperingatan->firstWhere('id_peringatan', '2')->max_poin ?? '' }} - {{ $dataperingatan->firstWhere('id_peringatan', '3')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '2')->peringatan ?? '' }}</li>
            <li>total poin negatif {{ $dataperingatan->firstWhere('id_peringatan', '3')->max_poin ?? '' }} - {{ $dataperingatan->firstWhere('id_peringatan', '4')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '3')->peringatan ?? '' }}</li>
            <li>total poin negatif {{ $dataperingatan->firstWhere('id_peringatan', '4')->max_poin ?? '' }} - {{ $dataperingatan->firstWhere('id_peringatan', '5')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '4')->peringatan ?? '' }}</li>
            <li>total poin negatif {{ $dataperingatan->firstWhere('id_peringatan', '5')->max_poin ?? '' }} - {{ $dataperingatan->firstWhere('id_peringatan', '6')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '5')->peringatan ?? '' }}</li>
            <li>total poin negatif {{ $dataperingatan->firstWhere('id_peringatan', '6')->max_poin ?? '' }} - {{ $dataperingatan->firstWhere('id_peringatan', '7')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '6')->peringatan ?? '' }}</li>
            <li>total poin negatif {{ $dataperingatan->firstWhere('id_peringatan', '7')->max_poin ?? '' }} - {{ $dataperingatan->firstWhere('id_peringatan', '2')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '7')->peringatan ?? '' }}</li>
            <li>total poin negatif >{{ $dataperingatan->firstWhere('id_peringatan', '8')->max_poin ?? '' }} : {{ $dataperingatan->firstWhere('id_peringatan', '8')->peringatan ?? '' }}</li>
          </ul>
        </p>
      </section>

      <section class="section">
        <h2>Cara Kerja Sistem Poin</h2><hr>
        <ul style="text-align: justify;">
          <li><b>Penambahan Poin Negatif dan Positif:</b> {{ $datauser->firstWhere('role', 'user_edit')->username ?? 'Guru' }} dan {{ $datauser->firstWhere('role', 'admin')->username ?? 'Bimbingan Konseling' }} dapat menambahkan melalui formulir di halaman "Poin Siswa".</li>
          <li><b>Pengurangan Poin Negatif:</b> Dilakukan sebagai pengampunan atas pelanggaran dengan menambahkan poin positif.</li>
          <li><b>Pengurangan Poin Positif:</b> Dilakukan sebagai konsekuensi atas pelanggaran dengan menambahkan poin Negatif.</li>
          <li><b>Riwayat Poin:</b> Riwayat perorang dapat di akses melalui "Lihat Detail" yang berada pada "poin siswa" , dan untuk semua riwayat dapat diakses melalui "Laporan".</li>
          <li><b>Laporan:</b> Data dapat diunduh dalam format PDF atau Excel.</li>
          <li><b>Tindakan Perbaikan:</b> Konseling untuk siswa dengan poin negatif tertentu.</li>
        </ul>
      </section>
    </div>
  <!-- KEBIJAKAN - END -->

  <!-- PETUNJUK PENGGUNA - START -->
    <div class="PetunjukPengguna" >
      <h1 class="text-center mb-4" style="font-size: 20px; font-weight: bold; color: #183c5a;">Petunjuk Penggunaan</h1>
      <!-- Card PetunjukPengguna -->
      <div id="cardPetunjukPengguna">
        <!-- Card admin - START-->
        <div class="card admin">
          <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdmin">
            <span>{{ $datauser->firstWhere('role', 'admin')->username ?? 'Bimbingan Konseling' }}</span>
            <i class="bi bi-chevron-down toggle-icon"></i>
          </div>
          <div id="collapseAdmin" class="collapse">
            <div class="card-body">
              <p>Halaman yang dapat diakses:</p>
              <ul>
                <li>Data Siswa</li>
                  <!-- dropdown 1 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminDataSiswa1">
                    <span>Pencarian Data Siswa</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminDataSiswa1" class="collapse">
                    <ul>
                      <li>Pencarian data siswa dapat dilakukan menggunakan NIS atau nama siswa.</li>
                      <li>Setelah NIS atau nama siswa dimasukkan pada kolom pencarian, klik tombol "Cari".</li>
                      <li>Untuk menampilkan kembali semua data, tekan ikon "X" merah pada kolom pencarian yang telah terisi.</li>
                    </ul>
                  </div>
                  <!-- dropdown 2 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminDataSiswa2">
                    <span>Menambah Data Menggunakan Formulir</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminDataSiswa2" class="collapse">
                    <ul>
                      <li>Klik tombol kuning bertuliskan "Tambahkan".</li>
                      <li>Isi data secara berurutan mulai dari nama, NIS, jenis kelamin, tahun angkatan, dan kelas (dengan memilih tingkatan, konsentrasi keahlian, serta konsentrasi ke-). </li>
                      <li>Setelah data yang dimasukkan sesuai, klik tombol "Kirim" untuk menambahkan data.</li>
                      <li>Jika ingin membatalkan atau keluar dari formulir, klik tombol "Kembali" atau tombol "X" di bagian kanan atas formulir.</li>
                    </ul>
                  </div>
                  <!-- dropdown 3 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminDataSiswa3">
                    <span>Menambah Data Menggunakan Import Excel</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminDataSiswa3" class="collapse">
                    <ul>
                      <li><i>Untuk kemudahan, disarankan mengunduh data yang sudah ada terlebih dahulu menggunakan fitur "Eksport Excel".</i></li>
                      <li>Buka file Excel yang telah diekspor, lalu klik "Edit".</li>
                      <li>Tambahkan data baru sesuai dengan judul kolom yang tersedia (biarkan kolom `created_at` dan `updated_at` kosong).</li>
                      <li>Setelah selesai, impor kembali file tersebut ke dalam sistem.</li>
                    </ul>
                  </div>
                  <!-- dropdown 4 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminDataSiswa4">
                    <span>Menghapus Data</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminDataSiswa4" class="collapse">
                    <ul>
                      <li>Buka dropdown "Data Siswa".</li>
                      <li>Pilih siswa yang akan dihapus dengan mencentang checkbox di samping nama siswa (bisa memilih lebih dari satu siswa).</li>
                      <li>Klik tombol "Hapus" yang berwarna merah.</li>
                      <li>Konfirmasi penghapusan dengan mengklik "Hapus" pada notifikasi yang muncul.</li>
                    </ul>
                  </div>
                  <!-- dropdown 5 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminDataSiswa5">
                    <span>Mengubah Data</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminDataSiswa5" class="collapse">
                    <ul>
                      <li>Buka dropdown "Data Siswa".</li>
                      <li>Di kolom aksi pada tabel, klik tombol "Aksi" yang sesuai dengan data siswa yang akan diubah.</li>
                      <li>Formulir untuk mengubah data akan muncul. Silakan ubah informasi yang diperlukan, kecuali **NIS yang tidak dapat diubah**.</li>
                      <li>Setelah selesai, klik tombol "Perbarui" untuk menyimpan perubahan atau klik tombol "Kembali" untuk membatalkan.</li>
                    </ul>
                  </div>
              
              
              <li>Poin Siswa</li>
                <!-- dropdown 1 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoinSiswa1">
                    <span>Pencarian Data Poin Siswa</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminPoinSiswa1" class="collapse">
                    <ul>
                      <li>Pencarian data siswa dapat dilakukan dengan menggunakan NIS atau nama siswa.</li>
                      <li>Setelah memasukkan NIS atau nama siswa pada kolom pencarian, klik tombol "Cari".</li>
                      <li>Untuk menampilkan kembali semua data, klik ikon "X" merah pada kolom pencarian yang telah terisi.</li>
                    </ul>
                  </div>
                <!-- dropdown 2 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoinSiswa2">
                    <span>Menambahkan Poin pada Siswa</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminPoinSiswa2" class="collapse">
                    <ul>
                      <li>Klik tombol kuning bertuliskan "Tambahkan".</li>
                      <li>Isi data secara berurutan dimulai dari memilih kelas (tingkatan, konsentrasi keahlian, dan konsentrasi ke-), nama siswa, jenis kelamin, tipe poin, dan nama poin. Jika memilih tipe poin negatif, akan muncul kolom tambahan untuk mengunggah foto bukti perilaku yang dilakukan oleh siswa.</li>
                      <li>Setelah semua data terisi dengan benar, klik tombol "Tambah Poin" untuk menambahkan data.</li>
                      <li>Untuk membatalkan atau keluar dari formulir, klik tombol "Kembali" atau tekan tombol "Cancel" yang terletak di kanan atas formulir.</li>
                    </ul>
                  </div>
                <!-- dropdown 3 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoinSiswa3">
                    <span>Riwayat Poin yang Diterima Siswa</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminPoinSiswa3" class="collapse">
                    <ul>
                      <li>Pada sisi kanan tabel terdapat kolom "Aksi", yang berfungsi untuk melihat detail riwayat poin siswa. Klik tombol tersebut untuk melihat detailnya.</li>
                      <li>Halaman detail poin siswa akan ditampilkan setelah tombol tersebut diklik.</li>
                      <li>Untuk menghapus poin, pilih poin yang ingin dihapus dengan menggunakan checkbox, lalu klik tombol "Hapus" yang terletak di atas tabel.</li>
                      <li>Untuk kembali ke halaman "Poin Siswa", tekan tombol panah yang mengarah ke kiri di sudut kiri atas halaman.</li>
                    </ul>
                  </div>
                <!-- dropdown 4 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoinSiswa4">
                    <span>Melakukan Tindakan terhadap Siswa dengan Poin Negatif Tertentu</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseAdminPoinSiswa4" class="collapse">
                    <ul>
                        <li>Klik salah satu tombol notifikasi yang berada di atas kolom pencarian, yang tersedia dalam beberapa kategori.</li>
                        <li>Setelah masuk ke halaman notifikasi, siswa/i yang masuk ke dalam kategori dengan jumlah poin tersebut dapat dilihat.</li>
                        <li>Perbaikan dapat dilakukan dengan menambahkan poin positif sebagai tindakan untuk mengurangi poin negatif siswa.</li>
                        <li>Untuk kembali ke halaman "Poin Siswa", tekan tombol panah yang mengarah ke kiri di sudut kiri atas halaman.</li>
                    </ul>
                  </div>
                  
                  
                  <li>Keterangan dan Jenis Poin</li>
                  <!-- dropdown 1 -->
                    <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoin1">
                      <span>Menambahkan Keterangan-Poin Negatif dan Positif Menggunakan Formulir</span>
                      <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div id="collapseAdminPoin1" class="collapse">
                      <ul>
                          <li>Klik tombol "Tambah Poin".</li>
                          <li>Isi data secara berurutan dimulai dengan memilih tipe poin, memasukkan ID poin (disarankan ID poin positif dan ID poin negatif memiliki ciri khas masing-masing), keterangan poin, skor poin, dan kategori poin tersebut.</li>
                          <li>Setelah semua data terisi dengan benar, klik tombol "Kirim" untuk menambahkan data.</li>
                          <li>Untuk membatalkan atau keluar dari formulir, klik tombol "Kembali" atau tekan tombol "X" yang terletak di kanan atas formulir.</li>
                      </ul>
                    </div>
                  <!-- dropdown 2 -->
                    <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoin2">
                      <span>Menambahkan Keterangan-Poin Negatif dan Positif Menggunakan Impor Excel</span>
                      <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div id="collapseAdminPoin2" class="collapse">
                      <ul>
                          <li>Klik titik tiga.</li>
                          <li><i>Untuk kemudahan, disarankan untuk mengunduh data yang sudah ada terlebih dahulu menggunakan fitur "Eksport Excel".</i></li>
                          <li>Buka file Excel yang telah diekspor, lalu klik "Edit".</li>
                          <li>Tambahkan data baru sesuai dengan judul kolom yang tersedia (biarkan kolom `created_at` dan `updated_at` kosong).</li>
                          <li>Setelah selesai, impor kembali file tersebut ke dalam sistem.</li>
                      </ul>
                    </div>
                  <!-- dropdown 3 -->
                    <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoin3">
                      <span>Menghapus Poin</span>
                      <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div id="collapseAdminPoin3" class="collapse">
                      <ul>
                          <li>Pilih siswa yang akan dihapus dengan mencentang checkbox di samping nomor (bisa memilih lebih dari satu siswa).</li>
                          <li>Klik tombol "Hapus" yang berwarna merah.</li>
                          <li>Konfirmasi penghapusan dengan mengklik "Hapus" pada notifikasi yang muncul.</li>
                      </ul>
                    </div>
                  <!-- dropdown 4 -->
                    <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPoin4">
                      <span>Mengubah Data Peringatan</span>
                      <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div id="collapseAdminPoin4" class="collapse">
                      <ul>
                          <li>Di kolom aksi pada tabel, klik tombol "Edit" yang sesuai dengan data peringatan yang akan diubah.</li>
                          <li>Formulir untuk mengubah data akan muncul. Silakan ubah informasi yang diperlukan.</li>
                          <li>Setelah selesai, klik tombol "Perbarui" untuk menyimpan perubahan atau klik tombol "Kembali" untuk membatalkan.</li>
                      </ul>
                    </div>


                    <li>Laporan</li>
                    <!-- dropdown 1 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminLaporan1">
                        <span>Mengkategorikan Laporan yang Tampil</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                      <div id="collapseAdminLaporan1" class="collapse">
                        <ul>
                            <li>Klik tombol "Kategorikan".</li>
                            <li>Terdapat 5 kategori yang dapat dipilih, isi sesuai dengan kebutuhan.</li>
                            <li>Setelah kriteria yang dibutuhkan terisi dengan benar, klik tombol "Cari".</li>
                            <li>Untuk menampilkan kembali semua data, klik tombol "Kategorikan", kosongkan semua kategori yang telah diisi sebelumnya, dan klik "Cari".</li>
                            <li>Untuk keluar dari formulir, klik tombol "Kembali" atau tekan tombol "X" yang terletak di kanan atas formulir.</li>
                        </ul>
                      </div>
                    <!-- dropdown 2 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminLaporan2">
                        <span>Mengunduh Laporan dalam format PDF</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                        <div id="collapseAdminLaporan2" class="collapse">
                            <ul>
                            <li>Klik tombol "Unduh PDF".</li>
                            <li>Jika ingin mengunduh berdasarkan kategori tertentu, kategorikan terlebih dahulu, kemudian klik "Unduh PDF".</li>
                            <li>Laporan akan otomatis terunduh.</li>
                        </ul>
                      </div>
                    <!-- dropdown 3 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminLaporan3">
                        <span>Mengunduh Laporan dalam format Excel</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                      <div id="collapseAdminLaporan3" class="collapse">
                        <ul>
                            <li>Klik tombol "Unduh Excel".</li>
                            <li><i>Untuk unduhan Excel, tidak ada pilihan kategori yang dapat dipilih.</i></li>
                            <li>Laporan akan otomatis terunduh.</li>
                        </ul>
                      </div>


                      <li>Pengaturan</li>
                      <!-- dropdown 1 -->
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPengaturan1">
                          <span>Pengaturan Akun</span>
                          <i class="bi bi-chevron-down toggle-icon"></i>
                        </div>
                        <div id="collapseAdminPengaturan1" class="collapse">
                            <ul>
                                <li>Pilih akun yang akan diubah username dan password-nya.</li>
                                <li>Perubahan dapat dilakukan pada salah satu, baik username maupun password, atau keduanya sekaligus.</li>
                                <li><i>Disarankan untuk mencatat atau mengingat username dan password akun tersebut.</i></li>
                                <li>Klik tombol "Ubah Akun" untuk menyimpan perubahan.</li>
                            </ul>
                        </div>
                      <!-- dropdown 2 -->
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPengaturan2">
                          <span>Menambah Kelas Menggunakan Formulir</span>
                          <i class="bi bi-chevron-down toggle-icon"></i>
                        </div>
                        <div id="collapseAdminPengaturan2" class="collapse">
                            <ul>
                                <li>Klik tombol berwarna kuning bertuliskan "Tambahkan".</li>
                                <li>Isi data secara berurutan mulai dari tahun angkatan, konsentrasi keahlian, dan jumlah kelas konsentrasi keahlian.</li>
                                <li>Setelah data dimasukkan dengan benar, klik tombol "Kirim" untuk menambahkan data.</li>
                                <li>Untuk membatalkan atau keluar dari formulir, klik tombol "Kembali" atau tombol "X" di bagian kanan atas formulir.</li>
                            </ul>
                        </div>
                      <!-- dropdown 3 -->
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPengaturan3">
                          <span>Menambah Data Menggunakan Import Excel</span>
                          <i class="bi bi-chevron-down toggle-icon"></i>
                        </div>
                        <div id="collapseAdminPengaturan3" class="collapse">
                            <ul>
                                <li>Klik ikon titik tiga.</li>
                                <li><i>Untuk kemudahan, disarankan untuk mengunduh data yang sudah ada terlebih dahulu dengan menggunakan fitur "Ekspor Excel".</i></li>
                                <li>Buka file Excel yang telah diekspor, lalu klik "Edit".</li>
                                <li>Tambahkan data baru sesuai dengan kolom yang tersedia (biarkan kolom `created_at` dan `updated_at` kosong).</li>
                                <li>Setelah selesai, simpan file tersebut dan lakukan impor kembali ke dalam sistem.</li>
                            </ul>
                        </div>
                      <!-- dropdown 4 -->
                        <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseAdminPengaturan4">
                          <span>Menghapus Data Kelas</span>
                          <i class="bi bi-chevron-down toggle-icon"></i>
                        </div>
                        <div id="collapseAdminPengaturan4" class="collapse">
                            <ul>
                                <li>Buka dropdown "Kelas".</li>
                                <li>Pilih kelas yang akan dihapus dengan mencentang checkbox di samping tahun angkatan (lebih dari satu kelas dapat dipilih).</li>
                                <li>Klik tombol "Hapus" yang berwarna merah.</li>
                                <li>Konfirmasi penghapusan dengan mengklik tombol "Hapus" pada notifikasi yang muncul.</li>
                            </ul>
                        </div>
              </ul>
            </div>
          </div>
        </div>
        <!-- Card admin - END-->

        <!-- Card User_Edit - START -->
        <div class="card User_Edit">
            <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_Edit">
              <span>{{ $datauser->firstWhere('role', 'User_Edit')->username ?? 'Guru' }}</span>
              <i class="bi bi-chevron-down toggle-icon"></i>
            </div>
            <div id="collapseUser_Edit" class="collapse">
              <div class="card-body">
                <p>Halaman yang dapat diakses:</p>
                <ul>
                  <li>Poin Siswa</li>
                <!-- dropdown 1 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_EditPoinSiswa1">
                    <span>Pencarian Data Poin Siswa</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseUser_EditPoinSiswa1" class="collapse">
                    <ul>
                      <li>Pencarian data siswa dapat dilakukan dengan menggunakan NIS atau nama siswa.</li>
                      <li>Setelah memasukkan NIS atau nama siswa pada kolom pencarian, klik tombol "Cari".</li>
                      <li>Untuk menampilkan kembali semua data, klik ikon "X" merah pada kolom pencarian yang telah terisi.</li>
                    </ul>
                  </div>
                <!-- dropdown 2 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_EditPoinSiswa2">
                    <span>Menambahkan Poin pada Siswa</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseUser_EditPoinSiswa2" class="collapse">
                    <ul>
                      <li>Klik tombol kuning bertuliskan "Tambahkan".</li>
                      <li>Isi data secara berurutan dimulai dari memilih kelas (tingkatan, konsentrasi keahlian, dan konsentrasi ke-), nama siswa, jenis kelamin, tipe poin, dan nama poin. Jika memilih tipe poin negatif, akan muncul kolom tambahan untuk mengunggah foto bukti perilaku yang dilakukan oleh siswa.</li>
                      <li>Setelah semua data terisi dengan benar, klik tombol "Tambah Poin" untuk menambahkan data.</li>
                      <li>Untuk membatalkan atau keluar dari formulir, klik tombol "Kembali" atau tekan tombol "Cancel" yang terletak di kanan atas formulir.</li>
                    </ul>
                  </div>
                <!-- dropdown 3 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_EditPoinSiswa3">
                    <span>Riwayat Poin yang Diterima Siswa</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseUser_EditPoinSiswa3" class="collapse">
                    <ul>
                      <li>Pada sisi kanan tabel terdapat kolom "Aksi", yang berfungsi untuk melihat detail riwayat poin siswa. Klik tombol tersebut untuk melihat detailnya.</li>
                      <li>Halaman detail poin siswa akan ditampilkan setelah tombol tersebut diklik.</li>
                      <li>Untuk menghapus poin, pilih poin yang ingin dihapus dengan menggunakan checkbox, lalu klik tombol "Hapus" yang terletak di atas tabel.</li>
                      <li>Untuk kembali ke halaman "Poin Siswa", tekan tombol panah yang mengarah ke kiri di sudut kiri atas halaman.</li>
                    </ul>
                  </div>
                <!-- dropdown 4 -->
                  <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_EditPoinSiswa4">
                    <span>Melakukan Tindakan terhadap Siswa dengan Poin Negatif Tertentu</span>
                    <i class="bi bi-chevron-down toggle-icon"></i>
                  </div>
                  <div id="collapseUser_EditPoinSiswa4" class="collapse">
                    <ul>
                        <li>Klik salah satu tombol notifikasi yang berada di atas kolom pencarian, yang tersedia dalam beberapa kategori.</li>
                        <li>Setelah masuk ke halaman notifikasi, siswa/i yang masuk ke dalam kategori dengan jumlah poin tersebut dapat dilihat.</li>
                        <li>Perbaikan dapat dilakukan dengan menambahkan poin positif sebagai tindakan untuk mengurangi poin negatif siswa.</li>
                        <li>Untuk kembali ke halaman "Poin Siswa", tekan tombol panah yang mengarah ke kiri di sudut kiri atas halaman.</li>
                    </ul>
                  </div>

                  <li>Laporan</li>
                    <!-- dropdown 1 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_EditLaporan1">
                        <span>Mengkategorikan Laporan yang Tampil</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                      <div id="collapseUser_EditLaporan1" class="collapse">
                        <ul>
                            <li>Klik tombol "Kategorikan".</li>
                            <li>Terdapat 5 kategori yang dapat dipilih, isi sesuai dengan kebutuhan.</li>
                            <li>Setelah kriteria yang dibutuhkan terisi dengan benar, klik tombol "Cari".</li>
                            <li>Untuk menampilkan kembali semua data, klik tombol "Kategorikan", kosongkan semua kategori yang telah diisi sebelumnya, dan klik "Cari".</li>
                            <li>Untuk keluar dari formulir, klik tombol "Kembali" atau tekan tombol "X" yang terletak di kanan atas formulir.</li>
                        </ul>
                      </div>
                    <!-- dropdown 2 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_EditLaporan2">
                        <span>Mengunduh Laporan dalam format PDF</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                        <div id="collapseUser_EditLaporan2" class="collapse">
                            <ul>
                            <li>Klik tombol "Unduh PDF".</li>
                            <li>Jika ingin mengunduh berdasarkan kategori tertentu, kategorikan terlebih dahulu, kemudian klik "Unduh PDF".</li>
                            <li>Laporan akan otomatis terunduh.</li>
                        </ul>
                      </div>
                    <!-- dropdown 3 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser_EditLaporan3">
                        <span>Mengunduh Laporan dalam format Excel</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                      <div id="collapseUser_EditLaporan3" class="collapse">
                        <ul>
                            <li>Klik tombol "Unduh Excel".</li>
                            <li><i>Untuk unduhan Excel, tidak ada pilihan kategori yang dapat dipilih.</i></li>
                            <li>Laporan akan otomatis terunduh.</li>
                        </ul>
                      </div>
                </ul>
              </div>
            </div>
          </div>
        <!-- Card User_Edit - END -->


        <!-- Card User1 Dan user2 - START -->
        <div class="card User">
            <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser">
              <span>{{ $datauser->firstWhere('role', 'User1')->username ?? 'Kesiswaan' }}, {{ $datauser->firstWhere('role', 'User2')->username ?? 'Osis' }}</span>
              <i class="bi bi-chevron-down toggle-icon"></i>
            </div>
            <div id="collapseUser" class="collapse">
              <div class="card-body">
                <p>Halaman yang dapat diakses:</p>
                <ul>
                  <li>Laporan</li>
                    <!-- dropdown 1 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUserLaporan1">
                        <span>Mengkategorikan Laporan yang Tampil</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                      <div id="collapseUserLaporan1" class="collapse">
                        <ul>
                            <li>Klik tombol "Kategorikan".</li>
                            <li>Terdapat 5 kategori yang dapat dipilih, isi sesuai dengan kebutuhan.</li>
                            <li>Setelah kriteria yang dibutuhkan terisi dengan benar, klik tombol "Cari".</li>
                            <li>Untuk menampilkan kembali semua data, klik tombol "Kategorikan", kosongkan semua kategori yang telah diisi sebelumnya, dan klik "Cari".</li>
                            <li>Untuk keluar dari formulir, klik tombol "Kembali" atau tekan tombol "X" yang terletak di kanan atas formulir.</li>
                        </ul>
                      </div>
                    <!-- dropdown 2 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUserLaporan2">
                        <span>Mengunduh Laporan dalam format PDF</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                        <div id="collapseUserLaporan2" class="collapse">
                            <ul>
                            <li>Klik tombol "Unduh PDF".</li>
                            <li>Jika ingin mengunduh berdasarkan kategori tertentu, kategorikan terlebih dahulu, kemudian klik "Unduh PDF".</li>
                            <li>Laporan akan otomatis terunduh.</li>
                        </ul>
                      </div>
                    <!-- dropdown 3 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUserLaporan3">
                        <span>Mengunduh Laporan dalam format Excel</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                      <div id="collapseUserLaporan3" class="collapse">
                        <ul>
                            <li>Klik tombol "Unduh Excel".</li>
                            <li><i>Untuk unduhan Excel, tidak ada pilihan kategori yang dapat dipilih.</i></li>
                            <li>Laporan akan otomatis terunduh.</li>
                        </ul>
                      </div>
                </ul>
              </div>
            </div>
          </div>
        <!-- Card User1 dan user2 - END -->


        <!-- Card User3 - START -->
        <div class="card User3">
            <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser3">
              <span>{{ $datauser->firstWhere('role', 'User3')->username ?? 'Kesiswaan' }}</span>
              <i class="bi bi-chevron-down toggle-icon"></i>
            </div>
            <div id="collapseUser3" class="collapse">
              <div class="card-body">
                <p>Halaman yang dapat diakses:</p>
                <ul>
                  <li>Laporan</li>
                    <!-- dropdown 1 -->
                      <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseUser3Laporan1">
                        <span>Mengkategorikan Laporan yang Tampil</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                      </div>
                      <div id="collapseUser3Laporan1" class="collapse">
                        <ul>
                            <li>Klik tombol "Kategorikan".</li>
                            <li>Terdapat 5 kategori yang dapat dipilih, isi sesuai dengan kebutuhan.</li>
                            <li>Setelah kriteria yang dibutuhkan terisi dengan benar, klik tombol "Cari".</li>
                            <li>Untuk menampilkan kembali semua data, klik tombol "Kategorikan", kosongkan semua kategori yang telah diisi sebelumnya, dan klik "Cari".</li>
                            <li>Untuk keluar dari formulir, klik tombol "Kembali" atau tekan tombol "X" yang terletak di kanan atas formulir.</li>
                        </ul>
                      </div>
                </ul>
              </div>
            </div>
          </div>
        <!-- Card User3 - END -->
      </div>
    </div>
  <!-- PETUNJUK PENGGUNA - END -->
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const headers = document.querySelectorAll('.card-header');
        headers.forEach(header => {
            header.addEventListener('click', () => {
                const icon = header.querySelector('i');
                if (icon) {
                    icon.classList.toggle('bi-chevron-down');
                    icon.classList.toggle('bi-chevron-up');
                }
            });
        });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const toggler = document.querySelector('[data-bs-target="#navbarCollapse"]');
      const navbarCollapse = document.getElementById('navbarCollapse');
      const icon = toggler.querySelector('.toggle-icon');

      navbarCollapse.addEventListener('shown.bs.collapse', () => {
        icon.style.transform = 'rotate(180deg)'; // Terbalik
      });

      navbarCollapse.addEventListener('hidden.bs.collapse', () => {
        icon.style.transform = 'rotate(0deg)'; // Normal
      });
    });
  </script>
@endpush
</body>
</html>