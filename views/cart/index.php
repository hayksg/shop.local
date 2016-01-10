<?php include(ROOT . '/views/layouts/header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $category) : ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= (int)$category['id']; ?>" class="my-category-link">
                                            <?= htmlentities($category['name']); ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>
                    <div class="my-right-box">
                        <?php if (empty($products)) : ?>
                            <h4 class="my-grey-color my-title-no-goods">
                                <?php echo ($message) ? $message : 'Корзина пуста!'; ?>
                            </h4>
                        <?php else: ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover my-table-products">
                                        <tr>
                                            <th>Артикул</th>
                                            <th>Название</th>
                                            <th>Цена US $</th>
                                            <th>Количество шт.</th>
                                            <th>Удалить</th>
                                        </tr>
                                        <?php foreach ($products as $product) : ?>
                                        <tr>
                                            <td><?= (int)$product['code']; ?></td>
                                            <td><?= htmlentities($product['name']); ?></td>
                                            <td><?= (float)$product['price']; ?></td>
                                            <td><?= (int)$sessionProducts[$product['id']]; ?></td>
                                            <td><a href="/cart/delete/<?= (int)$product['id']; ?>">&#10006;</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <p>Общая сумма: US $
                                    <strong class="my-orange-color"><?= (float)$totalPrice; ?></strong>
                                </p>
                                <br>
                                <div>
                                    <a href="/cart/order" class="btn btn-default cart">Оформить заказ</a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>