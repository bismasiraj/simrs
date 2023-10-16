<?php

namespace App\Models;

use CodeIgniter\Model;

class InasisFaskesModel
extends Model
{
    protected $table      = 'inasis_get_faskes';
    protected $primaryKey = 'kdprovider';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
