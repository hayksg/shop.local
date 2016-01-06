<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li class="active">Редактирование товара</li>
                </ul>
                <br>
                <h4 class="my-grey-color">Форма для редактирования</h4>
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
                        <form action="/admin/product/update/<?= (int)$product['id']; ?>" method="post" enctype="multipart/form-data" class="my-form">
                            <div class="form-group">
                                <p>Название:</p>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="<?= htmlentities($product['name']); ?>"
                                >
                            </div>
                            <div class="form-group">
                                <p>Артикул:</p>
                                <input type="text"
                                       name="code"
                                       class="form-control"
                                       value="<?= (int)$product['code']; ?>"
                                >
                            </div>
                            <div class="form-group">
                                <p>Цена US $:</p>
                                <input type="text"
                                       name="price"
                                       class="form-control"
                                       value="<?= (float)$product['price']; ?>"
                                >
                            </div>
                            <div class="form-group">
                                <p>Изготовитель:</p>
                                <input type="text"
                                       name="brand"
                                       class="form-control"
                                       value="<?= htmlentities($product['brand']); ?>"
                                >
                            </div>
                            <div class="form-group">
                                <p>Выберите категорию:</p>
                                <select name="category_id" class="form-control">
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= (int)$category['id']; ?>"
                                                <?php if ($category['id'] == $product['category_id']) {echo "selected";} ?>
                                        >
                                            <?= htmlentities($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Есть в наличии:</p>
                                <select name="availability" class="form-control">
                                    <option value="1" <?php if ($product['availability'] == 1) {echo "selected='selected'";} ?> >Да</option>
                                    <option value="0" <?php if ($product['availability'] == 0) {echo "selected='selected'";} ?> >Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Новый товар:</p>
                                <select name="is_new" class="form-control">
                                    <option value="1" <?php if ($product['is_new'] == 1) {echo "selected='selected'";} ?> >Да</option>
                                    <option value="0" <?php if ($product['is_new'] == 0) {echo "selected='selected'";} ?> >Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Рекомендуемый:</p>
                                <select name="is_recommended" class="form-control">
                                    <option value="1" <?php if ($product['is_recommended'] == 1) {echo "selected='selected'";} ?> >Да</option>
                                    <option value="0" <?php if ($product['is_recommended'] == 0) {echo "selected='selected'";} ?> >Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Показывать товар:</p>
                                <select name="status" class="form-control">
                                    <option value="1" <?php if ($product['status'] == 1) {echo "selected='selected'";} ?> >Да</option>
                                    <option value="0" <?php if ($product['status'] == 0) {echo "selected='selected'";} ?> >Нет</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Описание:</p>
                                <textarea name="description" class="form-control"><?= htmlentities($product['description']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <p>Изображение товара:</p>
                                <br>
                                <div>
                                    <img src="/template<?= htmlentities($product['image']); ?>"
                                         width="268"
                                         height="249"
                                         alt="image"
                                         class="my-image"
                                    >
                                </div>
                                <br>
                                <br>
                                <input type="file" name="image" class="jfilestyle form-control">
                            </div>
                            <br>
                            <button name="submit" class="btn btn-success">Редактировать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>