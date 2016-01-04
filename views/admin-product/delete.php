<?php include(ROOT . '/views/layouts/admin-header.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="/admin">Панель администратора</a></li>
                        <li><a href="/admin/product">Управление товарами</a></li>
                        <li class="active">Удаление товара</li>
                    </ul>
                    <br>
                    <h4 class="my-grey-color">Вы уверены что хотите удалить этот товар?</h4>
                    <div><?php if (isset($message)) {echo "<i class='my-red-color'>$message</i>";} ?></div>
                    <br>
                    <div>
                        <img src="/template<?= htmlentities($product['image']); ?>" class="my-image">
                    </div>
                    <br>
                    <br>
                    <div>
                        <form action="/admin/product/delete/<?= (int)$product['id']; ?>"
                              method="post"
                              class="my-form-delete-product"
                        >
                            <button name="submit" class="btn btn-danger">
                                <i class="fa fa-trash-o fa-lg"></i> Удалить
                            </button>
                        </form>
                        <a href="/admin/product" class="btn btn-info">Не удалять</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>