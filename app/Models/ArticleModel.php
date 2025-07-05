<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'article_id';
    protected $allowedFields = [
        'title',
        'abstract',
        'article_content',
        'thumbnail',
        'category_id',
        'author',
        'article_status',
        'published_date',
        'created_date',
        'update_date'

    ];
}
