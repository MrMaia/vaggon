<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Atividade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Editar Atividade</h2>
        <form action="/activity/update/<?= $activity['id'] ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= esc($activity['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea name="description" id="description" class="form-control"><?= esc($activity['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="start_datetime" class="form-label">Data e Hora de Início</label>
                <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="<?= esc($activity['start_datetime']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="end_datetime" class="form-label">Data e Hora de Término</label>
                <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="<?= esc($activity['end_datetime']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Atualizar Atividade</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>