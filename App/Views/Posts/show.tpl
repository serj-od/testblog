<?php include __DIR__."/../layout/Header.tpl"; ?>

<?php include __DIR__."/../layout/Nav.tpl"; ?>

<section>
    <h3><?=htmlentities($post->title);?></h3>
    <?=htmlentities($post->text);?>
    <p style="text-align:right;"><?=htmlentities($post->user->login ." - ". $post->date);?></p>
</section>
<aside>
    <!-- Sidebar -->
</aside>

<?php include __DIR__."/../layout/Footer.tpl"; ?>