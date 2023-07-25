<?php

class Pessoa implements Serializable
{
    private $id;
    private $nome;
    private $email;
    private $telefone;

    public function __construct($nome, $email, $telefone, $id = null)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        if($id !== null) $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function serialize()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
        ];
    }

    public function unserialize($data)
    {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->email = $data['email'];
        $this->telefone = $data['telefone'];
    }
}