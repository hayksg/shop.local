<?php include(ROOT . '/views/layouts/header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if (empty($orders)) : ?>
                <h4 class="my-grey-color">Новых заказов нету.</h4>
                <?php else : ?>
                    <?php foreach ($orders as $order) : ?>
                    <?php
                        $userOrderArray =  FunctionLibrary::showUserOrder($order);

                        $products       = $userOrderArray[0];
                        $totalPrice     = $userOrderArray[1];
                        $totalQuantity  = $userOrderArray[2];
                        $idsAndQuantity = $userOrderArray[3];
                        $date           = $userOrderArray[4];
                        $status         = $userOrderArray[5];
                    ?>
                    <br>
                    <br>
                    <p>Дата заказа: &nbsp;<strong class="my-orange-color"><?= htmlentities($date); ?></strong></p>
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
                    <div>Статус: &nbsp;<strong class="my-orange-color"><?= htmlentities(Order::orderStatusToText($status)); ?></strong></div>
                    <div>Всего товаров: &nbsp;<strong class="my-orange-color"><?= (int)$totalQuantity; ?></strong> шт.</div>
                    <div>На сумму $ US: &nbsp;<strong class="my-orange-color"><?= (float)$totalPrice; ?></strong></div>
                    <hr class="my-hr">
                    <br>
                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>