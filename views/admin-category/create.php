<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Добавление категории</li>
                </ul>
                <br>
                <h4 class="my-grey-color">Для добавления категории заполните пожалуйста форму</h4>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div><?php if (isset($message)) {echo "<i class='my-red-color'>$message</i><br><br>";} ?></div>
                        <?= FunctionLibrary::showErrors($errors); ?>
                        <form action="/admin/category/create" method="post" class="my-form">
                            <div class="form-group">
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Название"
                                       value="<?= htmlentities($name); ?>"
                                >
                            </div>
                            <div class="form-group">
                                <p>Порядковый номер:</p>
                                <select name="sortOrder" class="form-control">
                                    <?php for ($count = 1; $count <= $totalCategory; $count++) : ?>
                                        <option value="" disabled>
                                            <?= (int)$count; ?>
                                        </option>
                                    <?php endfor; ?>
                                    <option value="<?= (int)$totalCategory + 1; ?>" selected="selected">
                                        <?= (int)$totalCategory + 1; ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Отображение:</p>
                                <select name="status" class="form-control">
                                    <option value="1" selected="selected">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>
                            <br>
                            <button name="submit" class="btn btn-info">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>