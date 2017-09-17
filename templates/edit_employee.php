<h1>Medewerker bewerken</h1>
<form method="post" action="index.php?action=updateemployee">
     <table>
        <? include "templates/input_fields.php" ?>
         <img src="pictures/<?=$row['Picture']?>" alt="">
         <input type="file" name="Picture" value='' />
        <? include "templates/submit_button.php" ?>
     </table>
     <input type="hidden" name="<?=$this->pk ?>" value='<?= $row[$this->pk] ?>' />
 </form>
