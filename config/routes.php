<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    'catalog' => 'catalog/index', // actionIndex in CatalogController
    '' => 'site/index', // actionIndex in SiteController
);