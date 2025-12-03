<?php
    class Mahasiswa {
        private $db;

        public function __construct() {
        $this->db = new Database();
        }

        public function getAll() {
            $sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        }

         public function getById($id) {
            $sql = "SELECT * FROM mahasiswa WHERE id = :id LIMIT 1";
            $stmt = $this->db->query($sql, ['id' => $id]);
            return $stmt->fetch();
        }

         public function insert($data) {
            $sql = "INSERT INTO mahasiswa (nama, nim, prodi, angkatan, foto_path, status, created_at)
                VALUES (:nama, :nim, :prodi, :angkatan, :foto_path, :status, NOW())";

            return $this->db->query($sql, [
                'nama'      => $data['nama'],
                'nim'       => $data['nim'],
                'prodi'     => $data['prodi'],
                'angkatan'  => $data['angkatan'],
                'foto_path' => $data['foto_path'],
                'status'    => $data['status']
            ]);
        }

        public function update($id, $data) {
            $sql = "UPDATE mahasiswa 
                SET nama = :nama,
                    nim = :nim,
                    prodi = :prodi,
                    angkatan = :angkatan,
                    foto_path = :foto_path,
                    status = :status,
                    updated_at = NOW()
                WHERE id = :id";

            return $this->db->query($sql, [
                'nama'      => $data['nama'],
                'nim'       => $data['nim'],
                'prodi'     => $data['prodi'],
                'angkatan'  => $data['angkatan'],
                'foto_path' => $data['foto_path'],
                'status'    => $data['status'],
                'id'        => $id
            ]);
        }

        public function delete($id) {
            $old = $this->getById($id);

            if (!empty($old['foto_path'])) {
            $file = __DIR__ . '/../' . $old['foto_path'];
                if (file_exists($file)) {
                    @unlink($file);
                }
            }

            $sql = "DELETE FROM mahasiswa WHERE id = :id";
            return $this->db->query($sql, ['id' => $id]);
        }
    }