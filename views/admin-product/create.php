<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li class="active">Добавление товара</li>
                </ul>
                <br>
                <h4 class="my-grey-color">Для добавления товара заполните пожалуйста форму</h4>
                <div><?php if (isset($message)) {echo "<br><i class='my-red-color'>$message</i><br>";} ?></div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <?php if (!empty($errors)) : ?>
                            <ul class="my-ul">
                                <?php foreach ($errors as $error) : ?>
                                    <li class="my-red-color"><?= htmlentities($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <br>
                        <?php endif; ?>
                        <form action="/admin/product/create" method="post" enctype="multipart/form-data" class="my-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Название">
                            </div>
                            <div class="form-group">
                                <input type="text" name="code" class="form-control" placeholder="Артикул">
                            </div>
                            <div class="form-group">
                                <input type="text" name="price" class="form-control" placeholder="Цена">
                            </div>
                            <div class="form-group">
                                <input type="text" name="brand" class="form-control" placeholder="Изготовитель">
                            </div>
                            <div class="form-group">
                                <p>Выберите категорию:</p>
                                <select name="category_id" class="form-control">
                                    <?php foreach ($categories as $category) : ?>
                                    <option value="<?= (int)$category['id']; ?>"><?= htmlentities($category['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Есть в наличии:</p>
                                <select name="availability" class="form-control">
                                    <option value="1" selected="selected">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Новый товар:</p>
                                <select name="is_new" class="form-control">
                                    <option value="1" selected="selected">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Рекомендуемый:</p>
                                <select name="is_recommended" class="form-control">
                                    <option value="1" selected="selected">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Показывать товар:</p>
                                <select name="status" class="form-control">
                                    <option value="1" selected="selected">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" placeholder="Описание"></textarea>
                            </div>
                            <div class="form-group">
                                <p>Загрузить фотографию:</p>
                                <input type="file" name="image" class="jfilestyle form-control">
                            </div>
                            <br>
                            <button name="submit" class="btn btn-success">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>