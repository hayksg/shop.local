<?php include(ROOT . '/views/layouts/header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <?php if ($result) : ?>
                <h3 class="my-orange-color text-center">Данные редактированы!</h3>
                <?php else : ?>
                <div class="signup-form">
                    <h2>Редактирование данных</h2>
                    <?php if (!empty($errors)) : ?>
                    <ul class="my-ul">
                        <?php foreach ($errors as $error) : ?>
                            <li class="my-red-color"><?= htmlentities($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <br>
                    <?php endif; ?>
                    <form action="/cabinet/edit" method="post" class="my-form">
                        <input type="text" name="name" value="<?= htmlentities($name); ?>" placeholder="Имя">
                        <input type="password" name="password" placeholder="Пароль">
                        <button type="submit" name="submit" class="btn btn-default cart">Редактировать</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>