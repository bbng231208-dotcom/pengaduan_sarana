<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Anggota - Panel Admin</title>
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
                <a href="index.php?c=admin&a=index" class="text-sm text-indigo-300 hover:text-white transition font-medium">← Kembali ke Dashboard</a>
                <span class="text-sm text-slate-300">Halo, <b><?= $_SESSION['nama_lengkap'] ?? 'Admin'; ?></b></span>
                <a href="index.php?c=auth&a=logout" onclick="return confirm('Keluar dari panel admin?')" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl text-sm font-medium transition shadow-md">Logout</a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl mb-6 text-sm">
                ✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Anggota -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-8">
            <h2 class="text-lg font-bold text-slate-800 mb-4">Tambah Anggota / Siswa Baru</h2>
            <form action="index.php?c=admin&a=tambahSiswa" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">NIS</label>
                    <input type="text" name="nis" required placeholder="Nomor Induk Siswa" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Nama Siswa" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Kelas</label>
                    <input type="text" name="kelas" required placeholder="Contoh: XII RPL 1" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2.5 text-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-2xl text-sm transition shadow-md">Simpan Anggota</button>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Anggota -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Daftar Anggota / Siswa</h2>
            <?php if (empty($siswaList)): ?>
                <div class="text-center py-12 text-slate-400"><p>Belum ada data anggota.</p></div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-xs uppercase text-slate-400 font-semibold tracking-wider">
                                <th class="py-3 px-4 w-16 text-center">No</th>
                                <th class="py-3 px-4">NIS</th>
                                <th class="py-3 px-4">Nama Lengkap</th>
                                <th class="py-3 px-4">Kelas</th>
                                <th class="py-3 px-4 text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            <?php $no = 1; foreach ($siswaList as $row): ?>
                                <tr>
                                    <td class="py-4 px-4 text-center font-medium text-slate-400"><?= $no++; ?></td>
                                    <td class="py-4 px-4 font-medium text-slate-800"><?= $row['nis']; ?></td>
                                    <td class="py-4 px-4 font-bold text-slate-800"><?= $row['nama']; ?></td>
                                    <td class="py-4 px-4"><?= $row['kelas']; ?></td>
                                    <td class="py-4 px-4 text-center space-x-2">
                                        <button onclick="openEditSiswa('<?= $row['nis']; ?>', '<?= htmlspecialchars($row['nama'], ENT_QUOTES); ?>', '<?= htmlspecialchars($row['kelas'], ENT_QUOTES); ?>')" class="bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold px-3 py-1.5 rounded-xl text-xs transition">
                                            Edit
                                        </button>
                                        <a href="index.php?c=admin&a=hapusSiswa&nis=<?= $row['nis']; ?>" onclick="return confirm('Yakin ingin menghapus anggota ini?')" class="bg-red-50 hover:bg-red-100 text-red-700 font-semibold px-3 py-1.5 rounded-xl text-xs transition">
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

    <!-- Modal Edit Siswa -->
    <div id="editSiswaModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-8 shadow-2xl">
            <h3 class="text-xl font-bold text-slate-800 mb-4">Edit Anggota / Siswa</h3>
            <form action="index.php?c=admin&a=updateSiswa" method="POST" class="space-y-4">
                <input type="hidden" name="nis_lama" id="editNisLama">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">NIS</label>
                    <input type="text" name="nis" id="editNis" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="editNama" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Kelas</label>
                    <input type="text" name="kelas" id="editKelas" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeEditSiswa()" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-2xl transition text-sm">Batal</button>
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-2xl transition text-sm shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditSiswa(nis, nama, kelas) {
            document.getElementById('editNisLama').value = nis;
            document.getElementById('editNis').value = nis;
            document.getElementById('editNama').value = nama;
            document.getElementById('editKelas').value = kelas;
            document.getElementById('editSiswaModal').classList.remove('hidden');
            document.getElementById('editSiswaModal').classList.add('flex');
        }
        function closeEditSiswa() {
            document.getElementById('editSiswaModal').classList.remove('flex');
            document.getElementById('editSiswaModal').classList.add('hidden');
        }
    </script>
</body>
</html>