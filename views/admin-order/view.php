<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="/admin">Панель администратора</a></li>
                        <li><a href="/admin/order">Управление заказами</a></li>
                        <li class="active">Просмотр заказа</li>
                    </ul>
                    <br>
                    <h4>Таблица заказа</h4>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover table-striped my-table-admin-orders">
                            <tr>
                                <th>ID товара</th>
                                <th>Артикул</th>
                                <th>Название</th>
                                <th>Цена $ US</th>
                                <th>Количество</th>
                            </tr>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?= (int)$product['id']; ?></td>
                                    <td><?= htmlentities($product['code']); ?></td>
                                    <td><?= htmlentities($product['name']); ?></td>
                                    <td><?= htmlentities($product['price']); ?></td>
                                    <td><?= (int)$idsAndQuantity[$product['id']]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <br>
                    <p>Всего товаров: <strong class="my-orange-color"><?= (int)$totalQuantity; ?></strong> шт.</p>
                    <p>На сумму $ US: <strong class="my-orange-color"><?= (float)$totalPrice; ?></strong></p>
                    <br>
                </div>
            </div>
        </div>
    </section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>