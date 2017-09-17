<h1>Medewerker toevoegen</h1>
<form method="post" action="index.php?action=insertemployee" enctype="multipart/form-data">
    <table>
        <? include "templates/input_fields.php" ?>
        <tr>
           <td>Picture:</td>
           <td> <input type="file" name="Picture"/></td>
        </tr>
        <? include "templates/submit_button.php" ?>
    </table>
</form>
