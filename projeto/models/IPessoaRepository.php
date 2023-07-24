<?php

interface IPessoaRepository
{
    public function criarPessoa($pessoa);
    public function listarPessoas();
    public function obterPessoaPorId($id);
    public function atualizarPessoa($pessoa);
    public function excluirPessoa($id);

}