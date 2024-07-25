<?php

namespace App\Models;

use CodeIgniter\Model;

class RujukanModel extends Model
{
    protected $table      = 'RUJUKAN';
    protected $primaryKey = 'rujukan_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    public function getppkrujukan($search)
    {
        return $this->like('name_of_rujukan', $search)
            ->findAll();
    }
}
