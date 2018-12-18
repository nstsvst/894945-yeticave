<?php
require_once('init.php');
require_once('functions.php');
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lot = $_POST;
    $requied = ['name', 'category', 'message'] ;
    foreach ($requied as $field) {
        if (empty($lot[$field]) ) {
            $errors[$field] = 'поле не должно быть пустым';
        }
    }
    if (empty($errors)) {
       $filename = uniqid() . '.jpg';
       $lot['image'] = $filename;
       move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . $filename);

       $sql = 'INSERT INTO lot (creatiom_date, name, category_id, description, image, init_price, step, user_id_autor) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)';

       $stmt = db_get_prepare_stmt($con, $sql, [$lot['name'], $lot['category_id'], $lot['description'], $lot['image'], $lot['init_price'], $lot['step'], $user_id]);
       $res = mysqli_stmt_execute($stmt);
       if ($res) {
           $id = mysqli_insert_id($con);

           header("Location: lot.php?id=" . $id);
       } else {
           $content = include_template('error.php', ['error' => mysqli_error($con)]);
       }
    }
}
$content = include_template('add.php', [
    'errors' => $errors,
    'category' => $category
]);
$layout_content = include_template('layout.php', [
    'content' => $content,
    'title' => 'Добавление лота',
    'is_auth' => $is_auth,
    'category' => $category,
    'user_name' => $user_name
]);

print($layout_content);
