<div id="navigation">
    <div>
        <img id='logo' src='./pictures/logo.jpeg' alt="logo"/>
        <a href="index.php?action=home">
            Home
        </a>
    </div>

    <? foreach ($resources as $resource): ?>
        <div>
            <a href="index.php?action=<?=$resource->lowercase?>">
                <?=$resource->labels[$resource->table] ?? $resource->table?>
            </a>
        </div>
    <? endforeach; ?>
</div>
