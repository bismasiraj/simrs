<?php

namespace App\Controllers\Admin;

use App\Models\ArticleCategoryModel;
use App\Models\ArticleModel;
use App\Models\OrganizationunitModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class News extends \App\Controllers\BaseController
{
    use ResponseTrait;

    protected $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    private function formatResponse($status, $message, $data = null, $httpCode = 200)
    {
        return $this->respond([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $httpCode);
    }

    public function index()
    {
        return view('news/index');
    }

    public function all()
    {
        $data = $this->articleModel
            ->select('articles.*, article_categories.category')
            ->join('article_categories', 'article_categories.category_id = articles.category_id', 'left')
            ->findAll();

        return $this->formatResponse(true, 'Berhasil ambil semua artikel', $this->lowerKey($data));
    }

    public function show()
    {
        $formData = $this->request->getJSON(true);
        $id = $formData['article_id'] ?? null;

        if (!$id) {
            return $this->formatResponse(false, 'article_id diperlukan', null, 400);
        }

        $data = $this->articleModel->find($id);
        $data = $this->lowerKey($data);
        if ($data) {
            if (!empty($data['thumbnail'])) {
                $filePath = $this->imageloc . $data['thumbnail'];

                if (is_file($filePath) && is_readable($filePath)) {
                    $fileData = file_get_contents($filePath);
                    if ($fileData !== false) {
                        $mimeType = mime_content_type($filePath);
                        $base64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);

                        $data['thumbnail'] = $base64;
                    }
                }
            }

            return $this->formatResponse(true, 'Berhasil ambil data artikel', $this->lowerKey($data));
        }

        return $this->formatResponse(false, 'Artikel tidak ditemukan', null, 404);
    }


    public function createUpdate()
    {
        $postData = $this->request->getJSON(true);

        $id = isset($postData['article_id']) ? (string)$postData['article_id'] : null;
        $uploadPath = $this->imageloc . 'uploads/news/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if (isset($postData['thumbnail_base64'])) {
            $base64 = $postData['thumbnail_base64'];

            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                $base64 = substr($base64, strpos($base64, ',') + 1);
                $ext = $type[1];
            } else {
                $ext = 'png';
            }

            $base64 = base64_decode($base64);
            if ($base64 === false) {
                return $this->formatResponse(false, 'Invalid base64 image data', null, 400);
            }

            $fileName = $id ? $id . '.' . $ext : uniqid() . '.' . $ext;
            file_put_contents($uploadPath . $fileName, $base64);

            $postData['thumbnail'] = 'uploads/news/' . $fileName;

            unset($postData['thumbnail_base64']);
        }

        if ($id) {
            if (!$this->articleModel->find($id)) {
                return $this->formatResponse(false, 'Artikel tidak ditemukan', null, 404);
            }

            if ($this->articleModel->save($postData)) {
                $postData['article_id'] = $id;
                return $this->formatResponse(true, 'Artikel berhasil diperbarui', $postData);
            }
            return $this->formatResponse(false, 'Validasi gagal', $this->articleModel->errors(), 422);
        } else {
            if ($this->articleModel->insert($postData)) {
                $insertId = $this->articleModel->getInsertID();

                if (!isset($postData['thumbnail']) && isset($fileName)) {
                    $this->articleModel->update($insertId, ['thumbnail' => 'uploads/news/' . $fileName]);
                    $postData['thumbnail'] = 'uploads/news/' . $fileName;
                }

                $postData['article_id'] = $insertId;
                return $this->formatResponse(true, 'Artikel berhasil dibuat', $postData, 201);
            }
            return $this->formatResponse(false, 'Validasi gagal', $this->articleModel->errors(), 422);
        }
    }


    public function create()
    {
        $formData = $this->request->getJSON(true);

        if ($this->articleModel->insert($formData)) {
            $formData['article_id'] = $this->articleModel->getInsertID();
            return $this->formatResponse(true, 'Artikel berhasil dibuat', $formData, 201);
        }

        return $this->formatResponse(false, 'Validasi gagal', $this->articleModel->errors(), 422);
    }

    public function update()
    {
        $formData = $this->request->getJSON(true);
        $id = $formData['article_id'] ?? null;

        if (!$id) {
            return $this->formatResponse(false, 'article_id diperlukan untuk update', null, 400);
        }

        if (!$this->articleModel->find($id)) {
            return $this->formatResponse(false, 'Artikel tidak ditemukan', null, 404);
        }

        if ($this->articleModel->save($formData)) {
            return $this->formatResponse(true, 'Artikel berhasil diperbarui', $formData);
        }

        return $this->formatResponse(false, 'Validasi gagal', $this->articleModel->errors(), 422);
    }

    public function delete()
    {
        $formData = $this->request->getJSON(true);
        $id = isset($formData['article_id']) ? (string)$formData['article_id'] : null;

        if (!$id) {
            return $this->formatResponse(false, 'article_id diperlukan untuk delete', null, 400);
        }

        if (!$this->articleModel->find($id)) {
            return $this->formatResponse(false, 'Artikel tidak ditemukan', null, 404);
        }

        $this->articleModel->delete($id);
        return $this->formatResponse(true, 'Artikel berhasil dihapus');
    }

    public function news_manage()
    {
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        return view('admin/patient/manajemen-news', [
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp
        ]);
    }

    public function published()
    {
        $articles = $this->articleModel
            ->select('articles.*, article_categories.category')
            ->join('article_categories', 'article_categories.category_id = articles.category_id', 'left')
            ->where('article_status', 'published')
            ->orderBy('published_date', 'DESC')
            ->findAll();

        $articles = $this->lowerKey($articles);

        foreach ($articles as &$article) {
            $thumbnailPath = $this->imageloc . $article['thumbnail'];

            if (!empty($article['thumbnail']) && file_exists($thumbnailPath)) {
                $fileType = pathinfo($thumbnailPath, PATHINFO_EXTENSION);
                $base64 = base64_encode(file_get_contents($thumbnailPath));
                $article['thumbnail'] = 'data:image/' . $fileType . ';base64,' . $base64;
            } else {
                $article['thumbnail'] = null;
            }
        }

        return $this->formatResponse(true, 'Berhasil ambil artikel yang dipublikasikan', $this->lowerKey($articles));
    }



    public function updateStatus($id)
    {
        $formData = $this->request->getJSON(true);

        $status = $formData['status'] ?? null;

        if (!in_array($status, ['published', 'draft'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Status tidak valid.',
                'data' => null
            ])->setStatusCode(400);
        }

        $dataToUpdate = ['article_status' => $status];

        if ($status === 'published') {
            $dataToUpdate['published_date'] = date('Y-m-d H:i:s'); // waktu sekarang
        } else {
            $dataToUpdate['published_date'] = null; // hapus published_date
        }

        $model = new ArticleModel();
        $updated = $model->update($id, $dataToUpdate);

        if ($updated) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Status artikel berhasil diperbarui.',
                'data' => [
                    'id' => $id,
                    'new_status' => $status,
                    'published_date' => $dataToUpdate['published_date']
                ]
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Gagal memperbarui status artikel.',
            'data' => null
        ])->setStatusCode(500);
    }


    public function getCategories()
    {
        $model = new ArticleCategoryModel();
        $data = $model->findAll();
        $data = $this->lowerKey($data);

        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ]);
    }

    public function addCategory()
    {
        $data = $this->request->getJSON(true);
        $model = new ArticleCategoryModel();

        if (isset($data['category_id']) && $data['category_id']) {
            $id = $data['category_id'];
            unset($data['category_id']);

            if (!$model->update($id, $data)) {
                return $this->response->setJSON([
                    'status' => false,
                    'errors' => $model->errors()
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Data berhasil diperbarui'
            ]);
        } else {
            if (!$model->insert($data)) {
                return $this->response->setJSON([
                    'status' => false,
                    'errors' => $model->errors()
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'inserted_id' => $model->getInsertID(),
                'message' => 'Data berhasil ditambahkan'
            ]);
        }
    }

    public function showCategory()
    {
        $formData = $this->request->getJSON(true);
        $id = $formData['category_id'] ?? null;

        if (!$id) {
            return $this->formatResponse(false, 'category_id diperlukan', null, 400);
        }

        $model = new ArticleCategoryModel();
        $data = $model->find($id);

        if ($data) {
            return $this->formatResponse(true, 'Berhasil ambil data kategori', $this->lowerKey($data));
        }

        return $this->formatResponse(false, 'Kategori tidak ditemukan', null, 404);
    }


    public function deleteCategory()
    {
        $formData = $this->request->getJSON(true);
        $id = isset($formData['category_id']) ? (string)$formData['category_id'] : null;

        if (!$id) {
            return $this->formatResponse(false, 'category_id diperlukan untuk menghapus kategori', null, 400);
        }

        $model = new ArticleCategoryModel();
        $data = $model->find($id);

        if (!$data) {
            return $this->formatResponse(false, 'Kategori tidak ditemukan', null, 404);
        }

        if (!$model->delete($id)) {
            return $this->formatResponse(false, 'Gagal menghapus kategori', null, 500);
        }

        return $this->formatResponse(true, 'Kategori berhasil dihapus');
    }
}
