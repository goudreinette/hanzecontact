<h1><?= $this->singular ?> bewerken</h1>
<form method="post" action="index.php?action=update<?= $this->singular ?>">
     <table>
        <? foreach (array_diff($this->columnNames(), ['Picture']) as $columnName):
            $label = $this->labels[$columnName] ?? $columnName;
            $value = $row[$columnName] ?? '';
        ?>
            <tr>
               <td><?= $label ?>:</td>
               <td><input type="text" name="<?= $columnName ?>" value='<?= $value ?>'/></td>
            </tr>
        <? endforeach ?>
        <? include "templates/submit_button.php" ?>
     </table>
     <input type="hidden" name="<?=$this->pk ?>" value='<?= $row[$this->pk] ?>' />
 </form>
