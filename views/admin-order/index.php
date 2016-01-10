<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li class="active">Управление заказами</li>
                </ul>
                <br>
                <?php if (empty($orders)) : ?>
                <h4 class="my-grey-color">Новых заказов нет</h4>
                <?php else : ?>
                <h4>Список заказов</h4>
                <br>
                <div><?php if (isset($message)) {echo "<i class='my-red-color'>".$message."</i><br><br>";} ?></div>
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered table-hover table-striped my-table-admin-orders">
                        <tr>
                            <th>ID товара</th>
                            <th>Имя покупателя</th>
                            <th>Телефон</th>
                            <th>Комментарий к заказу</th>
                            <th>Дата заказа</th>
                            <th>Статус</th>
                            <th>Посмотреть заказ</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?= (int)$order['id']; ?></td>
                                <td><?= htmlentities($order['user_name']); ?></td>
                                <td><?= htmlentities($order['user_phone']); ?></td>
                                <td><?= htmlentities($order['user_comment']); ?></td>
                                <td><?= htmlentities($order['date']); ?></td>
                                <td><?= Order::orderStatusToText($order['status']); ?></td>
                                <td>
                                    <a href="/admin/order/view/<?= (int)$order['id']; ?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/order/update/<?= (int)$order['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="/admin/order/delete/<?= (int)$order['id']; ?>" method="post">
                                        <button class="my-button-delete"
                                                name="submit"
                                                type="submit"
                                                onclick="return confirm('Вы уверены что хотите удалить заказ?');"
                                        >
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <br>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>