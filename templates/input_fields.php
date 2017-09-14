<? foreach ($this->columnNames() as $columnName):
    $label = $this->labels[$columnName] ?? $columnName;
    $value = $values[$columnName] ?? '';
?>
    <tr>
       <td><?= $label ?>:</td>
       <td><input type="text" name="<?= $columnName ?>" value='<?= $value ?>'/></td>
    </tr>
<? endforeach ?>
