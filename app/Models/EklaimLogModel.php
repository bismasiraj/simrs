<?php

namespace App\Models;

use CodeIgniter\Model;

class EklaimLogModel extends Model
{
    protected $table = 'EklaimLog';
    protected $primaryKey = 'LogId';
    protected $allowedFields = [
        'ClaimId',
        'ApiMethod',
        'RequestPayload',
        'ResponsePayload',
        'IsEncrypted',
        'ResponseCode',
        'ResponseMessage',
        'CreatedAt'
    ];
    public $useTimestamps = true;
    protected $createdField = 'CreatedAt';
    protected $updatedField = '';
}
