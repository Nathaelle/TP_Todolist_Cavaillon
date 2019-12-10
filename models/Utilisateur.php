<?php

namespace Models;

class Utilisateur {

    private $idUtilisateur;
    private $pseudo;
    private $passwd;

    public function __construct() {
        $this->idUtilisateur = -1;
        $this->pseudo = '';
        $this->passwd = '';
    }

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

    public function save_user(): bool {

        // Si le fichier existe déjà, on récupère son contenu, et on décode le format json
        if(file_exists('datas/utilisateurs.json')) {
            $json = file_get_contents('datas/utilisateurs.json');
            $tab_user = json_decode($json);

            foreach($tab_user as $user) {
                if($user->pseudo === $this->pseudo) {
                    return false;
                }
            }
        // Sinon, on crée juste un nouveau tableau vide
        } else {
            $tab_user = [];
        }

        // Ensuite, on "calcule" l'identifiant du nouvel utilisateur
        $this->idUtilisateur = sizeof($tab_user) + 1;

        // Puis on insère toutes les données de cet utilisateur dans le tableau récupéré
        array_push($tab_user, [
            'idUtilisateur' => $this->idUtilisateur,
            'pseudo' => $this->pseudo,
            'passwd' => $this->passwd
            ]);

        // Et enfin, on réécrit dans le fichier, en ayant pris soin de réencoder nos données
        $saved = fopen('datas/utilisateurs.json', 'w');
        fwrite($saved, json_encode($tab_user));
        fclose($saved);

        //var_dump($this);
        return false;
    }

    public function verify_user(): self {

        // Si le fichier existe, on récupère son contenu, et on décode le format json
        if(file_exists('datas/utilisateurs.json')) {
            $json = file_get_contents('datas/utilisateurs.json');
            $tab_user = json_decode($json);

            foreach($tab_user as $user) {
                if($user->pseudo === $this->pseudo) {
                    $this->passwd = $user->passwd;
                    $this->idUtilisateur = $user->idUtilisateur;
                }
            }
        } 
        return $this;
    }
}