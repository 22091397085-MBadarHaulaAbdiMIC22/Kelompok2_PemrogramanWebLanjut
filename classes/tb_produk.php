<?php

// Include the Database class
include_once '../classes/Databases.php';

// Produk class for handling product-related operations
class Produk {
    // Database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all products
    public function getAllProduk() {
        $sql = "SELECT * FROM tb_produk";
        return $this->db->fetchAll($sql);
    }

    // Method to get a product by ID
    public function getProdukById($produk_id) {
        $sql = "SELECT * FROM tb_produk WHERE produk_id = ?";
        return $this->db->fetchSingle($sql, [$produk_id]);
    }

    // Method to insert a new product
    public function insertProduk($produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $created_at, $updated_at) {
        $sql = "INSERT INTO tb_produk (produk_id_kat, produk_id_user, produk_kode, produk_nama, produk_hrg, produk_keterangan, produk_stock, produk_photo, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, [$produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $created_at, $updated_at]);
        return $this->db->getLastInsertedId();
    }

    // Method to update a product
    public function updateProduk($produk_id, $produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $updated_at) {
        $sql = "UPDATE tb_produk SET produk_id_kat = ?, produk_id_user = ?, produk_kode = ?, produk_nama = ?, produk_hrg = ?, produk_keterangan = ?, produk_stock = ?, produk_photo = ?, updated_at = ? WHERE produk_id = ?";
        $this->db->executeQuery($sql, [$produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $updated_at, $produk_id]);
    }

    // Method to delete a product
    public function deleteProduk($produk_id) {
        $sql = "DELETE FROM tb_produk WHERE produk_id = ?";
        $this->db->executeQuery($sql, [$produk_id]);
    }
}

?>
