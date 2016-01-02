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
                    <h2 class="title text-center">Контакты</h2>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                        <?php if ($result) : ?>
                            <h3 class="my-orange-color text-center">Письма отправлено!</h3>
                        <?php else : ?>
                            <div class="signup-form">
                                <h5 class="my-grey-color">Для того чтобы отправить нам сообщение заполните пожалуйста форму</h5><br>
                                <?php if (!empty($errors)) : ?>
                                    <ul class="my-ul">
                                        <?php foreach ($errors as $error) : ?>
                                            <li class="my-red-color"><?= htmlentities($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <br>
                                <?php endif; ?>
                                <form action="/contacts" method="post" class="my-form">
                                    <input type="email" name="email" value="" placeholder="Email">
                                    <input type="text" name="subject" value="" placeholder="Тема сообщения">
                                    <textarea name="message" placeholder="Текст сообщения"></textarea>
                                    <button type="submit" name="submit" class="btn btn-default cart">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="my-pagination">
                    <?php if (isset($pagination)) {echo $pagination->get();}?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>