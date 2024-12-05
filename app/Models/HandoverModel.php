<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class HandoverModel extends Model
{
    protected $table      = 'assessment_handover';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        "org_unit_code",
        "body_id",
        "clinic_id",
        "class_room_id",
        "handover_by",
        "handover_date",
        "handover_sign",
        "received_by",
        "received_date",
        "received_sign",
        "modified_by",
        "modified_date"
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
