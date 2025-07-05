<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class GrouperModel extends Model
{
    protected $table      = 'grouper';
    protected $primaryKey = 'no_sep';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'no_sep',
        'grouper_stage',
        'grouper_type',
        'code',
        'descriptions',
        'tarif',
        'modified_by',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';

    function getGrouper($nomor_sep)
    {
        $result = $this->where("no_sep", $nomor_sep)->findAll();
        $response = [];
        $response['metadata']['code'] = 200;
        $response['metadata']['message'] = 'ok';
        $data = [];

        foreach ($result as $key => $value) {
            if ($value['GROUPER_TYPE'] == 1) {
                $data['cbg'] = [
                    'code' => $value['CODE'],
                    'description' => $value['DESCRIPTIONS'],
                    'tariff' => $value['TARIF']
                ];
            }
            if ($value['GROUPER_TYPE'] == 2) {
                $data['sub_acute'] = [
                    'code' => $value['CODE'],
                    'description' => $value['DESCRIPTIONS'],
                    'tariff' => $value['TARIF']
                ];
            }
            if ($value['GROUPER_TYPE'] == 3) {
                $data['chronic'] = [
                    'code' => $value['CODE'],
                    'description' => $value['DESCRIPTIONS'],
                    'tariff' => $value['TARIF']
                ];
            }
            if ($value['GROUPER_TYPE'] == 4) {
                $data['special_prosthesis'] = [
                    'code' => $value['CODE'],
                    'description' => $value['DESCRIPTIONS'],
                    'tariff' => $value['TARIF']
                ];
            }
            if ($value['GROUPER_TYPE'] == 5) {
                $data['special_pricedure'] = [
                    'code' => $value['CODE'],
                    'description' => $value['DESCRIPTIONS'],
                    'tariff' => $value['TARIF']
                ];
            }
            if ($value['GROUPER_TYPE'] == 6) {
                $data['special_investigation'] = [
                    'code' => $value['CODE'],
                    'description' => $value['DESCRIPTIONS'],
                    'tariff' => $value['TARIF']
                ];
            }
            if ($value['GROUPER_TYPE'] == 7) {
                $data['special_drug'] = [
                    'code' => $value['CODE'],
                    'description' => $value['DESCRIPTIONS'],
                    'tariff' => $value['TARIF']
                ];
            }
        }

        $response['response'] = $data;
        return $response;
    }
}
