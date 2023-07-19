<?php

interface IPessoaRepository
{
    public function CriarPessoa($pessoa);
    public function ListarPessoas();
    public function ObterPessoaPorId($id);
    public function AtualizarPessoa($pessoa);
    public function ExcluirPessoa($id);

}