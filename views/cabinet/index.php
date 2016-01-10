<?php include(ROOT . '/views/layouts/header.php'); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="my-grey-color">Кабинет пользователя</h4>
                <h5 class="my-grey-color">Добро пожаловать:
                    <strong  class="my-orange-color"><em>&nbsp;<?= htmlentities($user['name']); ?></em></strong>
                </h5>
                <br>
                <ul class="my-ul my-cabinet-ul">
                    <li><a href="/cabinet/edit">Редактировать данные</a></li>
                    <li><a href="/cabinet/history/<?= (int)$user['id']; ?>">Список покупок</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php'); ?>