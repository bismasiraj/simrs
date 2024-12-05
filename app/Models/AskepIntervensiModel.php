<?php

namespace App\Models;


use CodeIgniter\Model;

class AskepIntervensiModel extends Model
{
    protected $table      = 'ASKEP_SDKI_INTERVENSI_RESULTS';
    protected $primaryKey = 'body_id';


    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'document_id',
        'body_id',
        'diagnosan_id',
        'intervensi_id',
        'tindakan_id',
        'intervensi_date',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien',
    ];

    protected $useTimestamps = false; // Use false if manually setting timestamps
}


// class AskepSlkiluaranModel extends Model
// {
//     protected $table      = 'askep_sdki_luaran_results';
//     protected $primaryKey = 'body_id';

//     protected $useAutoIncrement = false;

//     protected $returnType     = 'array';
//     protected $useSoftDeletes = false;

//     protected $allowedFields = [
//         'org_unit_code',
//         'visit_id',
//         'trans_id',
//         'document_id',
//         'body_id',
//         'diagnosan_id',
//         'luaran_id',
//         'kriteria_id',
//         'p_type',
//         'parameter_id',
//         'value_id',
//         'value_score',
//         'value_desc',
//         'result_date',
//         'modified_date',
//         'modified_by',
//         'valid_date',
//         'valid_user',
//         'valid_pasien'
//     ];

//     protected $useTimestamps = false; // Use false if manually setting timestamps
// }