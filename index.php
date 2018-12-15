<?php
$is_auth = rand(0, 1);
$user_name   = 'Настя';
$user_avatar = 'img/user.jpg';
/*
$items       = [
           [
              'name' => '2014 Rossignol District Snowboard',
              'category' => $category['alias'],
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
*/
           date_default_timezone_set("Europe/Moscow");
function date_for_lot(){
  $ts_midnight = strtotime('tomorrow');
  $secs_to_midnight = $ts_midnight - time();
  $hours = floor($secs_to_midnight / 3600);
  $minutes = floor(($secs_to_midnight % 3600) / 60);
  print "$hours:$minutes";
}
function printprice($value){
 $integer = ceil($value);
 $formatting = number_format($integer, 0, ' ', ' ');
return $formatting. ' '. '₽' ;
}
require_once('functions.php');

$con = mysqli_connect("localhost", "root", "123doom789", "yeticave");
if ($con == false) {
  print("Ошибка подключения:") . mysqli_connect_error();
}
mysqli_set_charset($con, "utf-8");
$category_from_sql= 'SELECT alias, title FROM category';
$category_result= mysqli_query($con, $category_from_sql);
$category = mysqli_fetch_all($category_result , MYSQLI_ASSOC);

$items_from_sql='SELECT name, init_price, image, category.title as category_name
FROM lot
LEFT  JOIN category
ON  category_id=category.id
ORDER BY creatiom_date DESC';

$items_result=mysqli_query($con, $items_from_sql);

$items = mysqli_fetch_all($items_result , MYSQLI_ASSOC);

$page_content = include_template ('index.php',[
    'category' => $category,
    'items' => $items,
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


?>
