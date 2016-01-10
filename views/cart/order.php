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
                        <div>
                            <div>Всего товаров:
                                <strong class="my-orange-color"><?= (int)$totalProductCount; ?></strong> .шт
                            </div>
                            <div>На сумму: US $
                                <strong class="my-orange-color"><?= (float)$totalPrice; ?></strong>
                            </div>
                        </div>
                        <br>
                        <h5 class="my-grey-color">Для того чтобы оформить заказ заполните пожалуйста форму:</h5>
                        <br>
                        <div class="row">
                            <div class="col-lg-10 col-md-11 col-sm-12">
                                <?php if (!empty($errors)) : ?>
                                    <ul class="my-ul">
                                        <?php foreach ($errors as $error) : ?>
                                            <li class="my-red-color"><?= htmlentities($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <br>
                                <?php endif; ?>
                                <div class="signup-form">
                                    <form action="/cart/order" method="post" class="my-form">
                                        <input type="text" name="name" value="<?= $userName; ?>" placeholder="Вашe имя">
                                        <input type="text" name="phone" placeholder="Номер телефона">
                                        <textarea name="comment" placeholder="Комментарий к заказу"></textarea>
                                        <button type="submit" name="submit" class="btn btn-default cart">Оформить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>