<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="/admin">Панель администратора</a></li>
                        <li><a href="/admin/order">Управление заказами</a></li>
                        <li class="active">Редактирование заказа</li>
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
                            <form action="/admin/order/update/<?= (int)$id; ?>" method="post" enctype="multipart/form-data" class="my-form">
                                <div class="form-group">
                                    <p>Редактировать статус:</p>
                                    <select name="status" class="form-control">
                                        <?php foreach ($orderParams as $key => $value) : ?>
                                            <?php if ($status == $key) : ?>
                                                <option value="<?= (int)$key; ?>" selected="selected">
                                                    <?= htmlentities($value); ?>
                                                </option>
                                            <?php else : ?>
                                                <option value="<?= (int)$key; ?>">
                                                    <?= htmlentities($value); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <button name="submit" type="submit" class="btn btn-success">Редактировать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>