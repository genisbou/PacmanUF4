<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    /*
        $m = news NewsModel();

        $dades = $m->findAll() => SELECT * FROM news
        $array= $m->find(3) => SELECT * FROM news WHERE id = 3

        $m->purge(); Buidar paperera (si useSoftDeletes = true)

    */
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'slug', 'data_pub','body'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    /*
        $m->updatePassword ('1234'); => beforeUpdate => $data['password'] = password_hash('1234')
    */
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addNoticia($title, $slug, $body)
    {
        return $this->insert(["title" => $title, "body" => $body, "slug" => $slug]);
    }
    public function getTotesLesNews()
    {
        return $this->orderBy('data_pub', 'DESC')->findAll();
    }

    public function getNewsById($id)
    {
        // return $this->find($id);
        return $this->where('id', $id)->first();
    }

    /**
     * getNews
     * $slug=false
     */
    
    // getNews() => SELECT * FROM news
    // getNews('noticia1') => SELECT * FROM news WHERE slug = 'noticia1'
     public function getNews($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where('slug', $slug)->first();
        // return $this->where(['slug'=>$slug])->first();

        // return $this->where(['nom'=>'a','cognom1'=>'b','cognom2'=>'c'])->first();
        // return $this->where('nom'=>'a')->where('cognom1'=>'b')->where('cognom2'=>'c')->first();
        // return $this->where('nom'=>'a')->where('cognom1'=>'b')->orWhere('cognom2'=>'c')->first();

    }
}
