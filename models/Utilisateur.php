<?php

namespace Models;
use PDO;

class Utilisateur extends DbConnect {

    private $pseudo;
    private $passwd;
    private $nom;
    private $prenom;
    private $email;

    public function __construct($id = null) {
        parent::__construct($id);
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

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom) {
        $this->nom = $nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom) {
        $this->prenom = $prenom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function insert() {

        // !!!!!!!!! Requête à modifier ultérieurement voir cours sécurité !!!!!!!!!!!
        $query = "INSERT INTO Users (`nom`, `prenom`, `email`, `pseudo`, `passwd`)
                    VALUES('$this->nom', '$this->prenom', '$this->email', '$this->pseudo', '$this->passwd')";
        $result = $this->pdo->prepare($query);
        $result->execute();

        $this->id = $this->pdo->lastInsertId();
        return $this;

    }

    public function verify_user(): self {

        // !!!!!!!!! Requête à modifier ultérieurement voir cours sécurité !!!!!!!!!!!
        $query = "SELECT id_user, passwd FROM Users WHERE pseudo = '$this->pseudo'";
        $result = $this->pdo->prepare($query);
        $result->execute();

        $data = $result->fetch(); //renvoie array ou false
        
        if ($data) {
            $this->passwd = $data['passwd'];
            $this->id = $data['id_user'];
        }

        return $this;
    }
}