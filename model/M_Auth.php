<?php
require_once __DIR__ . '/Model.php';

class M_Auth extends Model {
    public function loginAdmin($username, $password) {
        $query = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $pass_md5 = md5($password);
        $stmt->bindParam(':password', $pass_md5);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function loginSiswa($nis, $password) {
        $query = "SELECT * FROM siswa WHERE nis = :nis AND password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nis', $nis);
        $pass_md5 = md5($password);
        $stmt->bindParam(':password', $pass_md5);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerSiswa($data) {
        try {
            $query = "INSERT INTO siswa (nis, nama, kelas, alamat, telp, password) VALUES (:nis, :nama, :kelas, :alamat, :telp, :password)";
            $stmt = $this->db->prepare($query);
            $pass_md5 = md5($data['password']);
            $stmt->bindParam(':nis', $data['nis']);
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':kelas', $data['kelas']);
            $stmt->bindParam(':alamat', $data['alamat']);
            $stmt->bindParam(':telp', $data['telp']);
            $stmt->bindParam(':password', $pass_md5);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>