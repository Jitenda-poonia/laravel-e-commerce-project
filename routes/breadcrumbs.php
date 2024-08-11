<?php

use App\Models\Category;
use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('block'));
});


Breadcrumbs::for('category', function (BreadcrumbTrail $trail,  $category) {
    $trail->parent('home');
    $trail->push($category->name, route('categoryData', ['urlkey'=>$category->url_key]));
});

Breadcrumbs::for('cart', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Cart', route('cart'));
});

Breadcrumbs::for('product', function (BreadcrumbTrail $trail,  $product) {
    $trail->parent('home');
    $trail->push($product->name, route('productData',['urlkey'=> $product->url_key]));
});
