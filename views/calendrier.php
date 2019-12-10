<h1 class="text-center">Mon planning</h1>
<h2 class="text-center">Mois de <?= $month->getMonthName() ?> <?= $month->getYear() ?></h2>

<div class="nav-arrow">
    <div class="left-arrow"></div>
    <div class="right-arrow"></div>
</div>
<table class="table-calendrier">
    <?php for($i = 0; $i < $month->getNbWeeks(); $i++): ?>
        <tr>
            <?php foreach(Models\Month::DAY_NAME_FR as $k => $day): ?>
                <td>
                    <?php $class = ($month->getFirstMonday()->modify("+ ".($k + $i*7)." day")->format('m') === $month->getFirst()->format('m'))? "current" : "out";
                    ?>
                    <span class="<?= $class ?>-day"><?= $day ?></span><br>
                    <span class=<?= $class ?>><?= $month->getFirstMonday()->modify("+ ".($k + $i*7)." day")->format('d') ?></span>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endfor; ?>
</table>














