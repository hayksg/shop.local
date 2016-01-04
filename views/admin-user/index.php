<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="/admin">Панель администратора</a></li>
                        <li class="active">Управление админами</li>
                    </ul>
                    <br>
                    <?php if (empty($users)) : ?>
                    <h4 class="my-grey-color">Пока админов нет. Вы можете добавить их.</h4>
                    <br>
                    <div><a href="/admin/user/create" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Добавить админа</a></div>
                    <?php else : ?>
                    <div><a href="/admin/user/create" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Добавить админа</a></div>
                    <br>
                    <h4 class="my-grey-color">Список админов</h4>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-responsive table-bordered table-hover table-striped my-table-admin">
                                    <tr>
                                        <th>Имя</th>
                                        <th>Удалить</th>
                                    </tr>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?= htmlentities($user['name']); ?></td>
                                            <td>
                                                <a href="/admin/user/delete/<?= (int)$user['id']; ?>"
                                                   onclick="return confirm('Вы уверены что хотите удалить админа?');"
                                                >
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
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