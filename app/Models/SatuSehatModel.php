<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuSehatModel extends Model
{
    protected $table      = 'satu_sehat';
    protected $primaryKey = 'trans_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    // Dates
    protected $useTimestamps = false;

    public function getppkrujukan($search)
    {
        return $this->like('name_of_rujukan', $search)
            ->findAll();
    }
}
