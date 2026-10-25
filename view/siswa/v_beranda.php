<?php
/**
 * Halaman Beranda / Landing Page Siswa - Pengaduan Sarana Sekolah
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Pengaduan Sarana & Prasarana Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; } 
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between text-slate-800">

    <!-- NAVBAR UTAMA -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-3">
                <div class="bg-emerald-600 text-white p-2.5 rounded-2xl shadow-md shadow-emerald-600/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4Tentu! Mengingat proyek sebelumnya yang Anda buat adalah **Aplikasi Perpustakaan Digital** dengan gaya estetika modern berwarna hijau *sage* yang sangat rapi, kita bisa mengadaptasi gaya *landing page* tersebut ke dalam proyek **Sistem Pengaduan Sarana dan Prasarana Sekolah (Sarpras)** ini.

Kita akan pertahankan nuansa warna hijau *sage* (`emerald` / `slate` lembut) yang elegan, dengan tata letak dua kolom (hero section text di kiri, dan *feature card* interaktif di kanan) yang sangat mirip, namun isinya disesuaikan khusus untuk fitur pengaduan sarana sekolah.

Berikut adalah kode lengkap untuk halaman **Landing Page / Beranda Siswa (`v_beranda.php`)** yang baru:

```php
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Pengaduan Sarana & Prasarana Sekolah</title>
    <script src="[https://cdn.tailwindcss.com](https://cdn.tailwindcss.com)"></script>
    <link href="[https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap](https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap)" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f5; } 
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between text-slate-800">

    <!-- Navbar Atas -->
    <header class="w-full bg-white/80 backdrop-blur-md border-b border-emerald-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-emerald-700 flex items-center justify-center text-white shadow-md shadow-emerald-700/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg tracking-tight text-slate-900 leading-none">SarprasVerse</h1>
                    <span class="text-xs font-medium text-emerald-800">Pengaduan Fasilitas Sekolah</span>
                </div>
            </div>

            <!-- Menu Navigasi Tengah -->
            <nav class="hidden md:flex items-center space-x-2 bg-emerald-50/60 p-1.5 rounded-2xl border border-emerald-100/60">
                <a href="index.php?c=siswa&a=index" class="px-5 py-2 rounded-xl text-sm font-semibold bg-white text-emerald-900 shadow-sm transition">Beranda</a>
                <a href="index.php?c=siswa&a=riwayat" class="px-5 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-emerald-900 transition">Riwayat Laporan</a>
            </nav>

            <!-- Menu Kanan (Aksi Auth) -->
            <div class="flex items-center space-x-3">
                <?php if (isset($_SESSION['login'])): ?>
                    <a href="index.php?c=siswa&a=buatAspirasi" class="hidden sm:inline-flex items-center space-x-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 px-4 py-2.5 rounded-2xl text-sm font-semibold transition border border-emerald-200">
                        <span>Buat Pengaduan</span>
                    </a>
                    <a href="index.php?c=auth&a=logout" onclick="return confirm('Keluar dari sistem?')" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-2xl text-sm font-semibold transition shadow-md shadow-red-600/20">Logout</a>
                <?php else: ?>
                    <a href="index.php?c=auth&a=login" class="bg-emerald-700 hover:bg-emerald-800 text-white px-6 py-2.5 rounded-2xl text-sm font-semibold transition shadow-md shadow-emerald-700/20 flex items-center space-x-2">
                        <span>Login Siswa</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Section Utama -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <!-- Kolom Kiri: Teks & Pencarian / Tombol Aksi -->
        <div class="lg:col-span-7 space-y-8">
            <!-- Badge Atas -->
            <div class="inline-flex items-center space-x-2 bg-emerald-100/80 border border-emerald-200 px-3.5 py-1.5 rounded-full">
                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                <span class="text-xs font-bold text-emerald-900 tracking-wide uppercase">Layanan Cepat & Transparan • SMK Bisa & Hebat</span>
            </div>

            <!-- Judul Utama -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                Laporkan Kerusakan <span class="text-emerald-800">Sarana Sekolah</span> dengan Mudah & Cepat
            </h1>

            <!-- Deskripsi -->
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                Selamat datang di portal pengaduan fasilitas sekolah digital. Sampaikan aspirasi, kerusakan meubeler, perangkat laboratorium, atau fasilitas kelas lainnya agar segera ditindaklanjuti oleh tim sarpras.
            </p>

            <!-- Tombol Aksi Cepat -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 pt-2">
                <a href="index.php?c=siswa&a=buatAspirasi" class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-8 py-4 rounded-2xl text-center shadow-lg shadow-emerald-700/25 transition flex items-center justify-center space-x-2">
                    <span>Buat Pengaduan Sekarang</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="index.php?c=siswa&a=riwayat" class="bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-semibold px-6 py-4 rounded-2xl text-center transition shadow-sm">
                    Cek Status Laporan
                </a>
            </div>

            <!-- Kategori Cepat / Quick Badges -->
            <div class="pt-4 border-t border-slate-200/60 flex flex-wrap items-center gap-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori Umum:</span>
                <span class="bg-emerald-50 text-emerald-800 text-xs font-medium px-3 py-1.5 rounded-xl border border-emerald-100">🏫 Ruang Kelas</span>
                <span class="bg-emerald-50 text-emerald-800 text-xs font-medium px-3 py-1.5 rounded-xl border border-emerald-100">💻 Lab Komputer</span>
                <span class="bg-emerald-50 text-emerald-800 text-xs font-medium px-3 py-1.5 rounded-xl border border-emerald-100">⚡ Kelistrikan</span>
            </div>
        </div>

        <!-- Kolom Kanan: Card Fitur Unggulan (Mirip LibraryVerse) -->
        <div class="lg:col-span-5">
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/80 p-6 sm:p-8 space-y-4 relative overflow-hidden">
                
                <!-- Hiasan latar belakang tipis -->
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-emerald-50 rounded-full blur-2xl pointer-events-none"></div>

                <!-- Kartu Item 1 -->
                <div class="flex items-start space-x-4 p-4 rounded-2xl bg-slate-50/70 border border-slate-100 hover:border-emerald-200 transition">
                    <div class="p-3 bg-emerald-100 text-emerald-800 rounded-xl font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-800 text-sm">Pengaduan Real-Time</h3>
                            <span class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full">UKK RPL</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Sampaikan laporan lengkap dengan foto kondisi sarana.</p>
                    </div>
                </div>

                <!-- Kartu Item 2 -->
                <div class="flex items-start space-x-4 p-4 rounded-2xl bg-slate-50/70 border border-slate-100 hover:border-emerald-200 transition">
                    <div class="p-3 bg-orange-50 text-orange-600 rounded-xl font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-slate-800 text-sm">Tracking Status Laporan</h3>
                        <p class="text-xs text-slate-500 mt-1">Pantau progres perbaikan dari status Menunggu, Proses, hingga Selesai.</p>
                    </div>
                </div>

                <!-- Kartu Item 3 -->
                <div class="flex items-start space-x-4 p-4 rounded-2xl bg-slate-50/70 border border-slate-100 hover:border-emerald-200 transition">
                    <div class="p-3 bg-purple-50 text-purple-600 rounded-xl font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-slate-800 text-sm">Feedback & Tanggapan Admin</h3>
                        <p class="text-xs text-slate-500 mt-1">Dapatkan respon langsung dan catatan histori perbaikan dari petugas.</p>
                    </div>
                </div>

                <!-- Tombol Bawah Card -->
                <a href="index.php?c=siswa&a=buatAspirasi" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3.5 rounded-2xl text-center text-sm transition block shadow-md">
                    Mulai Buat Laporan Pengaduan
                </a>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="w-full bg-white border-t border-slate-200 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500">
            <p>&copy; 2026 Uji Kompetensi Keahlian (UKK) RPL • Sistem Pengaduan Sarana Sekolah</p>
            <p class="mt-2 sm:mt-0 font-medium text-emerald-800">Dibangun dengan Arsitektur MVC & PHP OOP</p>
        </div>
    </footer>

</body>
</html>