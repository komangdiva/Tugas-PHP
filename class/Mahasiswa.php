<?php
    class Mahasiswa {
        private $db;

        public function __construct() {
        $this->db = new Database();
        }
    }