<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li class="active">Управление категориями</li>
                </ul>
                <br>
                <div>
                    <a href="/admin/category/create" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Добавить категорию</a>
                </div>
                <br>
                <h4>Список категорий</h4>
                <br>
                <div><?php if (isset($message)) {echo "<i class='my-red-color'>".$message."</i><br><br>";} ?></div>
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered table-hover table-striped">
                        <tr>
                            <th>ID категории</th>
                            <th>Название категории</th>
                            <th>Порядковый номер</th>
                            <th>Статус</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                        <?php foreach ($categories as $category) : ?>
                            <tr>
                                <td><?= (int)$category['id']; ?></td>
                                <td><?= htmlentities($category['name']); ?></td>
                                <td><?= (int)$category['sort_order']; ?></td>
                                <td><?= Category::changeStatusToText((int)$category['status']); ?></td>
                                <td>
                                    <a href="/admin/category/update/<?= (int)$category['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="/admin/category/delete/<?= (int)$category['id']; ?>" method="post">
                                        <button name="submit"
                                                type="submit"
                                                class="my-button-delete-category"
                                                onclick="return confirm('Вы уверены что хотите удалить категорию?');"
                                        >
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>