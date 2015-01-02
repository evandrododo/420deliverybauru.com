<?php
/**
 * @Entity @Table(name="usuarios")
 **/
class Usuario
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string", nullable=TRUE) **/
    protected $login;
    /** @Column(type="string") **/
    protected $email;
    /** @Column(type="string") **/
    protected $senha;
    /** @Column(type="string", nullable=TRUE) **/
    protected $facebookId;
    /** @Column(type="string", nullable=TRUE) **/
    protected $nomeCompleto;
    /** @Column(type="integer", nullable=TRUE) **/
    protected $pontos;

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    

    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }
    
    public function getPontos()
    {
        return $this->pontos;
    }
    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
    }
}