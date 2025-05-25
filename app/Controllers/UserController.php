<?php

namespace App\Controllers;

use App\Models\ConfigGameModel;
use App\Models\UsuarisModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        helper(['form']);

        if ($id === null) {
            $id = $this->request->getUri()->getSegment(3);
        }

        $rules = [
            'nom_usuari'  => 'required|min_length[3]|max_length[64]',
            'mail' => 'required|valid_email',
            'pais' => 'required'
        ];

        $messages = [
            'nom_usuari' => [
                'required' => 'El nom és obligatori',
                'min_length' => 'El nom és massa curt',
                'max_length' => 'El nom és massa llarg',
            ],
            'mail' => [
                'required' => 'El correu és obligatori',
                'valid_email' => 'El correu no és vàlid'
            ],
            'pais' => [
                'required' => 'El país és obligatori'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status' => 400,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ]);
        }

        $userModel = new \App\Models\UsuarisModel();

        if (!$userModel->find($id)) {
            return $this->response->setJSON([
                'status' => 404,
                'error' => true,
                'message' => 'Usuari no trobat',
                'data' => []
            ]);
        }

        $json = $this->request->getJSON(true); // true → array
        $nom = $json['nom_usuari'] ?? null;
        $mail = $json['mail'] ?? null;
        $password = $json['password_usuari'] ?? null;
        $edat = $json['edat'] ?? null;
        $pais = $json['pais'] ?? null;

        $userModel->actualitzar($id, $nom, $password, $mail, $edat, $pais);

        return $this->response->setJSON([
            'status' => 200,
            'error' => false,
            'message' => 'Usuari actualitzat correctament',
            'data' => ['id' => $id]
        ]);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }

    public function login()
    {
        helper(['form', 'jwt']);

        $rules = [
            'nom_usuari' => 'required',
            'password_usuari' => 'required|min_length[4]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $model = new UsuarisModel();
        $usuari = $model->where('nom_usuari', $this->request->getVar('nom_usuari'))->first();

        if (!$usuari) {
            return $this->failNotFound('Usuari no trobat');
        }

        // Verificació de contrasenya
        if (!password_verify($this->request->getVar('password_usuari'), $usuari['password_usuari'])) {
            return $this->fail('Contrasenya incorrecta', 401);
        }

        // Configuració del token
        $cfgAPI = new \Config\APIJwt('default');

        $data = [
            'uid'  => $usuari['id'],
            'nom'  => $usuari['nom_usuari'],
            'mail' => $usuari['mail'],
            'pais' => $usuari['pais']
        ];

        $token = newTokenJWT($cfgAPI->config(), $data);

        return $this->respond([
            'status'  => 200,
            'message' => 'Login correcte',
            'token'   => $token
        ]);

    }

    public function register(){

        $rules = [
            'nom_usuari' => 'required|min_length[3]|max_length[50]',
            'password_usuari' => 'required|min_length[6]',
            'mail' => 'required|valid_email|is_unique[usuaris.mail]',
            'edat' => 'required',
            'pais' =>  'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = new UsuarisModel();

        $nom = $this->request->getPost('nom_usuari');
        $password = $this->request->getPost('password_usuari');
        $mail = $this->request->getPost('mail');
        $edat = $this->request->getPost('edat');
        $pais = $this->request->getPost('pais');

        $userId = $model->add($nom, $password, $mail, $edat, $pais);

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Usuari creat correctament',
            'user_id' => $userId
        ]);

    }

    public function logout()
    {
        helper('jwt_helper');

    }

    public function logged(){
        return $this->respond([
            'status' => 200,
                'error' => false,
                'logged' => true
            ]
        );
    }

    public function configGame()
    {
        helper('jwt');
        $cfgAPI = config('APIJwt');
        $defaultConfig = json_decode(json_encode($cfgAPI->default));

        try {
            $token = getToken($defaultConfig, $this->request);
        } catch (\Throwable $e) {
            return $this->respond([
                'status' => 401,
                'error' => true,
                'message' => 'Token no proporcionat'
            ]);
        }

        if (!$token) {
            return $this->respond([
                'status' => 401,
                'error' => true,
                'message' => 'Token incorrecte'
            ]);
        }

        $data = is_array($token) ? $token['data'] : (isset($token->data) ? $token->data : null);

        $usuari_id =  $data->uid;

        $tema = $this->request->getVar('tema');
        $musica = $this->request->getVar('musica');
        $dificultat = $this->request->getVar('dificultat');

        $model = new ConfigGameModel();
        $model->crear_config($usuari_id, $tema, $musica, $dificultat);

        return $this->respond([
            'status' => 200,
            'error' => false,
            'message' => 'Configuració creada correctament',
        ]);
    }



    public function updateConfigGame()
    {
        helper('jwt');
        $cfgAPI = config('APIJwt');
        $defaultConfig = json_decode(json_encode($cfgAPI->default));

        try {
            $token = getToken($defaultConfig, $this->request);
        } catch (\Throwable $e) {
            return $this->respond([
                'status' => 401,
                'error' => true,
                'message' => 'Token no proporcionat'
            ]);
        }

        if (!$token) {
            return $this->respond([
                'status' => 401,
                'error' => true,
                'message' => 'Token incorrecte'
            ]);
        }

        $data = is_array($token) ? $token['data'] : (isset($token->data) ? $token->data : null);
        $usuari_id =  $data->uid;

        // Agafar dades JSON del PUT
        $dataRequest = $this->request->getJSON();

        $tema = $dataRequest->tema;
        $musica = $dataRequest->musica;
        $dificultat = $dataRequest->dificultat;

        $model = new ConfigGameModel();
        $model->update_config($usuari_id, $tema, $musica, $dificultat);

        return $this->respond([
            'status' => 200,
            'error' => false,
            'message' => 'Configuració actualitzada correctament',
        ]);
    }



}
