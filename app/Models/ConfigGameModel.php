<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigGameModel extends Model
{
    protected $table            = 'configgame';
    protected $primaryKey       = 'usuari_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'tema', 'musica', 'dificultat'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function crear_config($usuari_id, $tema, $musica, $dificultat) {
        return $this->insert([
            'usuari_id' => $usuari_id,
            'tema'      => $tema,
            'musica'    => $musica,
            'dificultat'=> $dificultat
        ]);
    }

    public function update_config($usuari_id, $tema, $musica, $dificultat)
    {
        return $this-> update($usuari_id, ["tema" => $tema, "musica" => $musica, "dificultat" => $dificultat]);

    }



}
