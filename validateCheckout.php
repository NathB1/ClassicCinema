<?php
session_start();
$scriptList = array(
    "_scripts/jquery-1.10.2.min.js",
    "_scripts/cookies.js",
    "_scripts/login.js",
);
include("_php/header.php");
include("_php/validationFunctions.php");
?>

    <div id="main">
        <?php
        $passCounter = 0;

        // Get the values in each field
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $postcode = $_POST['postcode'];

        $cardType = $_POST['cardType'];
        $cardNumber = $_POST['cardNumber'];
        $cardMonth = $_POST['cardMonth'];
        $cardYear = $_POST['cardYear'];
        $cvc = $_POST['cvc'];

        //session stuff
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['address2'] = $address2;
        $_SESSION['city'] = $city;
        $_SESSION['postcode'] = $postcode;

        $_SESSION['cardType'] = $cardType;
        $_SESSION['cardNumber'] = $cardNumber;
        $_SESSION['cardMonth'] = $cardMonth;
        $_SESSION['cardYear'] = $cardYear;
        $_SESSION['cvc'] = $cvc;


        // Validation stuff
        function isLetters($str)
        {
            $pattern = '/[A-Za-z]+$/';
            return preg_match($pattern, $str);
        }

        // Check the delivery name
        if (isEmpty($name)) {
            echo "<p>Name cannot be empty</p>";
        } else if (!isLetters($name)) {
            echo "<p>Name must be letters only</p>";
        } else {
            $passCounter++;
        }
        // Check the email address
        if (isEmpty($email)) {
            echo "<p>Email cannot be empty</p>";
        } else if (!isEmail($email)) {
            echo "<p>Email is not valid</p>";
        } else {
            $passCounter++;
        }
        // Check the street address
        if (isEmpty($address)) {
            echo "<p>Address cannot be empty</p>";
        } else if (!isLetters($address)) {
            echo "<p>Address must be letters only</p>";
        } else {
            $passCounter++;
        }
        // Check the city
        if (isEmpty($city)) {
            echo "<p>City cannot be empty</p>";
        } else if (!isLetters($city)) {
            echo "<p>City must be letters only</p>";
        } else {
            $passCounter++;
        }
        // Check the postcode
        if (isEmpty($postcode)) {
            echo "<p>Postcode cannot be empty</p>";
        } else if (!isDigits($postcode)) {
            echo "<p>Postcode must be numbers only</p>";
        } else {
            $passCounter++;
        }
        // Check the credit card
        $cardErrorArray = checkCardDetails($cardType, $cardNumber, $cardMonth, $cardYear, $cvc);
        if ($cardErrorArray != null) {
            echo "<p><strong>Credit Card Errors: </strong></p>";
            foreach ($cardErrorArray as $error) {
                echo "<p>$error</p>";
            }
        } else {
            $passCounter++;
        }
        // Cart
        $cart = json_decode($_COOKIE['MovieCart']);
        if ($passCounter == 6) {
        $_SESSION = array();
        session_destroy();
        ?>
        <p>Your details have been successfully validated. You can review your order below.</p>
        <table>
            <tr>
                <th>Title</th>
                <th>Price</th>
            </tr>
            <?php
            foreach ($cart as $item) {
                $title = $item->title;
                $price = $item->price;
                echo "<tr><td>$title</td><td>$price</td></tr>";
            }
            echo "</table>";

            // $sourceFile and $targetFile are assumed to be set
            $orders = simplexml_load_file('orders.xml');
            $newOrder = $orders->addChild('order');
            $delivery = $newOrder->addChild("delivery");
            $delivery->addChild("name", $name);
            $delivery->addChild("email", $email);
            $delivery->addChild("address", $address);
            $delivery->addChild("city", $city);
            $delivery->addChild("postcode", $postcode);
            $items = $newOrder->addChild("items");
            foreach ($cart as $cartItem) {
                $title = (string) $cartItem->title;
                $price = (string) $cartItem->price;
                $item = $items->addChild("item");
                $item->addChild("title", $title);
                $item->addChild("price", $price);
            }
            // save targetfile
            $orders->saveXML("orders.xml");

            //Clear cookies and session
            setcookie('MovieCart', '', time()-3600, '/');
            unset($_COOKIE['MovieCart']);
            } else {
                echo "<p><a href=\"checkout.php\">Return to Checkout</a></p>";
            }
            ?>
    </div>

<?php include("_php/footer.php"); ?>