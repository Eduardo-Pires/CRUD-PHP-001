<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    <header>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Listar Pessoas</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">CRUD PHP operações</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Listar pessoas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?a=criarPessoa">Criar Pessoa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?a=atualizarPessoa">Atualizar Pessoa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?a=excluirPessoa">Excluir Pessoa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?a=obterPessoaPorId">Obter Pessoa Por ID</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main>
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
                <!– cria dinamicamente linhas na tabela com os registros do banco –>
                <?php foreach($serializedPessoas as $p):?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nome']?></td>
                        <td><?= $p['email'] ?></td>
                        <td><?= $p['telefone'] ?></td>
                    </tr>
                    <?php endforeach;?>
             </tbody>
        </table>
    </main>
    <footer class="py-3 my-4 ">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="https://github.com/Eduardo-Pires" class="nav-link px-2 text-muted">GitHub</a></li>
        <li class="nav-item"><a href="https://github.com/Eduardo-Pires/CRUD-PHP-001" class="nav-link px-2 text-muted">Repositório do Projeto</a></li>
        <li class="nav-item"><a href="https://github.com/Eduardo-Pires/CRUD-PHP-001/blob/main/README.md" class="nav-link px-2 text-muted">Sobre</a></li>
      </ul>
      <p class="text-center text-muted">Feito por Eduardo Pires</p>
    </footer>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
