<?php
/**
 * Controller AdminController - Mengelola Fitur Sisi Admin
 */
require_once __DIR__ . '/../model/M_Aspirasi.php';
require_once __DIR__ . '/../model/M_Siswa.php';

class AdminController {
    private $modelAspirasi;
    private $modelSiswa;

    public function __construct() {
        if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
            header("Location: index.php?c=auth&a=login");
            exit;
        }
        $this->modelAspirasi = new M_Aspirasi();
        $this->modelSiswa = new M_Siswa();
    }

    public function index() {
        $filter = [
            'tanggal' => $_GET['tanggal'] ?? '',
            'bulan' => $_GET['bulan'] ?? '',
            'nis' => $_GET['nis'] ?? '',
            'id_kategori' => $_GET['id_kategori'] ?? ''
        ];
        $aspirasiList = $this->modelAspirasi->getAllAspirasi($filter);
        $kategoriList = $this->modelAspirasi->getAllKategori();
        $siswaList = $this->modelSiswa->getAllSiswa();
        require_once __DIR__ . '/../view/admin/v_dashboard.php';
    }

    // Fitur Hapus Pengaduan oleh Admin
    public function hapusAspirasi() {
        if (isset($_GET['id'])) {
            $this->modelAspirasi->hapusAspirasi($_GET['id']);
            $_SESSION['success'] = "Laporan pengaduan berhasil dihapus!";
        }
        header("Location: index.php?c=admin&a=index");
        exit;
    }

    // Fitur Kelola Anggota / Siswa (Menampilkan Halaman)
    public function kelolaSiswa() {
        $siswaList = $this->modelSiswa->getAllSiswa();
        require_once __DIR__ . '/../view/admin/v_kelola_siswa.php';
    }

    // Fitur Tambah Siswa
    public function tambahSiswa() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nis   = trim($_POST['nis']);
            $nama  = trim($_POST['nama']);
            $kelas = trim($_POST['kelas']);

            $hasil = $this->modelSiswa->tambahSiswa($nis, $nama, $kelas);

            if ($hasil) {
                $_SESSION['success'] = "Data anggota / siswa berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menyimpan data. Pastikan NIS belum terdaftar.";
            }
        }
        header("Location: index.php?c=admin&a=kelolaSiswa");
        exit;
    }

    // Fitur Update / Edit Siswa
    public function updateSiswa() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nisLama = trim($_POST['nis_lama']);
            $nisBaru = trim($_POST['nis']);
            $nama    = trim($_POST['nama']);
            $kelas   = trim($_POST['kelas']);

            $hasil = $this->modelSiswa->updateSiswa($nisLama, $nisBaru, $nama, $kelas);

            if ($hasil) {
                $_SESSION['success'] = "Data anggota / siswa berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui data siswa.";
            }
        }
        header("Location: index.php?c=admin&a=kelolaSiswa");
        exit;
    }

    // Fitur Hapus Data Siswa oleh Admin
    public function hapusSiswa() {
        if (isset($_GET['nis'])) {
            $this->modelSiswa->hapusSiswa($_GET['nis']);
            $_SESSION['success'] = "Data siswa berhasil dihapus!";
        }
        header("Location: index.php?c=admin&a=kelolaSiswa");
        exit;
    }

    // Menampilkan Halaman Kelola Kategori
    public function kelolaKategori() {
        $kategoriList = $this->modelAspirasi->getAllKategori();
        require_once __DIR__ . '/../view/admin/v_kategori.php';
    }

    // Fitur Tambah Kategori (Disesuaikan namanya agar sinkron dengan form v_kategori.php)
    public function tambahKategori() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ket_kategori = trim($_POST['ket_kategori'] ?? '');
            
            if (!empty($ket_kategori)) {
                $this->modelAspirasi->tambahKategori($ket_kategori);
                $_SESSION['success'] = "Kategori berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Keterangan kategori tidak boleh kosong!";
            }

            header("Location: index.php?c=admin&a=kelolaKategori");
            exit;
        }
    }

    // Fitur Update Kategori (Melengkapi fungsi modal edit di view)
    public function updateKategori() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_kategori  = $_POST['id_kategori'] ?? '';
            $ket_kategori = trim($_POST['ket_kategori'] ?? '');

            if (!empty($id_kategori) && !empty($ket_kategori)) {
                // Pastikan method updateKategori sudah ada di model M_Aspirasi
                $this->modelAspirasi->updateKategori($id_kategori, $ket_kategori);
                $_SESSION['success'] = "Kategori berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui kategori.";
            }

            header("Location: index.php?c=admin&a=kelolaKategori");
            exit;
        }
    }

    // Fitur Hapus Kategori
    public function hapusKategori() {
        if (isset($_GET['id'])) {
            $this->modelAspirasi->hapusKategori($_GET['id']);
            $_SESSION['success'] = "Kategori berhasil dihapus!";
        }
        header("Location: index.php?c=admin&a=kelolaKategori");
        exit;
    }

    // Fitur Feedback / Tanggapan Aspirasi
    public function prosesFeedback() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->modelAspirasi->updateStatusDanFeedback($_POST['id_aspirasi'], $_POST['status'], $_POST['feedback'], $_SESSION['id_user']);
            $_SESSION['success'] = "Tanggapan dan status berhasil diperbarui!";
            header("Location: index.php?c=admin&a=index");
            exit;
        }
    }
}
?>