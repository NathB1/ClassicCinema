<?php
session_start();
$scriptList = array(
    "_scripts/jquery-1.11.3.js",
    "_scripts/cookies.js",
    "_scripts/cart.js",
    "_scripts/checkout.js",
);
include("_php/header.php");

echo "<div id='main'>";
$orders = simplexml_load_file('orders.xml');
echo "<hr>";
foreach($orders->order as $order) {
    $name = $order->delivery->name;
    $address = $order->delivery->address;
    $email = $order->delivery->email;
    $city = $order->delivery->city;
    $postcode = $order->delivery->postcode;


    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Address: $address</p>";
    echo "<p>City: $city</p>";
    echo "<p>Postcode: $postcode</p>";



    foreach ($order->items->item as $item) {
        $title = $item->title;
        $price = $item->price;
        echo "$title : $price";
    }
    echo "</ul>";
    echo "<hr>";
}
echo "</div>";

?>

<?php include("_php/footer.php"); ?>
