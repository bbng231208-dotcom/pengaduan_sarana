<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Pengaduan Sarpras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .table-row-hover:hover { background-color: #f1f5f9; transition: background 0.2s ease; }
    </style>
</head>
<body class="min-h-screen">

    <!-- Navbar Siswa -->
    <nav class="bg-indigo-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center space-x-3">
                <span class="bg-blue-600 px-3 py-1.5 rounded-xl font-bold tracking-wider">PS</span>
                <span class="font-bold text-lg tracking-wide">Pengaduan Sarpras Siswa</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-indigo-200 hidden sm:inline">Halo, <b><?= $_SESSION['nama_lengkap']; ?></b> (<?= $_SESSION['kelas']; ?>)</span>
                <a href="index.php?c=auth&a=logout" onclick="return confirm('Keluar dari aplikasi?')" class="bg-red-600/80 hover:bg-red-600 px-4 py-2 rounded-xl text-sm font-medium transition shadow-md">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl mb-6 text-sm shadow-sm">
                ✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Banner Aksi -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl font-bold mb-2">Ada Sarana Sekolah yang Rusak?</h1>
                <p class="text-blue-100 max-w-xl text-sm md:text-base">Laporkan kendala fasilitas sarana dan prasarana sekolah agar segera ditindaklanjuti oleh petugas terkait.</p>
            </div>
            <a href="index.php?c=siswa&a=formAspirasi" class="bg-white text-indigo-900 font-semibold px-6 py-3.5 rounded-2xl shadow-lg hover:bg-blue-50 transition transform active:scale-95 flex items-center space-x-2">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Buat Pengaduan Baru</span>
            </a>
        </div>

        <!-- Tabel Aspirasi Siswa -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Daftar Aspirasi & Histori Saya</h2>

            <?php if (empty($aspirasiList)): ?>
                <div class="text-center py-12 text-slate-400">
                    <p>Belum ada pengaduan sarana yang kamu sampaikan.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-xs uppercase text-slate-400 font-semibold tracking-wider">
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4">Lokasi</th>
                                <th class="py-3 px-4">Keterangan</th>
                                <th class="py-3 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            <?php foreach ($aspirasiList as $row): ?>
                                <tr class="table-row-hover">
                                    <td class="py-4 px-4 font-medium text-slate-800"><?= $row['tgl_pengaduan']; ?></td>
                                    <td class="py-4 px-4"><span class="bg-slate-100 px-3 py-1 rounded-xl text-slate-700 font-medium text-xs"><?= $row['ket_kategori']; ?></span></td>
                                    <td class="py-4 px-4"><?= $row['lokasi']; ?></td>
                                    <td class="py-4 px-4 max-w-xs truncate"><?= $row['ket']; ?></td>
                                    <td class="py-4 px-4">
                                        <?php if ($row['status'] == 'Menunggu'): ?>
                                            <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-semibold">Menunggu</span>
                                        <?php elseif ($row['status'] == 'Proses'): ?>
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Proses</span>
                                        <?php else: ?>
                                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>