<h1><?= $this->labels[$this->singular] ?? $this->singular  ?> bewerken</h1>
<form method="post" action="index.php?action=update<?= $this->singular ?>">
     <table>
        <? include "templates/input_fields.php" ?>
        <? include "templates/submit_button.php" ?>
     </table>
     <input type="hidden" name="<?=$this->pk ?>" value='<?= $row[$this->pk] ?>' />
 </form>
