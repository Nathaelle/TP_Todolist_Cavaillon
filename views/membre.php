<h1>Mes choses à faire</h1>
<p><a href="index.php?route=deconnexion">Me déconnecter</a></p>
<h2>Ajouter une tache</h2>
<form action="index.php?route=insert_tache" method="POST">
    <div>
        <input type="text" name="description" placeholder="Entrez votre chose à faire">
    </div>
    <div>
        <label for="date_limite">Deadline</label>
        <input type="date" name="date_limite" id="date_limite">
    </div>
    <div>
        <input type="submit" value="Ajouter">
    </div>
</form>

<table>
    <tr>
        <th>A faire</th><th>Avant le</th>
    </tr>

    <?php foreach($taches as $tache): ?>
        <tr>
            <td><?= $tache->getDescription() ?></td><td><?= $tache->getDeadline() ?></td>
        </tr>
    <?php endforeach; ?>

</table>