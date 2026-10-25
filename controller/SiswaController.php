<?php
/**
 * Controller SiswaController - Mengelola Fitur Sisi Siswa
 */
require_once __DIR__ . '/../model/M_Aspirasi.php';
require_once __DIR__ . '/../model/M_Siswa.php';

class SiswaController {
    private $modelAspirasi;
    private $modelSiswa;

    public function __construct() {
        // Hapus pembatasan ketat di __construct jika halaman beranda (index) 
        // ingin bisa diakses pengunjung umum / siswa sebelum login.
        // Pengecekan login dipindahkan ke method spesifik yang membutuhkan autentikasi.
        $this->modelAspirasi = new M_Aspirasi();
        $this->modelSiswa = new M_Siswa();
    }

    // Halaman Beranda / Landing Page Siswa
    public function index() {
        // Memuat halaman beranda baru yang senada dengan tema perpustakaan
        require_once __DIR__ . '/../view/siswa/v_beranda.php';
    }

    // Halaman Dashboard / Riwayat Pengaduan Siswa (Wajib Login)
    public function riwayat() {
        if (!isset($_SESSION['login']) || $_SESSION['level'] != 'siswa') {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        $nis = $_SESSION['nis'];
        $aspirasiList = $this->modelAspirasi->getAspirasiByNis($nis);
        require_once __DIR__ . '/../view/siswa/v_dashboard.php';
    }

    // Menampilkan Form Buat Aspirasi (Wajib Login)
    public function formAspirasi() {
        if (!isset($_SESSION['login']) || $_SESSION['level'] != 'siswa') {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        $kategoriList = $this->modelAspirasi->getAllKategori();
        require_once __DIR__ . '/../view/siswa/v_form_aspirasi.php';
    }

    // Alias jika di view memanggil a=buatAspirasi
    public function buatAspirasi() {
        $this->formAspirasi();
    }

    // Proses Simpan Pengaduan
    public function simpanAspirasi() {
        if (!isset($_SESSION['login']) || $_SESSION['level'] != 'siswa') {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nis' => $_SESSION['nis'],
                'id_kategori' => trim($_POST['id_kategori']),
                'lokasi' => trim($_POST['lokasi']),
                'ket' => trim($_POST['ket']),
                'foto' => ''
            ];

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $ekstensi = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
                if (in_array($ekstensi, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $fotoName = uniqid() . '.' . $ekstensi;
                    $targetDir = __DIR__ . '/../assets/uploads/';
                    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                    move_uploaded_file($_FILES['foto']['tmp_name'], $targetDir . $fotoName);
                    $data['foto'] = $fotoName;
                }
            }

            if ($this->modelAspirasi->tambahAspirasi($data)) {
                $_SESSION['success'] = "Aspirasi berhasil dikirim!";
            } else {
                $_SESSION['error'] = "Gagal mengirim aspirasi.";
            }
            header("Location: index.php?c=siswa&a=riwayat");
            exit;
        }
    }
}
?>