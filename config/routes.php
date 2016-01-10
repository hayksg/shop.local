<?php

return array(
    /* Блок показа категорий и товаров */
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    'catalog/page-([0-9]+)' => 'catalog/index/$1', // actionIndex in CatalogController
    'catalog' => 'catalog/index', // actionIndex in CatalogController
    /* Блок регистрации и авторизации */
    'user/register' => 'user/register', // actionRegister in UserController
    'user/login' => 'user/login', // actionLogin in UserController
    'user/logout' => 'user/logout', // actionLogout in UserController
    /* Кабинет пользователя */
    'cabinet/edit' => 'cabinet/edit', // actionEdit in CabinetController
    'cabinet/history/([0-9]+)' => 'cabinet/history/$1', // actionHistory in CabinetController
    'cabinet' => 'cabinet/index', // actionIndex in CabinetController
    /* Блок покупок */
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd in CartController
    'cart/addProduct/([0-9]+)' => 'cart/addProduct/$1', // actionAddProduct in CartController
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete in CartController
    'cart/order' => 'cart/order', // actionOrder in CartController
    'cart' => 'cart/index', // actionIndex in CartController
    /* Управление админами */
    'admin/user/create' => 'adminUser/create', // actionCreate in AdminUserController
    'admin/user/delete/([0-9]+)' => 'adminUser/delete/$1', // actionDelete in AdminUserController
    'admin/user' => 'adminUser/index', // actionIndex in AdminUserController
    /* Управление заказами */
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1', // actionView in AdminOrderController
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1', // actionUpdate in AdminOrderController
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1', // actionDelete in AdminOrderController
    'admin/order' => 'adminOrder/index', // actionIndex in AdminOrderController
    /* Управление блогом */
    'admin/blog/create' => 'adminBlog/create', // actionCreate in AdminBlogController
    'admin/blog/update/([0-9]+)' => 'adminBlog/update/$1', // actionUpdate in AdminBlogController
    'admin/blog/delete/([0-9]+)' => 'adminBlog/delete/$1', // actionDelete in AdminBlogController
    'admin/blog' => 'adminBlog/index', // actionIndex in AdminBlogController
    /* Управление товарами */
    'admin/product/create' => 'adminProduct/create', // actionCreate in AdminProductController
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1', // actionUpdate in AdminProductController
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1', // actionDelete in AdminProductController
    'admin/product/page-([0-9]+)' => 'adminProduct/index/$1', // actionIndex in AdminProductController
    'admin/product' => 'adminProduct/index', // actionIndex in AdminProductController
    /* Управление категориями */
    'admin/category/create' => 'adminCategory/create', // actionCreate in AdminCategoryController
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1', // actionUpdate in AdminCategoryController
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1', // actionDelete in AdminCategoryController
    'admin/category' => 'adminCategory/index', // actionIndex in AdminCategoryController
    /* Администраторская часть */
    'admin' => 'admin/index', // actionIndex in AdminController
    /* Blog */
    'blog/view/([0-9]+)' => 'blog/view/$1', // actionView in BlogController
    'blog' => 'blog/index', // actionIndex in BlogController
    /* Главная страница */
    'contacts' => 'site/contact', // actionContact in SiteController
    'about' => 'site/about', // actionAbout in SiteController
    '' => 'site/index', // actionIndex in SiteController
);