<h1>
    <?= $this->labels[$this->table] ?? $this->table ?>
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
        <th class='actions'>Actie</th>
    </tr>


    <? while($row = $result->fetch_assoc()): ?>
        <? $row = escapeArray($row); ?>
        <tr>
        <? foreach ($this->showInList as $column): ?>
            <td><?= $row[$column] ?></td>
        <? endforeach ?>
        <td class='actions'>
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
