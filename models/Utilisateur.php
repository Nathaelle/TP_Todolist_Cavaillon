<?php

class Utilisateur {

    private $idUtilisateur;
    private $pseudo;
    private $passwd;

    public function __construct() {}

    public function getIdUtilisateur(): int {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $id) {
        $this->IdUtilisateur = $id;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getPasswd(): string {
        return $this->passwd;
    }

    public function setPasswd(string $passwd) {
        $this->passwd = $passwd;
    }
}