<?php
if (!isset($_GET["name"])) {
    header("Location: ../helloForm.html");
    exit;
}

$pattern = '/[A-Za-z0-9]+$/';
$name = $_GET['name'];


if (preg_match($pattern, $name)) {
    echo "Hello $name";
} else {
    echo "That was wrong";
}

?>