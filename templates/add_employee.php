<h1>Medewerker toevoegen</h1>
<form method="post" action="index.php?action=insertemployee" enctype="multipart/form-data">
    <table>
        <? foreach (array_diff($columns) as $columnName):
            $label = $this->labels[$columnName] ?? $columnName;
            $value = $row[$columnName] ?? '';
        ?>
            <tr>
               <td><?= $label ?>:</td>
               <td><input type="text" name="<?= $columnName ?>" value='<?= $value ?>'/></td>
            </tr>
        <? endforeach ?>
        <tr>
           <td>Picture:</td>
           <td> <input type="file" name="Picture"/></td>
        </tr>
        <? include "templates/submit_button.php" ?>
    </table>
</form>
