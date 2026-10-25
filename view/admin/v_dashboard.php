<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pengaduan Sarpras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; background-color: #f8fafc; } </style>
</head>
<body class="min-h-screen">
    <nav class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center space-x-3">
                <span class="bg-indigo-600 px-3 py-1.5 rounded-xl font-bold tracking-wider">ADM</span>
                <span class="font-bold text-lg tracking-wide">Panel Admin Sarpras</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="index.php?c=admin&a=kelolaSiswa" class="text-sm text-indigo-300 hover:text-white transition font-medium">+ Kelola Anggota</a>
                <a href="index.php?c=admin&a=kelolaKategori" class="text-sm text-indigo-300 hover:text-white transition font-medium">+ Kelola Kategori</a>
                <span class="text-sm text-slate-300">Halo, <b><?= $_SESSION['nama_lengkap']; ?></b></span>
                <a href="index.php?c=auth&a=logout" onclick="return confirm('Keluar dari panel admin?')" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-sm font-medium transition shadow-md">Logout</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl mb-6 text-sm">
                ✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Filter Laporan -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-8">
            <h2 class="text-lg font-bold text-slate-800 mb-4">Filter Laporan Aspirasi</h2>
            <form action="index.php" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <input type="hidden" name="c" value="admin">
                <input type="hidden" name="a" value="index">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Per Tanggal</label>
                    <input type="date" name="tanggal" value="<?= $_GET['tanggal'] ?? ''; ?>" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-3 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Per Bulan</label>
                    <input type="month" name="bulan" value="<?= $_GET['bulan'] ?? ''; ?>" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-3 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Per Siswa</label>
                    <select name="nis" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-3 py-2.5 text-sm">
                        <option value="">-- Semua Siswa --</option>
                        <?php foreach ($siswaList as $s): ?>
                            <option value="<?= $s['nis']; ?>" <?= (isset($_GET['nis']) && $_GET['nis'] == $s['nis']) ? 'selected' : ''; ?>><?= $s['nama']; ?> (<?= $s['nis']; ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Per Kategori</label>
                    <select name="id_kategori" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-3 py-2.5 text-sm">
                        <option value="">-- Semua Kategori --</option>
                        <?php foreach ($kategoriList as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>" <?= (isset($_GET['id_kategori']) && $_GET['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>><?= $k['ket_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-2xl text-sm transition">Filter</button>
                    <a href="index.php?c=admin&a=index" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2.5 px-4 rounded-2xl text-sm transition text-center">Reset</a>
                </div>
            </form>
        </div>

        <!-- Tabel List Aspirasi -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">List Aspirasi Keseluruhan</h2>
            <?php if (empty($aspirasiList)): ?>
                <div class="text-center py-12 text-slate-400"><p>Tidak ada data pengaduan yang ditemukan.</p></div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-xs uppercase text-slate-400 font-semibold tracking-wider">
                                <th class="py-3 px-4">Tanggal & Siswa</th>
                                <th class="py-3 px-4">Kategori & Lokasi</th>
                                <th class="py-3 px-4">Keterangan</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi / Tanggapan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            <?php foreach ($aspirasiList as $row): ?>
                                <tr>
                                    <td class="py-4 px-4">
                                        <div class="font-bold text-slate-800"><?= $row['nama']; ?></div>
                                        <div class="text-xs text-slate-400"><?= $row['kelas']; ?> | <?= $row['tgl_pengaduan']; ?></div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="bg-slate-100 px-2.5 py-1 rounded-xl text-slate-700 font-medium text-xs"><?= $row['ket_kategori']; ?></span>
                                        <div class="text-xs text-slate-500 mt-1"><?= $row['lokasi']; ?></div>
                                    </td>
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
                                    <td class="py-4 px-4 text-center space-x-2">
                                        <button onclick="openModal(<?= $row['id_aspirasi']; ?>, '<?= $row['status']; ?>')" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold px-3 py-1.5 rounded-xl text-xs transition">
                                            Tanggapan
                                        </button>
                                        <a href="index.php?c=admin&a=hapusAspirasi&id=<?= $row['id_aspirasi']; ?>" onclick="return confirm('Yakin ingin menghapus laporan ini?')" class="bg-red-50 hover:bg-red-100 text-red-700 font-semibold px-3 py-1.5 rounded-xl text-xs transition">
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

    <!-- Modal Feedback Admin -->
    <div id="feedbackModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl">
            <h3 class="text-xl font-bold text-slate-800 mb-4">Umpan Balik & Update Status</h3>
            <form action="index.php?c=admin&a=prosesFeedback" method="POST" class="space-y-4">
                <input type="hidden" name="id_aspirasi" id="modalIdAspirasi">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Ubah Status</label>
                    <select name="status" id="modalStatus" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm">
                        <option value="Menunggu">Menunggu</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Tanggapan / Feedback</label>
                    <textarea name="feedback" rows="4" required placeholder="Tuliskan umpan balik perbaikan..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm"></textarea>
                </div>
                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeModal()" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-2xl transition text-sm">Batal</button>
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-2xl transition text-sm shadow-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, status) {
            document.getElementById('modalIdAspirasi').value = id;
            document.getElementById('modalStatus').value = status;
            document.getElementById('feedbackModal').classList.remove('hidden');
            document.getElementById('feedbackModal').classList.add('flex');
        }
        function closeModal() {
            document.getElementById('feedbackModal').classList.remove('flex');
            document.getElementById('feedbackModal').classList.add('hidden');
        }
    </script>
</body>
</html>