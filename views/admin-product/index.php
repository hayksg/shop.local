<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li class="active">Управление товарами</li>
                </ul>
                <br>
                <div>
                    <a href="/admin/product/create" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Добавить товар</a>
                </div>
                <br>
                <h4>Список товаров</h4>
                <br>
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered table-hover table-striped my-table-admin-goods">
                        <tr>
                            <th>ID товара</th>
                            <th>Артикул</th>
                            <th>Название</th>
                            <th>Цена US $</th>
                            <th>Изображение</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?= (int)$product['id']; ?></td>
                                <td><?= (int)$product['code']; ?></td>
                                <td><?= htmlentities($product['name']); ?></td>
                                <td><?= (float)$product['price']; ?></td>
                                <td>
                                    <img src="/template<?= htmlentities($product['image']); ?>"
                                         width="60"
                                         height="50"
                                         alt="image"
                                    >
                                </td>
                                <td>
                                    <a href="/admin/product/update/<?= (int)$product['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/product/delete/<?= (int)$product['id']; ?>">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <br>
                <div class="my-pagination">
                    <?php if (isset($pagination)) {echo $pagination->get();}?>
                </div>
                <br>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>