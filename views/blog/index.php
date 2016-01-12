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
                    <?php if (empty($blogs)) : ?>
                        <h4 class="my-grey-color my-title-no-goods">В блоге нет записей</h4>
                    <?php else : ?>
                    <div class="row">
                        <div class="col-sm-12">
                        <?php foreach ($blogs as $blog) : ?>
                            <div class="my-grey-color my-blog-container">
                                <img src="/template<?= htmlentities($blog['image']); ?>"
                                     class="pull-left"
                                     width="288"
                                     height="132"
                                     alt="image"
                                >
                                <h4><?= htmlentities($blog['title']); ?></h4>
                                <p class="my-date-color">
                                    <i class="fa fa-calendar"></i>
                                    <?= FunctionLibrary::dateFormat($blog['dt'], false); ?>
                                </p>
                                <p><?= htmlentities($blog['description']); ?></p>
                                <p>
                                    <a href="/blog/view/<?= (int)$blog['id']; ?>" class="my-orange-color">
                                        Читать дальше &gt;
                                    </a>
                                </p>
                            </div>
                            <hr>
                            <br>
                            <br>
                        <?php endforeach; ?>
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