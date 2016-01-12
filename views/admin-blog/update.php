<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li><a href="/admin/blog">Управление блогом</a></li>
                    <li class="active">Редактирование блога</li>
                </ul>
                <br>
                <h4>Форма для редактирования</h4>
                <br>
                <?php if (!empty($blog)) : ?>
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10">
                        <div><?= FunctionLibrary::showErrors($errors); ?></div>
                        <div><?php if (isset($message)) {echo "<i class='my-red-color'>".$message."</i><br><br>";} ?></div>
                        <form action="/admin/blog/update/<?= (int)$blog['id']; ?>" method="post" enctype="multipart/form-data" class="my-form">
                            <div class="form-group">
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       placeholder="Заглавие"
                                       value="<?= htmlentities($blog['title']); ?>"
                                >
                            </div>
                            <div class="form-group">
                            <textarea name="description"
                                      class="form-control"
                                      placeholder="Описание"
                            ><?= htmlentities($blog['description']); ?></textarea>
                            </div>
                            <div class="form-group">
                            <textarea name="content"
                                      class="form-control"
                                      placeholder="Содержание"
                            ><?= htmlentities($blog['content']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <p>Редактировать фотографию:</p>
                                <br>
                                <img src="/template/<?= htmlentities($blog['image']); ?>"
                                     width="288"
                                     height="132"
                                     alt="image"
                                >
                                <br>
                                <br>
                                <input type="file" name="image" class="jfilestyle form-control">
                            </div>
                            <br>
                            <button name="submit" class="btn btn-info">Редактировать</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>