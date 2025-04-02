<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table            = 'activities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'name', 'description', 'start_datetime', 'end_datetime', 'status'];

    // Função para obter atividades de um usuário
    public function getActivitiesByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    // Função para atualizar o status da atividade
    public function updateStatus($activityId, $status)
    {
        // Lista de status válidos (sem acento)
        $validStatuses = ['pendente', 'concluida', 'cancelada'];

        // Verifica se o status fornecido é válido
        if (!in_array($status, $validStatuses)) {
            return false;  // Se o status não for válido, retorna false
        }

        // Atualiza o status da atividade no banco de dados
        return $this->update($activityId, ['status' => $status]);
    }

    // Outras configurações do modelo (não modificadas)
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
}
