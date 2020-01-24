<?php 
// Adaptateur pour éviter de devoir modifier le template (et ne pas rallonger le nom des variables)
$taches = $view['datas']['taches'];
$item = (isset($view['datas']['item'])? $view['datas']['item'] : null);
?>

<h1>Mes choses à faire</h1>
<p><a href="deconnexion.html">Me déconnecter</a></p>
<h2>Ajouter une tache</h2>
<form action="<?= (isset($item))? 'modif_tache' : 'insert_tache' ?>.html" method="POST">
    <div>
        <input type="text" name="description" placeholder="Entrez votre chose à faire" value="<?= (isset($item))? htmlspecialchars($item->getDescription()): '' ?>">
    </div>
    <div>
        <label for="date_limite">Deadline</label>
        <input type="date" name="date_limite" id="date_limite" value="<?= (isset($item))? htmlspecialchars($item->getDeadline()->format("Y-m-d")): '' ?>">
   
        <input type="hidden" name="id_tache" value="<?= (isset($item))? htmlspecialchars($item->getId()) : '' ?>">
        <input type="submit" value="<?= (isset($item))? 'Modifier' : 'Ajouter' ?>"> <?= (isset($item))? '<br><a href="membre.html">Nouvelle tache</a>' : '' ?>
    </div>
</form>

<table class="tab-taches">
    <tr>
        <th>A faire</th><th>Avant le</th><th></th>
    </tr>

    <?php foreach($taches as $tache): ?>
        <tr>
            <td><?= htmlspecialchars($tache->getDescription()) ?></td>
            <td><?= htmlspecialchars($tache->getDeadline()->format('d/m/Y')) ?></td>
            <td><a href="membre-<?= htmlspecialchars($tache->getId()) ?>.html">Modifier</a> | <a class="alert" href="delete_tache-<?= htmlspecialchars($tache->getId()) ?>.html">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>

</table>