<?php

namespace App\Models;

use CodeIgniter\Model;

class KfaProductModel extends Model
{
    protected $table      = 'kfa_product';
    protected $primaryKey = 'kfa_code';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $allowedFields = [
        'kfa_code',
        'name',
        'active',
        'state',
        'updated_at',
        'farmalkes_type',
        'dosage_form',
        'produksi_buatan',
        'nie',
        'nama_dagang',
        'manufacturer',
        'registrar',
        'generik',
        'rxterm',
        'dose_per_unit',
        'fix_price',
        'het_price',
        'farmalkes_hscode',
        'tayang_lkpp',
        'kode_lkpp',
        'net_weight',
        'net_weight_uom_name',
        'volume',
        'volume_uom_name',
        'uom_name',
        'product_template',
        'active_ingredients',
        'tags',
        'replacement_product',
        'replacement_template',
    ];
}
