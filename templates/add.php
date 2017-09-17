<h1><?= $this->singular ?> toevoegen</h1>
<form method="post" action="index.php?action=insert<?= $this->singular ?>">
    <table>
        <? include "templates/input_fields.php" ?>
        <? include "templates/submit_button.php" ?>
    </table>
</form>
