<?php  ?>

<h1>Mes choses à faire</h1>
<p><a href="index.php?route=deconnexion">Me déconnecter</a></p>
<h2>Ajouter une tache</h2>
<form action="index.php?route=<?= (isset($item))? 'modif_tache' : 'insert_tache' ?>" method="POST">
    <div>
        <input type="text" name="description" placeholder="Entrez votre chose à faire" value="<?= (isset($item))? $item->getDescription(): '' ?>">
    </div>
    <div>
        <label for="date_limite">Deadline</label>
        <input type="date" name="date_limite" id="date_limite" value="<?= (isset($item))? $item->getDeadline()->format("Y-m-d"): '' ?>">
   
        <input type="hidden" name="id_tache" value="<?= (isset($item))? $item->getId() : '' ?>">
        <input type="submit" value="<?= (isset($item))? 'Modifier' : 'Ajouter' ?>"> <?= (isset($item))? '<br><a href="index.php?route=membre">Nouvelle tache</a>' : '' ?>
    </div>
</form>

<table class="tab-taches">
    <tr>
        <th>A faire</th><th>Avant le</th><th></th>
    </tr>

    <?php foreach($taches as $tache): ?>
        <tr>
            <td><?= $tache->getDescription() ?></td>
            <td><?= $tache->getDeadline()->format('d/m/Y') ?></td>
            <td><a href="index.php?route=membre&tache=<?= $tache->getId() ?>">Modifier</a> | <a class="alert" href="index.php?route=delete_tache&id_tache=<?= $tache->getId() ?>">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>

</table>