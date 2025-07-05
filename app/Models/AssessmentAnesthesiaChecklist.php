<?php

namespace App\Models;

use CodeIgniter\Model;


class AssessmentAnesthesiaChecklist extends Model
{
    protected $table = 'ASSESSMENT_ANESTHESI_CHECKLIST';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'anesthesia_machine_on',
        'oxygen_tube',
        'flow_meter',
        'power_on',
        'circuit_leackage',
        'volatil',
        'face_mask',
        'laringoskop',
        'ett_lma',
        'stylet',
        'spuit_cuff',
        'ekg_cable',
        'nibp_connection',
        'stetoscope',
        'suction_tube',
        'bandage',
        'nasal_cannula',
        'intravenous_line',
        'spuit_size',
        'epinefrin',
        'atropin',
        'sedative',
        'opioid',
        'muscle_relaxant',
        'intravena_fluid',
        'other_fluid'
    ];
}