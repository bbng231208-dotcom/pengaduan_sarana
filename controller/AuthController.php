<?php
require_once __DIR__ . '/../model/M_Auth.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new M_Auth();
    }

    public function login() {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['level'] == 'admin') {
                header("Location: index.php?c=admin&a=index");
                exit;
            } else if ($_SESSION['level'] == 'siswa') {
                header("Location: index.php?c=siswa&a=index");
                exit;
            }
        }
        require_once __DIR__ . '/../view/auth/v_login.php';
    }

    public function prosesLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username_nis = trim($_POST['username']);
            $password = trim($_POST['password']);
            $level = $_POST['level'];

            if ($level == 'admin') {
                $user = $this->model->loginAdmin($username_nis, $password);
                if ($user) {
                    $_SESSION['login'] = true;
                    $_SESSION['id_user'] = $user['id_admin'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                    $_SESSION['level'] = 'admin';
                    header("Location: index.php?c=admin&a=index");
                    exit;
                }
            } else {
                $user = $this->model->loginSiswa($username_nis, $password);
                if ($user) {
                    $_SESSION['login'] = true;
                    $_SESSION['nis'] = $user['nis'];
                    $_SESSION['nama_lengkap'] = $user['nama'];
                    $_SESSION['kelas'] = $user['kelas'];
                    $_SESSION['level'] = 'siswa';
                    header("Location: index.php?c=siswa&a=index");
                    exit;
                }
            }

            $_SESSION['error'] = "Username/NIS atau Password salah!";
            header("Location: index.php?c=auth&a=login");
            exit;
        }
    }

    public function register() {
        require_once __DIR__ . '/../view/auth/v_register.php';
    }

    public function prosesRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nis' => trim($_POST['nis']),
                'nama' => trim($_POST['nama']),
                'kelas' => trim($_POST['kelas']),
                'alamat' => trim($_POST['alamat']),
                'telp' => trim($_POST['telp']),
                'password' => trim($_POST['password'])
            ];
            if ($this->model->registerSiswa($data)) {
                $_SESSION['success'] = "Pendaftaran berhasil! Silakan login.";
                header("Location: index.php?c=auth&a=login");
                exit;
            } else {
                $_SESSION['error'] = "Pendaftaran gagal! NIS sudah terdaftar.";
                header("Location: index.php?c=auth&a=register");
                exit;
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php?c=auth&a=login");
        exit;
    }
}
?>