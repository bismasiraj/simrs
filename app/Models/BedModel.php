<?php

namespace App\Models;

use CodeIgniter\Model;

class BedsModel extends Model
{
    protected $table      = 'beds';
    protected $primaryKey = 'class_room_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['sslocationbed_id'];

    // Dates
    protected $useTimestamps = false;
}
