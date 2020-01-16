<?php

namespace Models;
use PDO;
use DateTime;
use DateTimeZone;

class Tache extends DbConnect {

    private $description;
    private $creation;
    private $deadline;
    private $idUtilisateur;

    public function __construct(?int $id = null) {
        parent::__construct($id);
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $desc) {
        $this->description = $desc;
    }

    public function getCreation(): string {
        return $this->creation;
    }

    public function setCreation(string $create) {
        $this->creation = $create;
    }

    public function getDeadline(): DateTime {
        return $this->deadline;
    }

    public function setDeadline(string $dead) {
        $this->deadline = new DateTime($dead, new DateTimeZone('europe/paris'));
    }

    public function getIdUtilisateur(): int {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }


    public function insert() {

        $deadline = $this->deadline->format('Y-m-d H:i');
        // !!!!!!!!! Requête à modifier ultérieurement voir cours sécurité !!!!!!!!!!!
        $query = "INSERT INTO Tasks (`description`, `created_at`, `todo_at`, `id_user`)
                    VALUES ('$this->description', NOW(), '$deadline', $this->idUtilisateur)";
        $result = $this->pdo->prepare($query);
        $result->execute();

        $this->id = $this->pdo->lastInsertId();
        return $this;
    }


    public function selectByUser() {

        // !!!!!!!!! Requête à modifier ultérieurement voir cours sécurité !!!!!!!!!!!
        $query = "SELECT `id_task`, `description`, `created_at`, `todo_at` FROM Tasks WHERE id_user = $this->idUtilisateur";
        $result = $this->pdo->prepare($query);
        $result->execute();

        $datas = $result->fetchAll();

        $tab = [];
        if($datas) {
            foreach($datas as $data) {
                $new = new Tache();
                $new->setId($data['id_task']);
                $new->setDescription($data['description']);
                $new->setCreation($data['created_at']);
                $new->setDeadline($data['todo_at']);
                array_push($tab, $new);
            }
        }

        return $tab;
    }


    function delete(){

        // !!!!!!!!! Requête à modifier ultérieurement voir cours sécurité !!!!!!!!!!!
        $query = "DELETE FROM Tasks WHERE id_task = $this->id AND id_user = $this->idUtilisateur";
        $result = $this->pdo->prepare($query);
        $result->execute();

    }

    function update(){

        // !!!!!!!!! Requête à modifier ultérieurement voir cours sécurité !!!!!!!!!!!
        $query = "UPDATE Tasks 
                SET `description` = '$this->description', `todo_at` = '$this->deadline'
                WHERE id_task = $this->id AND id_user = $this->idUtilisateur";
        $result = $this->pdo->prepare($query);
        $result->execute();

        return $this;
    }

    function select(){

        // !!!!!!!!! Requête à modifier ultérieurement voir cours sécurité !!!!!!!!!!!
        $query = "SELECT `description`, `created_at`, `todo_at`, `id_user` FROM Tasks 
                WHERE id_task = $this->id";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $data = $result->fetch();

        if($data) {
            $this->setDescription($data['description']);
            $this->setCreation($data['created_at']);
            $this->setDeadline($data['todo_at']);
            $this->setIdUtilisateur($data['id_user']);
        }
        return $this;
    }

    function selectAll(){

        $query = "SELECT `id_task`, `description`, `created_at`, `todo_at`, `id_user` FROM Tasks";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas = $result->fetchAll();
        
        $tab = [];
        if($datas) {
            foreach($datas as $data) {
                $new = new Tache();
                $new->setId($data['id_task']);
                $new->setDescription($data['description']);
                $new->setCreation($data['created_at']);
                $new->setDeadline($data['todo_at']);
                $this->setIdUtilisateur($data['id_user']);
                array_push($tab, $new);
            }
        }

        return $tab;
    }
}