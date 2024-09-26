<?php

namespace App\Models;

use CodeIgniter\Model;

class RsaKeyModel extends Model
{
    protected $table = 'rsa_keys'; // Nama tabel di database

    protected $primaryKey = 'id'; // Kolom kunci utama

    protected $useAutoIncrement = 'true';

    protected $allowedFields = ['id', 'private_key', 'public_key']; // Kolom yang diizinkan untuk disimpan

    public function getPrivateKey()
    {
        // dd($this->db->query("SELECT private_key FROM {$this->table}")->getRow()->private_key);
        return $this->db->query("SELECT private_key FROM {$this->table}")->getRow()->private_key;
    }
    public function getPublicKey()
    {
        return $this->db->query("SELECT public_key FROM {$this->table}")->getRow()->public_key;
    }

    public function saveKeys($privateKey, $publicKey)
    {
        $this->db->query("DELETE FROM {$this->table}"); // Hapus kunci lama jika perlu

        $data = [
            'id' => 1,
            'private_key' => $privateKey,
            'public_key'  => $publicKey
        ];

        $this->insert($data); // Simpan kunci baru
    }
}
