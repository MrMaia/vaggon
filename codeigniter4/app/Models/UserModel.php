<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['login', 'password'];

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
    protected $validationRules      = [
        'login'    => 'required|is_unique[users.login]', // Garantir que o login seja único
        'password' => 'required|min_length[6]',          // Senha deve ter pelo menos 6 caracteres
    
    ];
    protected $validationMessages   = [
        'login' => [
            'required' => 'O login é obrigatório.',
            'is_unique' => 'Esse login já está em uso.',
        ],
        'password' => [
            'required'    => 'A senha é obrigatória.',
            'min_length'  => 'A senha deve ter pelo menos 6 caracteres.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getUserByLogin($login)
    {
        return $this->where('login', $login)->first(); // Método para buscar usuário pelo login
    }

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
