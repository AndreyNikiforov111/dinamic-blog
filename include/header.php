<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="<?php echo BASE_URL ?>">
                    <h1>My block</h1>
                </a>
            </div>

            <nav class="col-8">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Главная</a></li>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Услуги</a></li>
                    <li>
                        <?php if(isset($_SESSION['id'])): ?>             <!--Код между сработает только если isset ответит true !!!-->
                            <a href="#">
                                <i class="fa-solid fa-user-large"></i>
                               <?php echo $_SESSION['login']; ?>
                            </a>
                            <ul>
                                <?php if ($_SESSION['admin']): ?>
                                <li><a href="<?= BASE_URL . 'admin/posts/index.php'; ?>">Админ панель</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo BASE_URL . 'logout.php'; ?>">Выход </a></li>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL . 'log.php';?>">
                                <i class="fa-solid fa-user-large"></i>
                                Войти
                            </a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'reg.php'; ?>">Регистрация</a></li>
                            </ul>
                        <?php endif; ?>

                    </li>

                </ul>
            </nav>
        </div>
    </div>
</header>

