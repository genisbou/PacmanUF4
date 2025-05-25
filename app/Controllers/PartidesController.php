<?php

namespace App\Controllers;

use App\Models\PartidesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PartidesController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new PartidesModel();
        $partides = $model->findAll();

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Llista de partides carregada correctament',
            'data' => $partides
        ]);

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
        // Regles de validació (afegeix les que necessites)
        $rules = [
            'usuari_id' => 'required|is_natural_no_zero',
            'guanyat'   => 'required|in_list[0,1]',
            'punts'     => 'required|integer',
            'durada'    => 'required|integer',
        ];

        $messages = [
            'usuari_id' => [
                'required' => 'Usuari ID obligatori',
                'is_natural_no_zero' => 'Usuari ID ha de ser un nombre vàlid',
            ],
            'guanyat' => [
                'required' => 'Camp guanyat obligatori',
                'in_list' => 'Guanyat ha de ser 0 o 1',
            ],
            'punts' => [
                'required' => 'Punts obligatori',
                'integer' => 'Punts ha de ser un enter',
            ],
            'durada' => [
                'required' => 'Durada obligatòria',
                'integer' => 'Durada ha de ser un enter',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = new PartidesModel();

        $data = [
            'usuari_id' => $this->request->getVar('usuari_id'),
            'guanyat'   => $this->request->getVar('guanyat'),
            'punts'     => $this->request->getVar('punts'),
            'durada'    => $this->request->getVar('durada'),
        ];

        if (!$model->insert($data)) {
            return $this->failServerError('No s\'ha pogut inserir la partida');
        }

        $response = [
            'status' => 201,
            'error' => false,
            'message' => 'Partida creada correctament',
            'data' => [
                'id' => $model->getInsertID(),
                'partida' => $data,
            ]
        ];

        return $this->respondCreated($response);
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
        //
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

    public function getUserStats()
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

        $model = new PartidesModel();
        $TotalGames = $model->getTotalGamesByUsuariId($usuari_id);
        $TotalWins = $model->getTotalGamesWinsByUsuariId($usuari_id);
        $TotalLost = $model->getTotalGamesLostByUsuariId($usuari_id);
        $percentage_wins = $model->getWinningPercentageByUsuariId($usuari_id);
        $points = $model->getPointsByUsuariId($usuari_id);
        $duration = $model->getDurationByUsuariId($usuari_id);


        return $this->respond([
            'status' => 200,
            'error' => false,
            'message' => 'Llista de partides',
            'total' => $TotalGames,
            'guanyades' => $TotalWins,
            'perdudes' => $TotalLost,
            'percentatge_victories' => $percentage_wins,
            'mitjana_punts' => $points,
            'mitjana_durada' => $duration
        ]);

    }

    public function get_user_last_games()
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

        $model = new PartidesModel();
        $lastGamesByUser = $model->getLastLastGamesByUsuariId($usuari_id);
        return $this->respond([
            'status' => 200,
            'error' => false,
            'message' => $lastGamesByUser
        ]);
    }

    public function get_top_users(){

    }
}
