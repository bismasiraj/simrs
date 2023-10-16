<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitReasonModel extends Model
{
    protected $table      = 'visit_reason';
    protected $primaryKey = 'reason_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
