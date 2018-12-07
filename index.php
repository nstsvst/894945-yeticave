<?php
$is_auth = rand(0, 1);
$user_name   = 'Настя';
$user_avatar = 'img/user.jpg';
$category    = ['boards' => 'Доски и лыжи',
                'attachment' => 'Крепления',
                'boots' => 'Ботинки',
                'clothing' => 'Одежда',
                'tools' => 'Инструменты',
                'other' => 'Разное'
               ];
$items       = [
           [
              'name' => '2014 Rossignol District Snowboard',
              'category' => $category['boards'],
              'price' => 10999,
              'url' => 'img/lot-1.jpg'
           ],
           [
               'name' => 'DC Ply Mens 2016/2017 Snowboard',
               'category' => $category['boards'],
               'price' => 159999,
               'url' => 'img/lot-2.jpg'
           ],
           [
               'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
               'category' => $category['attachment'],
               'price' => 8000,
               'url' => 'img/lot-3.jpg'
           ],
           [
                'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
                'category' => $category['boots'],
                'price' => 10999,
                'url' => 'img/lot-4.jpg'
           ],
           [
                'name' => 'Куртка для сноуборда DC Mutiny Charocal',
                'category' => $category['clothing'],
                'price' => 7500,
                'url' => 'img/lot-5.jpg'
           ],
           [
                'name' => 'Маска Oakley Canopy',
                'category' => $category['other'],
                'price' => 5400,
                'url' => 'img/lot-6.jpg'
           ]
           ];
function printprice($value)
{
 $integer = ceil($value);
 $formatting = number_format($integer, 0, ' ', ' ');
return $formatting. ' '. '₽' ;
}
require_once('functions.php');
$page_content = include_template ('index.php',[
    'category' => $category,
    'items' => $items,
    'category_name' => $category
]);
$layout_content = include_template ('layout.php',[
    'content' => $page_content,
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'category' => $category,
    'user_name' => $user_name
]);
function esc($str) {
	$text = htmlspecialchars($str);
	return $text;
}
print($layout_content);
