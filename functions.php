<?php
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}
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

function esc($str) {
	$text = htmlspecialchars($str);
	return $text;
}

function db_get_prepare_stmt($con, $sql, $lot = []) {
    $stmt = mysqli_prepare($con, $sql);

    if ($lot) {
        $types = '';
        $stmt_data = [];

        foreach ($lot as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}
