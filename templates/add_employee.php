<h1>Medewerker toevoegen</h1>
<form method="post" action="index.php?action=insertemployee" enctype="multipart/form-data">
    <table>
        <tr>
           <td>Picture:</td>
           <td> <input type="file" name="Picture"/></td>
        </tr>
        <? include "templates/input_fields.php" ?>
        <? include "templates/submit_button.php" ?>
    </table>
</form>
