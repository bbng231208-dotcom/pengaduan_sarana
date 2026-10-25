<?php
/**
 * Model M_Aspirasi - Mengelola Data Aspirasi, Kategori, Histori, dan Feedback
 */
require_once __DIR__ . '/Model.php';

class M_Aspirasi extends Model {
    
    public function getAllKategori() {
        $query = "SELECT * FROM kategori ORDER BY ket_kategori ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambahKategori($ket_kategori) {
        $query = "INSERT INTO kategori (ket_kategori) VALUES (:ket_kategori)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ket_kategori', $ket_kategori);
        return $stmt->execute();
    }

    // Penambahan method updateKategori untuk fitur Edit Kategori
    public function updateKategori($id_kategori, $ket_kategori) {
        $query = "UPDATE kategori SET ket_kategori = :ket_kategori WHERE id_kategori = :id_kategori";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ket_kategori', $ket_kategori);
        $stmt->bindParam(':id_kategori', $id_kategori);
        return $stmt->execute();
    }

    public function hapusKategori($id_kategori) {
        $query = "DELETE FROM kategori WHERE id_kategori = :id_kategori";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_kategori', $id_kategori);
        return $stmt->execute();
    }

    public function tambahAspirasi($data) {
        $query = "INSERT INTO aspirasi (nis, id_kategori, lokasi, ket, foto, status) VALUES (:nis, :id_kategori, :lokasi, :ket, :foto, 'Menunggu')";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nis', $data['nis']);
        $stmt->bindParam(':id_kategori', $data['id_kategori']);
        $stmt->bindParam(':lokasi', $data['lokasi']);
        $stmt->bindParam(':ket', $data['ket']);
        $stmt->bindParam(':foto', $data['foto']);
        
        if ($stmt->execute()) {
            $id_aspirasi = $this->db->lastInsertId();
            $this->tambahHistori($id_aspirasi, 'Menunggu', 'Laporan berhasil dibuat oleh siswa.');
            return true;
        }
        return false;
    }

    public function updateAspirasi($id_aspirasi, $data) {
        $query = "UPDATE aspirasi SET id_kategori = :id_kategori, lokasi = :lokasi, ket = :ket WHERE id_aspirasi = :id_aspirasi";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_aspirasi', $id_aspirasi);
        $stmt->bindParam(':id_kategori', $data['id_kategori']);
        $stmt->bindParam(':lokasi', $data['lokasi']);
        $stmt->bindParam(':ket', $data['ket']);
        return $stmt->execute();
    }

    public function hapusAspirasi($id_aspirasi) {
        $query = "DELETE FROM aspirasi WHERE id_aspirasi = :id_aspirasi";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_aspirasi', $id_aspirasi);
        return $stmt->execute();
    }

    public function getAspirasiByNis($nis) {
        $query = "SELECT aspirasi.*, kategori.ket_kategori FROM aspirasi JOIN kategori ON aspirasi.id_kategori = kategori.id_kategori WHERE aspirasi.nis = :nis ORDER BY aspirasi.tgl_pengaduan DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nis', $nis);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAspirasi($filter = []) {
        $query = "SELECT aspirasi.*, siswa.nama, siswa.kelas, kategori.ket_kategori FROM aspirasi JOIN siswa ON aspirasi.nis = siswa.nis JOIN kategori ON aspirasi.id_kategori = kategori.id_kategori WHERE 1=1";
        
        if (!empty($filter['tanggal'])) {
            $query .= " AND DATE(aspirasi.tgl_pengaduan) = " . $this->db->quote($filter['tanggal']);
        }
        if (!empty($filter['bulan'])) {
            $query .= " AND DATE_FORMAT(aspirasi.tgl_pengaduan, '%Y-%m') = " . $this->db->quote($filter['bulan']);
        }
        if (!empty($filter['nis'])) {
            $query .= " AND aspirasi.nis = " . $this->db->quote($filter['nis']);
        }
        if (!empty($filter['id_kategori'])) {
            $query .= " AND aspirasi.id_kategori = " . $this->db->quote($filter['id_kategori']);
        }

        $query .= " ORDER BY aspirasi.tgl_pengaduan DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHistoriByAspirasi($id_aspirasi) {
        $query = "SELECT * FROM histori WHERE id_aspirasi = :id_aspirasi ORDER BY tgl_histori ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_aspirasi', $id_aspirasi);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatusDanFeedback($id_aspirasi, $status, $feedback_text, $id_admin) {
        $query = "UPDATE aspirasi SET status = :status WHERE id_aspirasi = :id_aspirasi";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_aspirasi', $id_aspirasi);
        $stmt->execute();

        $queryFB = "INSERT INTO feedback (id_aspirasi, feedback, id_admin) VALUES (:id_aspirasi, :feedback, :id_admin)";
        $stmtFB = $this->db->prepare($queryFB);
        $stmtFB->bindParam(':id_aspirasi', $id_aspirasi);
        $stmtFB->bindParam(':feedback', $feedback_text);
        $stmtFB->bindParam(':id_admin', $id_admin);
        $stmtFB->execute();

        $this->tambahHistori($id_aspirasi, $status, "Status diperbaharui menjadi: " . $status);
        return true;
    }

    private function tambahHistori($id_aspirasi, $status_perubahan, $keterangan) {
        $query = "INSERT INTO histori (id_aspirasi, status_perubahan, keterangan) VALUES (:id_aspirasi, :status_perubahan, :keterangan)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_aspirasi', $id_aspirasi);
        $stmt->bindParam(':status_perubahan', $status_perubahan);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->execute();
    }
}
?>