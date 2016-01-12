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
                        <h2 class="title text-center">Блог</h2>
                        <?php if (!empty($blog)) : ?>
                        <div class="row my-blog-container">
                            <div class="col-sm-12 my-grey-color">
                                <h3 class="my-blog-h3"><?= htmlentities($blog['title']); ?></h3>
                                <p class="my-date-color">
                                    <i class="fa fa-calendar"></i>
                                    <?= htmlentities(FunctionLibrary::dateFormat($blog['dt'], false)); ?>
                                </p>
                                <br>
                                <div>
                                    <img src="/template<?= htmlentities($blog['image']); ?>"
                                         width="576"
                                         height="264"
                                         alt="image"
                                    >
                                </div>
                                <br>
                                <br>
                                <div><?= $blog['content']; ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>