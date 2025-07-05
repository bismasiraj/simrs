<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleCategoryModel extends Model
{
    protected $table = 'article_categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = [
        'category_id',
        'category',
        'descriptions'
    ];
}
