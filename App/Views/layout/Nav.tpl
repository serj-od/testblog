<header>
    <h3></h3>
</header>
<nav>
    <a href="/">Главная</a> \
    <a href="/register">Регистрация</a> \
    <a href="/posts/list">Посты</a> \
    <?php if (isset($_SESSION["user"]) && $_SESSION["user"] instanceof \Core\Model): ?>
    <a href="/logout">Выход</a> \
    <a href="/posts/new">Новый пост</a> \
    <?php else: ?>
    <a href="/login">Вход</a> \
    <?php endif; ?>
</nav>
<hr>