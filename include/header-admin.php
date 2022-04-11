<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="<?php echo BASE_URL ?>">
                    <h1>My block</h1>
                </a>
            </div>

            <nav class="col-8">
                <?php if (isset($_SESSION['id'])):?>
                <ul>
                    <li>
                            <a href="<?php echo BASE_URL . 'log.php'; ?>">
                                <i class="fa-solid fa-user-large"></i>
                                <?php echo $_SESSION['login']; ?>
                            </a>
                    </li>
                                <li>
                                    <a href="<?php echo BASE_URL . 'logout.php'; ?>">Выход </a>
                                </li>

                </ul>
                <?php else:?>

                <ul>
                    <li>
                        <a href="<?php echo BASE_URL . 'log.php';?>">
                            <i class="fa-solid fa-user-large"></i>
                            Войти
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL . 'reg.php'; ?>">Регистрация</a>
                    </li>
                </ul>
                <?php endif;?>

            </nav>
        </div>
    </div>
</header>


