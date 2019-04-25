<?php include __DIR__."/../layout/Header.tpl"; ?>

<?php include __DIR__."/../layout/Nav.tpl"; ?>

<section>
    <h1><?=$title;?></h1>
    <form action="/sendRegister" autocomplete="on" method="post">
        <fieldset>
            <legend>Новый юзер</legend>
            <label>Логин <input name="login" type="text" required></label><br>
            <label>Пароль1<input name="pass1" type="password" required></label> <br>
            <label>Пароль2<input name="pass2" type="password" required></label><br>
            <button type="submit">Отправить</button>
        </fieldset>
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