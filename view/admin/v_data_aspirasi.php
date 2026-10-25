<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aspirasi & Pengaduan - Panel Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; background-color: #f8fafc; } </style>
</head>
<body class="min-h-screen">
    <!-- Navbar -->
    <nav class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center space-x-3">
                <span class="bg-indigo-600 px-3 py-1.5 rounded-xl font-bold tracking-wider">ADM</span>
                <span class="font-bold text-lg tracking-wide">Panel Admin Sarpras</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="index.php?c=admin&a=index" class="text-sm text-indigo-300 hover:text-white transition font-medium">← Kembali ke Dashboard</a>
                <span class="text-sm text-slate-300">Halo, <b><?= $_SESSION['nama_lengkap'] ?? 'Admin'; ?></b></span>
                <a href="index.php?c=auth&a=logout" onclick="return confirm('Keluar dari panel admin?')" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-sm font-medium transition shadow-md">Logout</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Notifikasi Sukses / Gagal -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl mb-6 text-sm">
                ✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Tabel Data Aspirasi -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Kelola Data Aspirasi & Pengaduan Siswa</h2>

            <?php if (empty($aspirasiList)): ?>
                <div class="text-center py-12 text-slate-400">
                    <p>Belum ada data pengaduan sarana dan prasarana.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-xs uppercase text-slate-400 font-semibold tracking-wider">
                                <th class="py-3 px-4 w-16 text-center">No</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Siswa (NIS)</th>
                                <th class="py-3 px-4">Kategori & Lokasi</th>
                                <th class="py-3 px-4">Keterangan</th>
                                <th class="py-3 px-4 text-center">Status</th>
                                <th class="py-3 px-4 text-center w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            <?php $no = 1; foreach ($aspirasiList as $row): ?>
                                <tr>
                                    <td class="py-4 px-4 text-center font-medium text-slate-400"><?= $no++; ?></td>
                                    <td class="py-4 px-4 text-xs text-slate-500"><?= $row['tgl_pengaduan']; ?></td>
                                    <td class="py-4 px-4">
                                        <div class="font-bold text-slate-800"><?= htmlspecialchars($row['nama']); ?></div>
                                        <div class="text-xs text-slate-400">Kelas: <?= htmlspecialchars($row['kelas']); ?> (<?= $row['nis']; ?>)</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="font-semibold text-indigo-600"><?= htmlspecialchars($row['ket_kategori']); ?></div>
                                        <div class="text-xs text-slate-500">📍 <?= htmlspecialchars($row['lokasi']); ?></div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <p class="text-slate-700"><?= htmlspecialchars($row['ket']); ?></p>
                                        <?php if (!empty($row['foto'])): ?>
                                            <a href="assets/uploads/<?= $row['foto']; ?>" target="_blank" class="text-xs text-indigo-500 hover:underline mt-1 inline-block">📸 Lihat Lampiran Foto</a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <?php 
                                            $status = $row['status'];
                                            $badgeColor = 'bg-amber-50 text-amber-700 border-amber-200';
                                            if ($status == 'Proses') $badgeColor = 'bg-blue-50 text-blue-700 border-blue-200';
                                            if ($status == 'Selesai') $badgeColor = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                        ?>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold border <?= $badgeColor; ?>">
                                            <?= $status; ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-center space-y-1">
                                        <a href="index.php?c=admin&a=hapusAspirasi&id=<?= $row['id_aspirasi']; ?>" onclick="return confirm('Yakin ingin menghapus laporan ini?')" class="block bg-red-50 hover:bg-red-100 text-red-700 font-semibold px-3 py-1.5 rounded-xl text-xs transition">
                                            Hapus
                                        </a>
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