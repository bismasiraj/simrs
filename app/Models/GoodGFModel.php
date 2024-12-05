<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class GoodGfModel extends Model
{
    protected $table      = 'good_gf';
    protected $primaryKey = 'item_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    protected $allowedFields = [
        'org_unit_code',
        'size_goods',
        'brand_name',
        'brand_id',
        'measure_dosis',
        'measure_id2',
        'measure_id3',
        'distribution_type',
        'price',
        'order_price',
        'discount',
        'discount2',
        'corrections',
        'diminta',
        'quantity',
        'condition',
        'invoice_id',
        'po',
        'allocated_date',
        'item_id',
        'org_id',
        'org_unit_from',
        'company_id',
        'retur_id',
        'rooms_id',
        'allocated_from',
        'doc_no',
        'isoutlet',
        'from_rooms_id',
        'discountoff',
        'dijual',
        'invoice_id2',
        'month_id',
        'year_id',
        'correction_doc',
        'stock_opname',
        'stok_awal',
        'stock_lalu',
        'stock_koreksi',
        'diterima',
        'distribusi',
        'dihapus',
        'diretur',
        'batch_no',
    ];

    // Dates
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    public function getHistoryObatResep($nomor, $soldStatus, $visitId)
    {
        $select = $this->select("org_unit_code as org_unit_code,
                            size_goods as dose,
                            brand_name as description,
                            brand_id as brand_id,
                            measure_dosis as measure_id,
                            measure_id2 as measure_id2,
                            measure_id3 as measure_id2,
                            distribution_type as racikan,
                            price as amount,
                            order_price as sell_price,
                            discount as subsidi,
                            discount2 as discount,
                            corrections as description2,
                            diminta as dose_presc,
                            quantity as quantity,
                            condition as numer,
                            invoice_id as resep_no,
                            po as nota_no,
                            allocated_date as treat_date,
                            item_id as bill_id,
                            org_id as clinic_id,
                            org_unit_from as clinic_id_from,
                            company_id as no_registration,
                            retur_id as trans_id,
                            rooms_id as clinic_id,
                            allocated_from as thename,
                            doc_no as theid,
                            isoutlet as soldstatus,
                            from_rooms_id as modified_from,
                            dijual as quantity,
                            'Alkses/BMHP' as treatment,
                            '' as employee_id,
                            batch_no as visit_id")
            ->where('company_id', $nomor)
            ->where('batch_no', $visitId)
            ->where("allocated_date > dateadd(month,-3,getdate())")
            ->orderBy('batch_no, treat_date')
            ->findAll();
        return $select;
    }
}
