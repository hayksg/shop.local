<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li><a href="/admin/user">Управление админами</a></li>
                    <li class="active">Добавление админа</li>
                </ul>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-7 col-sm-8">
                        <h4 class="my-grey-color">Форма для добавления админа</h4><br>
                        <div><?php if (isset($message)) {echo "<i class='my-red-color'>$message</i><br>";} ?></div>
                        <?php if (!empty($errors)) : ?>
                            <ul class="my-ul">
                                <?php foreach ($errors as $error) : ?>
                                    <li class="my-red-color"><?= htmlentities($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <br>
                        <?php endif; ?>
                        <form action="/admin/user/create" method="post" class="my-form">
                            <div class="form-group">
                                <input type="text"
                                       name="name"
                                       value="<?= htmlentities($name); ?>"
                                       placeholder="Имя"
                                       class="form-control"
                                >
                            </div>
                            <div class="form-group">
                            <input type="email"
                                   name="email"
                                   value="<?= htmlentities($email); ?>"
                                   placeholder="Email"
                                   class="form-control"
                            >
                            </div>
                            <div class="form-group">
                            <input type="password"
                                   name="password"
                                   placeholder="Пароль"
                                   class="form-control"
                            >
                            </div>
                            <button type="submit" name="submit" class="btn btn-info">Зарегистрировать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>