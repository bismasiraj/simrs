<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassRoomModel extends Model
{
    protected $table      = 'class_room';
    protected $primaryKey = 'class_room_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getKamar()
    {
        $builder = $this->join('clinic', 'CLASS_ROOM.clinic_id=clinic.clinic_id')
            ->select('clinic.name_of_clinic,
            CLASS_ROOM.NAME_OF_CLASS ,
            CLASS_ROOM.CLASS_ROOM_ID,
            (SELECT COUNT(BED_ID) FROM BEDS WHERE
            CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) AS cap,
            CLASS_ROOM.class_id,
            CLASS_ROOM.tarif_id,
            CLASS_ROOM.clinic_id,
            CLASS_ROOM.ORG_UNIT_CODE,
            (SELECT COUNT(no_registration) FROM treatment_akomodasi pv WHERE
             pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID and
             pv.class_room_id is not null
             and (pv.keluar_id = 0 or pv.keluar_id=33) AND  pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) AS ISI,
            (SELECT SUM(TC.AMOUNT) FROM TARIF_COMP TC, treat_tarif TT
             WHERE TC.TARIF_ID = CLASS_ROOM.tarif_id AND TC.TARIF_ID = TT.TARIF_ID ) AS TARIF')
            ->where('class_room_id <> \'0\'')
            ->where('CLASS_ROOM.isactive', 1)
            ->orderBy('name_of_clinic, NAME_OF_CLASS');
        return $builder->findAll();
    }
}
