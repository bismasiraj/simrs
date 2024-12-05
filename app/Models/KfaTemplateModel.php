<?php

namespace App\Models;

use CodeIgniter\Model;

class KfaTemplateModel extends Model
{
    protected $table      = 'kfa_template';
    protected $primaryKey = 'kfa_code';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $allowedFields = [
        'kfa_code',
        'name',
        'state',
        'active',
        'updated_at',
        'display_name',
    ];
}
