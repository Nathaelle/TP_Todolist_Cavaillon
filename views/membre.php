<h1>Mes choses à faire</h1>
<h2>Ajouter une tache</h2>
<form action="index.php?route=" method="POST">
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

    <tr>
        <td>Tache 1</td><td>06/12/2019</td>
    </tr>
    <tr>
        <td>Tache 2</td><td>06/12/2019</td>
    </tr>
    <tr>
        <td>Tache N</td><td>06/12/2019</td>
    </tr>

</table>