<?php

namespace App\Models;

use CodeIgniter\Model;

class KfaIngredientModel extends Model
{
    protected $table      = 'kfa_ingredient';
    protected $primaryKey = 'kfa_code';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $allowedFields = [
        'kfa_code',
        'state',
        'active',
        'zat_aktif',
        'updated_at',
        'kekuatan_zat_aktif',
    ];
}
