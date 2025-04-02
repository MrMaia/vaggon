<!-- app/Views/dashboard_view.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- TUI Calendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@toast-ui/calendar@latest/dist/toastui-calendar.min.css" rel="stylesheet" />

    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Dashboard</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="/activity/create" class="btn btn-success">Criar Atividade</a>
            <a href="/logout" class="btn btn-danger">Sair</a>
        </div>

        <h4>Minhas Atividades</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($activities)): ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhuma atividade encontrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($activities as $activity): ?>
                        <tr>
                            <td><?= esc($activity['name']) ?></td>
                            <td><?= ucfirst($activity['status']) ?></td>
                            <td>
                                <?php if ($activity['status'] == 'pendente'): ?>
                                    <a href="/activity/updateStatus/<?= $activity['id'] ?>/concluida" class="btn btn-primary btn-sm">Concluir</a>
                                    <a href="/activity/updateStatus/<?= $activity['id'] ?>/cancelada" class="btn btn-danger btn-sm">Cancelar</a>
                                <?php endif; ?>
                                <a href="/activity/edit/<?= $activity['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="/activity/delete/<?= $activity['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Calendário TUI -->
        <h4 class="mt-5">Calendário de Atividades</h4>
        <div id="calendar"></div>
    </div>

    <!-- Scripts do TUI Calendar -->
    <script src="https://cdn.jsdelivr.net/npm/@toast-ui/calendar@latest/dist/toastui-calendar.min.js"></script>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new tui.Calendar(calendarEl, {
            defaultView: 'month', // Exibe o mês por padrão
            taskView: true,
            scheduleView: true,
            useCreationPopup: true, // Permite criar eventos diretamente no calendário
            useDetailPopup: true, // Permite editar eventos diretamente no calendário
            theme: {
                'common.border': '1px solid #ddd',
                'common.backgroundColor': '#fff',
                'common.holiday.color': '#ff6b6b',
                'common.weekend.color': '#ff6b6b',
            }
        });

        // Passando as atividades do PHP para o calendário
        var activities = <?php echo json_encode($activities); ?>;

        activities.forEach(function(activity) {
            calendar.createSchedules([{
                id: activity.id,
                calendarId: '1',
                title: activity.name,
                category: 'time',
                start: activity.start_datetime, // Certifique-se de que essas datas estão em formato ISO
                end: activity.end_datetime, // Certifique-se de que essas datas estão em formato ISO
                color: activity.status == 'concluida' ? '#4caf50' : (activity.status == 'cancelada' ? '#f44336' : '#2196f3'), // Defina cores conforme o status
            }]);
        });
    });
</script>

</body>
</html>
