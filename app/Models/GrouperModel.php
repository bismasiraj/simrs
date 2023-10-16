<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class GrouperModel extends Model
{
    protected $table      = 'grouper';
    protected $primaryKey = 'no_sep';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'no_sep',
        'grouper_stage',
        'grouper_type',
        'code',
        'descriptions',
        'tarif',
        'modified_by',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
