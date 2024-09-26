<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class TreatDocsModel extends Model
{
    protected $table      = 'treat_docs';
    protected $primaryKey = 'doc_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'doc_id',
        'visit_id',
        'nota_no',
        'docfiles',
        'update_date',
        'upload_by',
        'conclution',
        'modified_date',
        'modified_by',
        'doc_type',
        'doc_ke',
        'clinic_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'upload_date';
    protected $updatedField  = 'modified_date';
}
