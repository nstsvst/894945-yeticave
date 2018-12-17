<?php
$con = mysqli_connect("localhost", "root", "123doom789", "yeticave");
if ($con == false) {
  print("Ошибка подключения:") . mysqli_connect_error();
}
mysqli_set_charset($con, "utf-8");
date_default_timezone_set("Europe/Moscow");
$is_auth = rand(0, 1);
$user_name   = 'Настя';
$user_avatar = 'img/user.jpg';
