# CRUD-PHP-001

Este repositório foi criado com o objetivo de desenvolver um CRUD (Create, Read, Update, Delete), utilizando a linguagem PHP para o back-end. Utilizando o banco de dados PostgreSQL para persistência dos dados.

Requisitos do Sistema:
1. O sistema deve permitir cadastrar, listar, atualizar e excluir registros.
2. O registro deve conter os seguintes campos:
   - ID (gerado automaticamente)
   - Nome
   - E-mail
   - Telefone

Backend:
1. Crie uma classe `Pessoa` com as propriedades necessárias para representar os campos do registro.
2. Implemente uma classe `PessoaRepository` para lidar com a persistência dos dados utilizando postgreSQL.
3. Implemente os métodos para realizar as operações CRUD:
   - `CriarPessoa(Pessoa pessoa)` - cria um novo registro de pessoa.
   - `ListarPessoas()` - lista todas as pessoas cadastradas.
   - `ObterPessoaPorId(int id)` - obtém uma pessoa pelo ID.
   - `AtualizarPessoa(Pessoa pessoa)` - atualiza os dados de uma pessoa.
   - `ExcluirPessoa(int id)` - exclui uma pessoa pelo ID.

O código deve ser legível, bem-organizado e seguir as melhores práticas de desenvolvimento. Certifique-se de tratar possíveis erros e exceções, e comente o código quando necessário para explicar a lógica ou intenção do trecho.

---
**Créditos**: Este repositório foi criado com base em um teste de um processo seletivo da empresa [TechOne](https://techone.com.br). Embora eu não tenha participado diretamente, recebi permissão dos superiores de um amigo próximo que participou para que pudesse utilizar seu texto como inspiração para criar este projeto. Portanto, gostaria de creditar a eles a autoria do enunciado acima.
