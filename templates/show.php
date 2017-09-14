<h1>
    <?= $this->table ?>
    <input type='button' onclick='document.location.href="?action=add<?= $this->singular ?>"' value='Toevoegen' />
</h1>

<table id='display-list'>
    <tr>
        <? foreach ($this->showInList as $column): ?>
            <th>
                <?= $this->labels[$column] ?>
                <a href='?action=<?= $this->lowercase ?>&order=<?= $column ?>'>↓</a>
            </th>
        <? endforeach ?>
        <th id='actions'>Actie</th>
    </tr>


    <? while($row = $result->fetch_assoc()): ?>
        <? $row = escapeArray($row); ?>
        <tr>
        <? foreach ($this->showInList as $column): ?>
            <td><?= $row[$column] ?></td>
        <? endforeach ?>
        <td id='actions'>
                <a href="index.php?action=edit<?= $this->singular ?>&id=<?= $row[$this->pk] ?>">
                    Bewerken
                </a>
                |
                <a href="javascript:confirmAction('Zeker weten?', 'index.php?action=delete<?= $this->singular ?>&id=<?= $row[$this->pk] ?>')">
                    Verwijderen
                </a>
            </td>
        </tr>
    <? endwhile ?>
</table>
