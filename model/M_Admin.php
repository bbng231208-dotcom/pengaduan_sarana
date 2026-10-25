<?php
/**
 * Model M_Admin - Mengelola Data dan Operasional Admin / Petugas
 */
require_once __DIR__ . '/Model.php';

class M_Admin extends Model {

    // Ambil data admin berdasarkan ID
    public function getAdminById($id_admin) {
        $query = "SELECT * FROM admin WHERE id_admin = :id_admin";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_admin', $id_admin);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update profil atau password admin
    public function updateAdmin($id_admin, $data) {
        $query = "UPDATE admin SET nama_lengkap = :nama_lengkap, telp = :telp WHERE id_admin = :id_admin";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_admin', $id_admin);
        $stmt->bindParam(':nama_lengkap', $data['nama_lengkap']);
        $stmt->bindParam(':telp', $data['telp']);
        return $stmt->execute();
    }
}
?>