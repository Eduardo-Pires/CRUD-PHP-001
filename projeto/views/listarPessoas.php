<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pessoas</title>
</head>
<body>
    <h1>Listagem de pessoas</h1>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pessoasJson as $p):?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nome']?></td>
                        <td><?= $p['email'] ?></td>
                        <td><?= $p['telefone'] ?></td>
                    </tr>
                    <?php endforeach;?>
             </tbody>
        </table>
    </div>
</body>
</html>