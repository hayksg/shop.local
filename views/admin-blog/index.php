<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="/admin">Панель администратора</a></li>
                        <li class="active">Управление блогом</li>
                    </ul>
                    <br>
                    <?php if (empty($blogs)) : ?>
                    <h4>В блоге пусто.</h4>
                    <br>
                    <div>
                        <a href="/admin/blog/create" class="btn btn-success">
                            <i class="fa fa-plus"></i> &nbsp;Добавить запись
                        </a>
                    </div>
                    <?php else : ?>
                    <div>
                        <a href="/admin/blog/create" class="btn btn-success">
                            <i class="fa fa-plus"></i> &nbsp;Добавить блог
                        </a>
                    </div>
                    <br>
                    <h4>Список блогов</h4>
                    <br>
                    <div><?php if (isset($message)) {echo "<i class='my-red-color'>".$message."</i><br><br>";} ?></div>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover table-striped my-table-blog">
                            <tr>
                                <th>ID</th>
                                <th>Дата</th>
                                <th>Заглавие блога</th>
                                <th>Краткое описание</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($blogs as $blog) : ?>
                                <tr>
                                    <td><?= (int)$blog['id']; ?></td>
                                    <td class="my-date"><?= FunctionLibrary::dateFormat(htmlentities($blog['dt'])); ?></td>
                                    <td><?= htmlentities($blog['title']); ?></td>
                                    <td><?= $blog['description']; ?></td>
                                    <td>
                                        <a href="/admin/blog/update/<?= (int)$blog['id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="/admin/blog/delete/<?= (int)$blog['id']; ?>" method="post">
                                            <button name="submit"
                                                    type="submit"
                                                    class="my-button-delete"
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>