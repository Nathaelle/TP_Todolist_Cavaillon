<?php

class Tache {

    private $idTache;
    private $description;
    private $deadline;
    private $idUtilisateur;

    public function __construct() {}

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

    public function save_tache() {

        // Si le fichier existe déjà, on récupère son contenu, et on décode le format json
        if(file_exists('datas/taches.json')) {
            $json = file_get_contents('datas/taches.json');
            $tab_tache = json_decode($json);

        // Sinon, on crée juste un nouveau tableau vide
        } else {
            $tab_tache = [];
        }

        // Ensuite, on "calcule" l'identifiant de la nouvelle tache
        $this->idTache = sizeof($tab_tache) + 1;
        $this->idUtilisateur = $_SESSION['user']['idUtilisateur'];

        // Puis on insère toutes les données de cet utilisateur dans le tableau récupéré
        array_push($tab_tache, [
            'idTache' => $this->idTache,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'idUtilisateur' => $this->idUtilisateur
            ]);

        // Et enfin, on réécrit dans le fichier, en ayant pris soin de réencoder nos données
        $saved = fopen('datas/taches.json', 'w');
        fwrite($saved, json_encode($tab_tache));
        fclose($saved);

        return false;
    }

    public function select_tache_by_user(): array {

        $user_taches = [];
        // Si le fichier existe, on récupère son contenu, et on décode le format json
        if(file_exists('datas/taches.json')) {
            $json = file_get_contents('datas/taches.json');
            $tab_taches = json_decode($json);

            foreach($tab_taches as $tache) {
                if($tache->idUtilisateur === $_SESSION['user']['idUtilisateur']) {
                    $new = new Tache();
                    $new->setIdTache($tache->idTache);
                    $new->setDescription($tache->description);
                    $new->setDeadline($tache->deadline);
                    $new->setIdUtilisateur($tache->idUtilisateur);
                    array_push($user_taches, $new);
                }
            }
        } 
        return $user_taches;
    }
}