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

    public function getVars() {
        return get_object_vars($this);
    }


    public function insert() {

        $deadline = $this->deadline->format('Y-m-d H:i');

        $query = "INSERT INTO Tasks (`description`, `created_at`, `todo_at`, `id_user`)
                    VALUES (:description, NOW(), :deadline, :user)";
        $result = $this->pdo->prepare($query);
        $result->bindValue('description', $this->description, PDO::PARAM_STR);
        $result->bindValue('deadline', $deadline, PDO::PARAM_STR);
        $result->bindValue('user', $this->idUtilisateur, PDO::PARAM_INT);
        $result->execute();

        $this->id = $this->pdo->lastInsertId();
        return $this;
    }


    public function selectByUser() {

        $query = "SELECT `id_task`, `description`, `created_at`, `todo_at` FROM Tasks WHERE id_user = :user";
        $result = $this->pdo->prepare($query);
        $result->bindValue('user', $this->idUtilisateur, PDO::PARAM_INT);
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
        $query = "DELETE FROM Tasks WHERE id_task = :id AND id_user = :user";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result->bindValue(':user', $this->idUtilisateur, PDO::PARAM_INT);
        $result->execute();

    }

    function update(): ?self {

        $deadline = $this->deadline->format('Y-m-d H:i');

        $query = "UPDATE Tasks 
                SET `description` = :description, `todo_at` = :deadline
                WHERE id_task = :id AND id_user = :user";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':description', $this->description, PDO::PARAM_STR);
        $result->bindValue(':deadline', $deadline, PDO::PARAM_STR);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result->bindValue(':user', $this->idUtilisateur, PDO::PARAM_INT);
        $result->execute();

        return $this;
    }

    function select(){

        $query = "SELECT `description`, `created_at`, `todo_at`, `id_user` FROM Tasks 
                WHERE id_task = :id";
        $result = $this->pdo->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
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