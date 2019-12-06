## Sommaire des routes

Il s'agit de définir de manière EXHAUSTIVE toutes les routes, c'est à dire, tous les appels à telle ou telle fonctionnalité (que ce soit de l'affichage, ou de la gestion des données, ou autre calcul etc...)

Nos routes seront appellées via la transmission d'un paramètre spécial dans notre requête, nous utiliserons la clé `route`

Syntaxe : `/index.php?route=qquechose`

Et seront récupérées par notre index (point d'entrée), dans `$_REQUEST['route']`

Liste des fonctionnalités appellées :
- Afficher la page d'accueil : route=home (affichage)
- Afficher l'espace membre : route=membre (affichage)
- Insérer un nouvel utilisateur (action du formulaire) : route=insert_user (redirection vers affichage)
- Se connecter : route=connect_user (redirection vers affichage)
- Se déconnecter : route=deconnexion (redirection vers affichage)

Ou chaque valeur possible, pour ce paramètre (route) est définie dans une structure de contrôle : notre ROUTEUR (switch)