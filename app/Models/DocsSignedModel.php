<?php

namespace App\Models;

use CodeIgniter\Model;

class DocsSignedModel extends Model
{
    protected $table      = 'docs_signed';
    protected $primaryKey = 'sign_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        "docs_type",
        "sign_id",
        "user_type",
        "sign_ke",
        "title",
        "doc_date",
        "user_id",
        "sign",
        "sign_path",
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'doc_date';
    protected $updatedField  = 'doc_date';
    protected $deletedField  = 'deleted_at';
}
