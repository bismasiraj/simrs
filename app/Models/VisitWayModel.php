<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitWayModel extends Model
{
    protected $table      = 'visit_way';
    protected $primaryKey = 'way_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
