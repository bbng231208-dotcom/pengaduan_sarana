<?php
/**
 * Model M_Siswa - Mengelola Data Siswa
 */
require_once __DIR__ . '/Model.php';

class M_Siswa extends Model {

    // Ambil semua data siswa (untuk kebutuhan Admin)
    public function getAllSiswa() {
        $query = "SELECT * FROM siswa ORDER BY nama ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil data siswa berdasarkan NIS
    public function getSiswaByNis($nis) {
        $query = "SELECT * FROM siswa WHERE nis = :nis";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nis', $nis);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah data siswa baru (DITAMBAHKAN)
    public function tambahSiswa($nis, $nama, $kelas) {
        $query = "INSERT INTO siswa (nis, nama, kelas) VALUES (:nis, :nama, :kelas)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nis', $nis);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':kelas', $kelas);
        return $stmt->execute();
    }

    // Update data siswa (DIKEMBANGKAN untuk Admin: mendukung perubahan NIS lama ke NIS baru)
    public function updateSiswa($nisLama, $nisBaru, $nama, $kelas) {
        $query = "UPDATE siswa SET nis = :nis_baru, nama = :nama, kelas = :kelas WHERE nis = :nis_lama";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nis_baru', $nisBaru);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':kelas', $kelas);
        $stmt->bindParam(':nis_lama', $nisLama);
        return $stmt->execute();
    }

    // Hapus data siswa
    public function hapusSiswa($nis) {
        $query = "DELETE FROM siswa WHERE nis = :nis";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nis', $nis);
        return $stmt->execute();
    }
}
?>