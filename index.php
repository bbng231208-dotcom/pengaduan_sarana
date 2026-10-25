<?php
/**
 * Aplikasi Pengaduan Sarana Sekolah (UKK RPL Paket 3)
 * Arsitektur: Object-Oriented Programming (OOP) - Model View Controller (MVC)
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Jakarta');

// Autoload Core & Database
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/model/Model.php';

// Daftar Controller yang didukung
$controllers = [
    'auth'     => 'AuthController',
    'admin'    => 'AdminController',
    'siswa'    => 'SiswaController',
    'aspirasi' => 'AspirasiController'
];

// Diubah default-nya ke controller 'siswa' dan action 'index' (Landing Page)
$c = isset($_GET['c']) ? strtolower(trim($_GET['c'])) : 'siswa';
$a = isset($_GET['a']) ? trim($_GET['a']) : 'index';

if (!array_key_exists($c, $controllers)) {
    $c = 'siswa';
}

$controllerClass = $controllers[$c];
$controllerFile  = __DIR__ . '/controller/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();

        if (method_exists($controllerInstance, $a)) {
            $controllerInstance->$a();
            exit;
        } else {
            if (method_exists($controllerInstance, 'index')) {
                $controllerInstance->index();
                exit;
            }
        }
    }
}

header("Location: index.php?c=siswa&a=index");
exit;
?>