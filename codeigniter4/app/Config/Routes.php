<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Página inicial (login)
$routes->get('/', 'UserController::login'); // Tela de login

// Rota para autenticação (login)
$routes->post('/authenticate', 'UserController::authenticate'); // Processa o login

// Rota para o dashboard (após login)
$routes->get('/dashboard', 'ActivityController::dashboard'); // Tela de atividades do usuário

// Rota para criar uma atividade
$routes->get('/activity/create', 'ActivityController::create'); // Formulário para criar atividade
$routes->post('/activity/store', 'ActivityController::store'); // Processa a criação da atividade

// Rota para atualizar o status da atividade (ex: "concluída", "cancelada")
$routes->get('/activity/updateStatus/(:num)/(:any)', 'ActivityController::updateStatus/$1/$2');

// Rota para editar atividade
$routes->get('/activity/edit/(:num)', 'ActivityController::edit/$1');

// Rota para atualizar atividade (formulário de edição)
$routes->post('/activity/update/(:num)', 'ActivityController::update/$1');

// Rota para deletar atividade
$routes->get('/activity/delete/(:num)', 'ActivityController::delete/$1');

// Rota para logout (desloga o usuário)
$routes->get('/logout', 'UserController::logout'); // Desloga o usuário