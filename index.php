<?php
require_once('init.php');
require_once('functions.php');



$items_from_sql = 'SELECT lot.id, name, init_price, image, category.title as category_name
  FROM lot
  LEFT  JOIN category
  ON  category_id=category.id
  ORDER BY creatiom_date DESC';

$items_result = mysqli_query($con, $items_from_sql);

$items = mysqli_fetch_all($items_result , MYSQLI_ASSOC);

$page_content = include_template('index.php', [
    'category' => $category,
    'items' => $items,
]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'category' => $category,
    'user_name' => $user_name
]);

print($layout_content);
