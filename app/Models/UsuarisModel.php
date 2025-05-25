<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarisModel extends Model
{
    protected $table = 'usuaris';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'nom_usuari', 'password_usuari', 'mail', 'edat', 'pais'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];


    public function add($nom_usuari, $password_usuari, $mail, $edat, $pais)
    {
        $hashedPassword = password_hash($password_usuari, PASSWORD_DEFAULT);
        return $this->insert(["nom_usuari" => $nom_usuari, "password_usuari" => $hashedPassword,
            "mail" => $mail, "edat" => $edat, "pais" => $pais]);

    }
  /*  public function actualitzar($id, $nom, $password, $mail, $edat, $pais)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'nom' => $nom,
            'password' => $hashedPassword,
            'mail' => $mail,
            'edat' => $edat,
            'pais' => $pais,
        ];

        return $this->update($id, $data);
    }*/

    public function actualitzar($id, $nom, $password, $mail, $edat, $pais)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'nom' => $nom,
            'password' => $hashedPassword,
            'mail' => $mail,
            'edat' => $edat,
            'pais' => $pais,
        ];

        return $this->update($id, $data);
    }



}