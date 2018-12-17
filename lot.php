<?php
require_once('init.php');
require_once('functions.php');
$sql = 'SELECT id, name FROM lot';
$result = mysqli_query($con, $sql);

if ($result) {
    $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
  //  print($content, mysqli_error($con));
}

$id = intval($_GET['id']);
// запрос на показ гифки по ID
$sql = 'SELECT lot.id, name, init_price, image, category.title as category_name FROM lot
LEFT  JOIN category
ON  category_id=category.id
WHERE lot.id = ' . $id;

if ($result = mysqli_query($con, $sql)) {

    if (!mysqli_num_rows($result)) {
        http_response_code(404);
        $content = include_template('error.php', ['error' => 'Гифка с этим идентификатором не найдена']);
    } else {
        $category_from_sql = 'SELECT alias, title FROM category';
        $category_result = mysqli_query($con, $category_from_sql);
        $category = mysqli_fetch_all($category_result , MYSQLI_ASSOC);
        $lot = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $content = include_template('lot.php', [
          'lot' => $lot
        ]);
        $layout_content = include_template('layout.php', [
            'content' => $content,
            'title' => 'Лот',
            'is_auth' => $is_auth,
            'category' => $category,
            'user_name' => $user_name
        ]);

        print($layout_content);
    }
}
