<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Редактирование категории</li>
                </ul>
                <br>
                <h4 class="my-grey-color">Для редактировании категории заполните пожалуйста форму</h4>
                <br>
                <?php if (!empty($category)) : ?>
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div><?php if (isset($message)) {echo "<i class='my-red-color'>$message</i><br><br>";} ?></div>
                        <?= FunctionLibrary::showErrors($errors); ?>
                        <form action="/admin/category/update/<?= (int)$category['id']; ?>" method="post" class="my-form">
                            <div class="form-group">
                                <p>Название категории:</p>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="<?= htmlentities($category['name']); ?>"
                                >
                            </div>
                            <div class="form-group">
                                <p>Порядковый номер:</p>
                                <select name="sortOrder" class="form-control">
                                    <?php for ($count = 1; $count <= $totalCategory; $count++) : ?>
                                        <?php if ($count == $category['sort_order']) { ?>
                                            <option value="<?= (int)$count; ?>" selected="selected">
                                                <?= (int)$count; ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?= (int)$count; ?>" >
                                                <?= (int)$count; ?>
                                            </option>
                                        <?php } ?>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Отображение:</p>
                                <select name="status" class="form-control">
                                    <option value="1" <?php if ($category['status'] == 1) {echo "selected='selected'";} ?> >Да</option>
                                    <option value="0" <?php if ($category['status'] == 0) {echo "selected='selected'";} ?> >Нет</option>
                                </select>
                            </div>
                            <br>
                            <button name="submit" type="submit" class="btn btn-info">Редактировать</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>