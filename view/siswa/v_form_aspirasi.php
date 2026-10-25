<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Aspirasi - Pengaduan Sarpras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; background-color: #f8fafc; } </style>
</head>
<body class="min-h-screen py-10">
    <div class="max-w-2xl mx-auto px-4">
        
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-slate-800">Form Aspirasi Kerusakan Sarpras</h1>
                <a href="index.php?c=siswa&a=index" class="text-sm font-medium text-indigo-600 hover:underline">&larr; Kembali</a>
            </div>

            <form action="index.php?c=siswa&a=simpanAspirasi" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Kategori Sarana / Kerusakan</label>
                    <select name="id_kategori" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?= $kat['id_kategori']; ?>"><?= $kat['ket_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Lokasi / Ruangan</label>
                    <input type="text" name="lokasi" required placeholder="Contoh: Lab Komputer 1 / Gedung A Lantai 2" 
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Keterangan / Detail Kerusakan</label>
                    <textarea name="ket" rows="4" required placeholder="Jelaskan kerusakan sarana secara detail..." 
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Lampiran Foto Bukti (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" 
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3.5 rounded-2xl shadow-lg shadow-indigo-600/30 transition">
                    Kirim Aspirasi Sekarang
                </button>

            </form>
        </div>

    </div>
</body>
</html>