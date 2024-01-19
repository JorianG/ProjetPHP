<?php

namespace class;

class Compte
{

    private string $login;
    private string $mdp;

    function __construct(string $login, string $mdp)
    {
        $this->login = $login;
        $this->mdp = $mdp;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp(string $mdp): void
    {
        $this->mdp = $mdp;
    }
}