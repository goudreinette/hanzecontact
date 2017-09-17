<? foreach ($columnNames as $columnName):
    $label = $this->labels[$columnName] ?? $columnName;
    $value = $row[$columnName] ?? '';
?>
    <tr>
       <td><?= $label ?>:</td>
       <td><input type="text" name="<?= $columnName ?>" value='<?= $value ?>'/></td>
    </tr>
<? endforeach ?>
