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

        $query = "INSERT INTO Users (`nom`, `prenom`, `email`, `pseudo`, `passwd`)
                    VALUES(:nom, :prenom, :email, :pseudo, :passwd)";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':nom', $this->nom, PDO::PARAM_STR);
        $result->bindValue(':prenom', $this->prenom, PDO::PARAM_STR);
        $result->bindValue(':email', $this->email, PDO::PARAM_STR);
        $result->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $result->bindValue(':passwd', $this->passwd, PDO::PARAM_STR);
        $result->execute();

        $this->id = $this->pdo->lastInsertId();
        return $this;

    }

    public function verify_user(): self {

        $query = "SELECT id_user, passwd FROM Users WHERE pseudo = :pseudo";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $result->execute();

        $data = $result->fetch(); //renvoie array ou false
        
        if ($data) {
            $this->passwd = $data['passwd'];
            $this->id = $data['id_user'];
        }

        return $this;
    }

    function delete(){

        $query = "DELETE FROM Users WHERE id_user = :id";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result->execute();
    }

    function update(){

        $query = "UPDATE Users 
                SET `nom` = :nom, `prenom` = :prenom, `email` = :email, `pseudo` = :pseudo
                WHERE id_user = $this->id";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':nom', $this->nom, PDO::PARAM_STR);
        $result->bindValue(':prenom', $this->prenom, PDO::PARAM_STR);
        $result->bindValue(':email', $this->email, PDO::PARAM_STR);
        $result->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $result->execute();

        return $this;
    }

    function select(){

        $query = "SELECT `nom`, `prenom`, `email`, `pseudo`, `passwd` FROM Users 
                WHERE id_user = :id";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result->execute();
        $data = $result->fetch();

        if($data) {
            $this->setNom($data['nom']);
            $this->setPrenom($data['prenom']);
            $this->setEmail($data['email']);
            $this->setPseudo($data['pseudo']);
            $this->setPasswd($data['passwd']);
        }
        return $this;

    }
    function selectAll(){

        $query = "SELECT `id_user`, `nom`, `prenom`, `email`, `pseudo`, `passwd` FROM Users";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas = $result->fetchAll();
        
        $tab = [];
        if($datas) {
            foreach($datas as $data) {
                $new = new Utilisateur();
                $new->setId($data['id_user']);
                $new->setNom($data['nom']);
                $new->setPrenom($data['prenom']);
                $new->setEmail($data['email']);
                $new->setPseudo($data['pseudo']);
                $new->setPasswd($data['passwd']);
                array_push($tab, $new);
            }
        }

        return $tab;

    }
}