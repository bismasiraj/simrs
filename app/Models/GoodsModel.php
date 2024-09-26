<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class GoodsModel extends Model
{
    protected $table      = 'goods';
    protected $primaryKey = 'brand_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    public function getObatDokter($brand, $dokter)
    {
        //     $sql = "SP_SEARCHOBATNAMAALL_DOCTOR 
        //     @brand = '%'
        //    ,@nama = '%$brand%'
        //    ,@aktif = '1'
        //    ,@org = ''
        //    ,@room = ''
        //    ,@tgl = ''
        //    ,@alkes = '%'
        //    ,@dokter = '$dokter'";
        //     $result = $this->db->query(new RawSql($sql));
        //     return $result->getResultArray();

        $select = $this->join('setting s', '1 = 1', 'inner')
            ->like('name', $brand)
            ->where('isalkes <> 1')
            ->where('isalkes <> 100')
            ->where('isactive', '1')
            ->where('code_5 <> \'%\'')
            ->select('GOODS.NAME, goods.net_price AS SELL_PRICE,    
                    100 AS STOCKnya,GOODS.OTHER_CODE,size_kemasan,
                    GOODS.BRAND_ID,SIZE_GOODS, goods.measure_id, goods.measure_id2,goods.measure_id3,
                    goods.code_5 ,goods.take_rule,
                    goods.isgeneric, goods.status_pasien_id, 
                    goods.measure_dosis, isactive, 
                    STOCK, 
                    0 as stockroom,
                    goods.isalkes, s.margininternal, s.marginluar,s.diskoninternal,s.diskonluar, s.ppn,
                    goods.order_price as avgprice,
                    goods.HET , goods.COMPANY_ID')->findAll();

        return $select;
    }
    public function getObatAlkesDokter($brand, $dokter)
    {
        //     $sql = "SP_SEARCHOBATNAMAALL_DOCTOR 
        //     @brand = '%'
        //    ,@nama = '%$brand%'
        //    ,@aktif = '1'
        //    ,@org = ''
        //    ,@room = ''
        //    ,@tgl = ''
        //    ,@alkes = '%'
        //    ,@dokter = '$dokter'";
        //     $result = $this->db->query(new RawSql($sql));
        //     return $result->getResultArray();

        $select = $this->join('setting s', '1 = 1', 'inner')
            ->like('name', $brand)
            ->where('isactive', '1')
            ->where('isalkes', '1')
            ->select('GOODS.NAME, goods.net_price AS SELL_PRICE,    
                    100 AS STOCKnya,GOODS.OTHER_CODE,size_kemasan,
                    GOODS.BRAND_ID,SIZE_GOODS, goods.measure_id, goods.measure_id2,goods.measure_id3,
                    goods.code_5 ,goods.take_rule,
                    goods.isgeneric, goods.status_pasien_id, 
                    goods.measure_dosis, isactive, 
                    STOCK, 
                    0 as stockroom,
                    goods.isalkes, s.margininternal, s.marginluar,s.diskoninternal,s.diskonluar, s.ppn,
                    goods.order_price as avgprice,
                    goods.HET , goods.COMPANY_ID')->findAll();

        return $select;
    }
}
