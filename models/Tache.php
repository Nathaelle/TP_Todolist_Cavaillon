<?php

class Tache {

    private $idTache;
    private $description;
    private $deadline;
    private $idUtilisateur;

    public function getIdTache(): int {
        return $this->idTache;
    }

    public function setIdTache(int $id) {
        $this->idTache = $id;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $desc) {
        $this->description = $desc;
    }

    public function getDeadline(): string {
        return $this->deadline;
    }

    public function setDeadline(string $dead) {
        $this->deadline = $dead;
    }

    public function getIdUtilisateur(): int {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }
}