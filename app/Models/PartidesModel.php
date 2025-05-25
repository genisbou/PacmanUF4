<?php

namespace App\Models;

use CodeIgniter\Model;

class PartidesModel extends Model
{
    protected $table            = 'partides';
    protected $primaryKey       = 'usuari_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'data', 'guanyat', 'punts', 'durada'];

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

    public function getInsertID()
    {
        return $this->insertID;
    }

    public function getLastLastGamesByUsuariId($usuari_id)
    {
        return $this->where('usuari_id', $usuari_id)->findAll();
    }

    public function getTotalGamesByUsuariId($usuari_id){
        return $this->where('usuari_id', $usuari_id)->countAllResults();
    }

    public function getTotalGamesWinsByUsuariId($usuari_id){
        return $this->where('usuari_id', $usuari_id)->where('guanyat', 1)->countAllResults();
    }

    public function getTotalGamesLostByUsuariId($usuari_id){
        return $this->where('usuari_id', $usuari_id)->where('guanyat', 0)->countAllResults();
    }

    public function getWinningPercentageByUsuariId($usuari_id){
       $wins = $this->getTotalGamesWinsByUsuariId($usuari_id);
       $totalGames = $this->getTotalGamesWinsByUsuariId($usuari_id);
        return $wins / $totalGames * 100;
    }

    public function getPointsByUsuariId($usuari_id){
        $points = $this->where('usuari_id', $usuari_id)->selectSum('punts')->findAll();
        $average = 0;
        foreach ($points as $point) {
            $average += $point['punts'] / $this->getTotalGamesByUsuariId($usuari_id);
        }
        return $average;
    }

    public function getDurationByUsuariId($usuari_id){
        $duration = $this->where('usuari_id', $usuari_id)->selectSum('durada')->findAll();
        $average = 0;
        foreach ($duration as $duration) {
            $average += $duration['durada'] / $this->getTotalGamesByUsuariId($usuari_id);
        }
        return $average;
    }

}
