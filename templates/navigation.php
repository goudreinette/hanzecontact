<div id="navigation">
    <div>
        <img id='logo' src='./pictures/logo.jpeg'/>
        <a href="index.php?action=home">
            Home
        </a>
    </div>

    <? foreach ($resources as $resource): ?>
        <div>
            <a href="index.php?action=<?=$resource->lowercase?>">
                <?=$resource->table?>
            </a>
        </div>
    <? endforeach; ?>
</div>
