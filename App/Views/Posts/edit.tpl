<?php include __DIR__."/../layout/Header.tpl"; ?>

<?php include __DIR__."/../layout/Nav.tpl"; ?>

<section>
    <form action="/posts/save/<?=$post->id?>" autocomplete="on" method="post">
        <label>Заголовок <input name="title" type="text" size="200" required value="<?=htmlentities($post->title)?>"></label><br>
        <label>Контент
            <textarea rows="20" cols="200" name="content" required>
                <?=htmlentities($post->text);?>
            </textarea>
        </label> <br/>
        <button type="submit">Отправить</button>
    </form>

    <?php if (isset($err) && count($err) > 0):?>
    <?php foreach($err as $error): ?>
    <?=$error;?> <br>
    <?php endforeach; ?>
    <?php endif;?>
</section>
<aside>
    <!-- Sidebar -->
</aside>

<?php include __DIR__."/../layout/Footer.tpl"; ?>