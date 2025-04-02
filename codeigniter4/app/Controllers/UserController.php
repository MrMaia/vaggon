<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function login()
    {
        return view('login_view'); // Exibe a tela de login
    }

    public function authenticate()
    {
        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByLogin($login);

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            return redirect()->to('/dashboard'); // Redireciona para o dashboard após login
        } else {
            return redirect()->back()->with('error', 'Credenciais inválidas');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
