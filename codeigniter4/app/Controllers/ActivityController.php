<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use CodeIgniter\Controller;

class ActivityController extends Controller
{
    // Função para criar nova atividade
    public function create()
    {
        // Verifica se o usuário está logado
        if (!session()->has('user_id')) {
            return redirect()->to('/');
        }

        return view('activity_view');
    }

    // Função para salvar a nova atividade
    public function store()
    {
        // Recupera os dados do formulário
        $userId = session()->get('user_id');
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $startDatetime = $this->request->getPost('start_datetime');
        $endDatetime = $this->request->getPost('end_datetime');

        // Cria o modelo e salva a atividade no banco de dados
        $activityModel = new ActivityModel();
        $activityModel->save([
            'user_id' => $userId,
            'name' => $name,
            'description' => $description,
            'start_datetime' => $startDatetime,
            'end_datetime' => $endDatetime,
        ]);

        return redirect()->to('/dashboard');
    }

    // Função para editar a atividade
    public function edit($activityId)
    {
        // Verifica se o usuário está logado
        if (!session()->has('user_id')) {
            return redirect()->to('/');
        }

        // Recupera a atividade do banco de dados
        $activityModel = new ActivityModel();
        $activity = $activityModel->find($activityId);

        if (!$activity) {
            return redirect()->to('/dashboard')->with('error', 'Atividade não encontrada.');
        }

        // Exibe a view de edição com os dados da atividade
        return view('edit_activity_view', ['activity' => $activity]);
    }

    // Função para atualizar a atividade
    public function update($activityId)
    {
        // Verifica se o usuário está logado
        if (!session()->has('user_id')) {
            return redirect()->to('/');
        }

        // Pega os dados do formulário
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $startDatetime = $this->request->getPost('start_datetime');
        $endDatetime = $this->request->getPost('end_datetime');

        // Atualiza a atividade no banco de dados
        $activityModel = new ActivityModel();
        $activityModel->update($activityId, [
            'name' => $name,
            'description' => $description,
            'start_datetime' => $startDatetime,
            'end_datetime' => $endDatetime
        ]);

        return redirect()->to('/dashboard')->with('message', 'Atividade atualizada com sucesso!');
    }

    // Função para atualizar o status da atividade (Concluir/Cancelar)
    public function updateStatus($activityId, $status)
    {
        // Lista de status válidos (sem acento)
        $validStatuses = ['pendente', 'concluida', 'cancelada'];

        // Verifica se o status fornecido é válido
        if (!in_array($status, $validStatuses)) {
            return redirect()->to('/dashboard')->with('error', 'Status inválido.');
        }

        // Atualiza o status da atividade no banco de dados
        $activityModel = new ActivityModel();
        $activityModel->updateStatus($activityId, $status);

        return redirect()->to('/dashboard')->with('message', 'Status da atividade atualizado com sucesso!');
    }

    // Função para excluir a atividade
    public function delete($activityId)
    {
        // Verifica se o usuário está logado
        if (!session()->has('user_id')) {
            return redirect()->to('/');
        }

        // Deleta a atividade do banco de dados
        $activityModel = new ActivityModel();
        $activityModel->delete($activityId);

        return redirect()->to('/dashboard')->with('message', 'Atividade excluída com sucesso!');
    }

    // Função para exibir o dashboard com as atividades do usuário
    public function dashboard()
{
    if (!session()->has('user_id')) {
        return redirect()->to('/');
    }

    $userId = session()->get('user_id');
    $activityModel = new ActivityModel();
    $activities = $activityModel->getActivitiesByUser($userId);

    return view('dashboard_view', ['activities' => $activities]);
}
}
