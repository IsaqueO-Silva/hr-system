<?php

function sanitize(array $data) : array {

    foreach($data as $key => $value) {

        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);

        $data[$key] = $value;
    }

    return $data;
}
?>