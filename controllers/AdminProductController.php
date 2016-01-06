<?php

class AdminProductController extends AdminBase
{
    public function actionIndex($page = 1)
    {
        $page = (int)$page;
        $count = 10;

        $products = Product::getProductsList($count, $page, false);
        if (!$products) {$products = array();}

        $total = Product::getTotalProducts(false);
        $pagination = FunctionLibrary::buildPagination($total, $count, $page, 'page-');

        require_once(ROOT . '/views/admin-product/index.php');
        return true;
    }

    public function actionCreate()
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        if (isset($_POST['submit'])) {
            $options['name']           = FunctionLibrary::clearStr($_POST['name']);
            $options['code']           = FunctionLibrary::clearInt($_POST['code']);
            $options['price']          = FunctionLibrary::clearFloat($_POST['price']);
            $options['brand']          = FunctionLibrary::clearStr($_POST['brand']);
            $options['category_id']    = FunctionLibrary::clearInt($_POST['category_id']);
            $options['availability']   = FunctionLibrary::clearInt($_POST['availability']);
            $options['is_new']         = FunctionLibrary::clearInt($_POST['is_new']);
            $options['is_recommended'] = FunctionLibrary::clearInt($_POST['is_recommended']);
            $options['status']         = FunctionLibrary::clearInt($_POST['status']);
            $options['description']    = FunctionLibrary::clearStr($_POST['description']);

            $errors = array();

            if (!User::checkName($options['name'])) {
                $errors[] = 'Название не может быть пустым.';
            }

            if (empty($errors)) {
                $id = Product::saveProduct($options);
                if (!$id) {
                    $message = 'Произошла ошибка при добавлении товара.';
                } else {
                    $fileName = $_FILES['image']['tmp_name'];

                    if (is_uploaded_file($fileName)) {
                        $pathImage = "/images/home/product{$id}.jpg";
                        $result = Product::putImageToDataBase($id, $pathImage);

                        if (!$result) {
                            $message = 'Произошла ошибка при добавлении картинки.';
                        } else {
                            $destination = ROOT . "/template/images/home/product{$id}.jpg";
                            move_uploaded_file($fileName, $destination);
                            $message = 'Товар добавлен!';
                        }
                    }
                }
            }
        }

        require_once(ROOT . '/views/admin-product/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $product = Product::getProductById($id);
        if (!$product) {$product = array();}

        if (isset($_POST['submit'])) {
            $options['name']           = FunctionLibrary::clearStr($_POST['name']);
            $options['code']           = FunctionLibrary::clearInt($_POST['code']);
            $options['price']          = FunctionLibrary::clearFloat($_POST['price']);
            $options['brand']          = FunctionLibrary::clearStr($_POST['brand']);
            $options['category_id']    = FunctionLibrary::clearInt($_POST['category_id']);
            $options['availability']   = FunctionLibrary::clearInt($_POST['availability']);
            $options['is_new']         = FunctionLibrary::clearInt($_POST['is_new']);
            $options['is_recommended'] = FunctionLibrary::clearInt($_POST['is_recommended']);
            $options['status']         = FunctionLibrary::clearInt($_POST['status']);
            $options['description']    = FunctionLibrary::clearStr($_POST['description']);

            $errors = array();

            if (!User::checkName($options['name'])) {
                $errors[] = 'Название не может быть пустым.';
            }

            if ($id && empty($errors)) {
                $result = Product::updateProductById($id, $options);
                if (!$result) {
                    $message = 'Произошла ошибка при редактировании!';
                } else {
                    if (!empty($_FILES['image']['tmp_name'])) {
                        $fileName = $_FILES['image']['tmp_name'];
                        if (is_uploaded_file($fileName)) {
                            /*
                             * Следующие две строки для того чтобы
                             * иметь возможность поменять запись no-image
                             * в базе данных (а иначе поменяется только
                             * картинка в папке на сервере)
                             */
                            $imagePath = "/images/home/product{$id}.jpg";
                            $result = Product::putImageToDataBase($id, $imagePath);

                            if ($result) {
                                $destination = ROOT . "/template" . $imagePath;
                                move_uploaded_file($fileName, $destination);
                            }
                        }
                    }
                    FunctionLibrary::redirectTo('/admin/product');
                }
            }
        }

        require_once(ROOT . '/views/admin-product/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        $product = Product::getProductById($id);
        if (!$product) {$product = array();}

        if (isset($_POST['submit'])) {
            $result = Product::deleteProduct($id);
            if (!$result) {
                $message = 'Произошла ошибка при удалении.';
            } else {
                FunctionLibrary::redirectTo("/admin/product");
            }
        }

        require_once(ROOT . '/views/admin-product/delete.php');
        return true;
    }

}