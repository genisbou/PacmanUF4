<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\NewsModel;

class NewsController extends BaseController
{

    public function __construct()
    {
        // helper('form'); => carrega el helper form per TOTES les funcions del controlador
    }

    public function create()
    {
        // helper: coleccio de funcions que ens estalvien codi i estan
        // classificades dins del helper com si es tractes d'un tema
        helper(["form"]); // carrego funcions que ens estavien codi en formularis
        // helper ('form') =>  include "xxxxx/xxxx/form_helper.php";

        // helper ('nom_helper'); => permet carregar un helper concret
        // helper (['help1','help2']); => permet carregar un array de helpers

        //$this->request->getMethod()=='post'

        return view("news/news_create", ['title' => 'Create news', 'author' => 'Jordi']);
        /*
        $data['title'] = 'Create a news item';
        $data['author'] = 'Jordi';
        return view("news/news_create", $data);
        */
    }


    public function create_post() // no cal posar el post al final
    {
        helper(["form"]);
        $model = new NewsModel();

        // NOTE: https://codeigniter.com/user_guide/libraries/validation.html
        $validationRules = [
            'title' => 'required|min_length[3]|max_length[128]',
            'body' => 'required',
        ];

        if ($this->validate($validationRules)) {

            $title = $this->request->getPost('title'); // $_POST['title']
            // ->getGet()  => $_GET['']
            // ->getGetPost()

            // NOTE: https://codeigniter.com/user_guide/helpers/url_helper.html#url_title
            // helper('url'); => no necessari perque ja esta carregat per defecte
            $slug = url_title($title);
            $body = $this->request->getPost('body');

            // $model->insert(["title" => $title, "body" => $body, "slug" => $slug]);

            $model->addNoticia($title, $slug, $body);

            echo view("news/news_added", ['title' => 'News created successfully']);
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function index()
    {
        $model = new NewsModel();   // necessita SI o SI el use App\Models\NewsModel;
        // $model = model('NewsModel');
        // $model = new \App\Models\NewsModel();

        $data['title'] = "Llista noticies";
        $data['news'] = $model->getNews();

        return view("news/news_list", $data);
    }

    /**
     * view
     * $slug=null
     */
    public function view($slug = null)
    {
        $model = new NewsModel();

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        echo view("news/news_view", $data);
    }

    /**
     * list_pager
     *
     */
    public function list_pager()
    {
        $model = new NewsModel();

        $data = [
            'title' => 'Llistat paginat',
            'news' => $model->paginate(2),
            'pager' => $model->pager,
        ];

        echo view('news/news_list_page', $data);
    }
}
