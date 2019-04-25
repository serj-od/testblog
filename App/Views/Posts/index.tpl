<?php include __DIR__."/../layout/Header.tpl"; ?>

<?php include __DIR__."/../layout/Nav.tpl"; ?>


<section>

    <?php if (isset($err) && count($err) > 0):?>
    <?php foreach($err as $error): ?>
    <?=$error;?> <br>
    <?php endforeach; ?>
    <?php endif;?>

    <?php foreach ($all as $p) : ?>
    <?php if (isset($_SESSION["user"]) && $_SESSION["user"] instanceof \Core\Model): ?>
    <a href="/posts/delete/<?=$p->id;?>">УДАЛИТЬ</a> \
    <a href="/posts/edit/<?=$p->id;?>">РЕДАКТИРОВАТЬ</a> \
    <?php endif; ?>

    <a href="/posts/<?=$p->id;?>"><h3><?=htmlentities($p->title);?></h3></a>
    <?=htmlentities($p->text);?>
    <p style="text-align:right;"><?=htmlentities($p->user->login ." - ". $p->date);?></p>
    <hr>
    <?php endforeach; ?>
</section>
<aside>
</aside>

<?php include __DIR__."/../layout/Footer.tpl"; ?>