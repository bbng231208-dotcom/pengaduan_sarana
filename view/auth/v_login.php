<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Pengaduan Sarana Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #1e3a8a 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.15); }
        .custom-input { background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); color: #ffffff; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full glass-card rounded-3xl shadow-2xl p-8 text-white">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold tracking-wide">Pengaduan Sarpras</h1>
            <p class="text-sm text-blue-200 mt-1">Sistem Informasi Pengaduan & Aspirasi Sarana Sekolah</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-2xl mb-6 text-sm">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-200 px-4 py-3 rounded-2xl mb-6 text-sm">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?c=auth&a=prosesLogin" method="POST" class="space-y-5">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-blue-200 mb-2">Pilih Level Login</label>
                <select name="level" id="levelSelect" onchange="toggleLevel()" class="custom-input w-full rounded-2xl px-4 py-3">
                    <option value="siswa" class="bg-slate-900 text-white">Siswa</option>
                    <option value="admin" class="bg-slate-900 text-white">Admin</option>
                </select>
            </div>
            <div>
                <label id="labelUsername" class="block text-xs font-semibold uppercase tracking-wider text-blue-200 mb-2">NIS (Nomor Induk Siswa)</label>
                <input type="text" name="username" id="inputUsername" required placeholder="Contoh: 10101" class="custom-input w-full rounded-2xl px-4 py-3">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-blue-200 mb-2">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="custom-input w-full rounded-2xl px-4 py-3">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold py-3.5 rounded-2xl shadow-lg transition">
                Masuk ke Aplikasi
            </button>
        </form>
        <div id="registerLink" class="text-center mt-6 text-sm text-slate-300">
            Belum punya akun siswa? <a href="index.php?c=auth&a=register" class="text-blue-400 font-semibold hover:underline">Daftar di sini</a>
        </div>
    </div>
    <script>
        function toggleLevel() {
            const level = document.getElementById('levelSelect').value;
            const label = document.getElementById('labelUsername');
            const input = document.getElementById('inputUsername');
            const regLink = document.getElementById('registerLink');
            if (level === 'admin') {
                label.innerText = 'Username Admin';
                input.placeholder = 'Masukkan username admin';
                regLink.style.display = 'none';
            } else {
                label.innerText = 'NIS (Nomor Induk Siswa)';
                input.placeholder = 'Contoh: 10101';
                regLink.style.display = 'block';
            }
        }
    </script>
</body>
</html>