<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li><a href="/admin/blog">Управление блогом</a></li>
                    <li class="active">Создание блога</li>
                </ul>
                <br>
                <h4>Форма для создания</h4>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div><?= FunctionLibrary::showErrors($errors); ?></div>
                        <div><?php if (isset($message)) {echo "<i class='my-red-color'>".$message."</i><br><br>";} ?></div>
                        <form action="/admin/blog/create" method="post" enctype="multipart/form-data" class="my-form">
                            <div class="form-group">
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       placeholder="Заглавие"
                                       value="<?= htmlentities($title); ?>"
                                >
                            </div>
                            <div class="form-group">
                                <textarea name="description"
                                          class="form-control"
                                          placeholder="Описание"
                                ><?= htmlentities($description); ?></textarea>
                            </div>
                            <div class="form-group">
                                <textarea name="content"
                                          class="form-control"
                                          placeholder="Содержание"
                                ><?= htmlentities($content); ?></textarea>
                            </div>
                            <div class="form-group">
                                <p>Загрузить фотографию:</p>
                                <input type="file" name="image" class="jfilestyle form-control">
                            </div>
                            <br>
                            <button name="submit" class="btn btn-info">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>