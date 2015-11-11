<?php
session_start();
$scriptList = array(
    "_scripts/jquery-1.11.3.js",
    "_scripts/cookies.js",
    "_scripts/cart.js",
    "_scripts/checkout.js",
);
include("_php/header.php");
?>

    <div id="main">
        <h2>Cart</h2>

        <section class="film">
            <div id="message"></div>

            <div id="header"></div>

            <table id="cartList"></table>

            <div id="cartTotal"></div>

            <div id="errors"></div>
        </section>
        <form method="post" action="validateCheckout.php" id="checkoutForm" novalidate>
            <fieldset>
                <!-- First section of form is delivery address etc. -->
                <legend>Delivery Details:</legend>
                <p>
                    <label for="name">Deliver to:</label>
                    <input type="text" name="name" id="name"<?php
                    // Check to see if they have already tried to validate. If so refil the form with their info.
                    if (isset($_SESSION['name'])) {
                        $name = $_SESSION['name'];
                        echo "value='$name'";
                    } ?> >
                </p>
                <p>
                    <label for="email">email:</label>
                    <input type="text" name="email" id="email"<?php
                    if (isset($_SESSION['email'])) {
                        $email = $_SESSION['email'];
                        echo "value='$email'";
                    } ?> >
                </p>
                <p>
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address"<?php
                    if (isset($_SESSION['address'])) {
                        $address = $_SESSION['address'];
                        echo "value='$address'";
                    } ?> >
                </p>
                <p>
                    <label for="address2"></label>
                    <input type="text" name="address2" id="address2"<?php
                    if (isset($_SESSION['address2'])) {
                        $address2 = $_SESSION['address2'];
                        echo "value='$address2'";
                    } ?> >
                </p>
                <p>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city"<?php
                    if (isset($_SESSION['city'])) {
                        $city = $_SESSION['city'];
                        echo "value='$city'";
                    } ?> >
                </p>
                <p>
                    <label for="postcode">Postcode:</label>
                    <input type="text" name="postcode" id="postcode" maxlength="4" required class="short"<?php
                    if (isset($_SESSION['postcode'])) {
                        $postcode = $_SESSION['postcode'];
                        echo "value='$postcode'";
                    } ?> >
                </p>
            </fieldset>

            <!-- Next section has credit card details -->
            <fieldset>
                <legend>Payment Details:</legend>
                <p>
                    <label for="cardType">Card type:</label>
                    <select id="cardType" name="cardType">
                        <?php
                        $values = array("American Express", "Mastercard", "Visa");
                        $cardType;
                        if (isset($_SESSION['cardType'])) {
                            $cardType = $_SESSION['cardType'];
                        }
                        foreach ($values as $cType) {
                            if ($cType == $cardType) {
                                echo "<option selected=\"selected\" value=\"$cType\">$cType</option>";
                            }else {
                                echo "<option value=\"$cType\">$cType</option>";
                            }
                        }
                        ?>
                    </select><br>
                </p>
                <p>
                    <label for="cardNumber">Card number:</label>
                    <input id="cardNumber" type="text" name="cardNumber" <?php
                    // Check to see if they have already tried to validate. If so refil the form with their info.
                    if (isset($_SESSION['cardNumber'])) {
                        $cardNumber = $_SESSION['cardNumber'];
                        echo "value='$cardNumber'";
                    }
                    ?> ><br>
                </p>
                <p>
                    <label for="cardMonth">Expiry date - Month:</label>
                    <select id="cardMonth" name="cardMonth" >
                        <?php
                        $count = 1;
                        $cardMonth;
                        if (isset($_SESSION['cardMonth'])) {
                            $cardMonth = $_SESSION['cardMonth'];
                        }
                        while ($count <= 12) {
                            if ($count == $cardMonth) {
                                echo "<option selected=\"selected\" value=\"$count\">$count</option>";
                            }else {
                                echo "<option value=\"$count\">$count</option>";
                            }
                            $count ++;
                        }
                        ?>
                    </select>
                    <label class="short" for="cardYear">Year:</label>
                    <select id="cardYear" name="cardYear">
                        <?php
                        $count = 2015;
                        $cardYear;
                        if (isset($_SESSION['cardYear'])) {
                            $cardYear = $_SESSION['cardYear'];
                        }
                        while ($count <= 2020) {
                            if ($count == $cardYear) {
                                echo "<option selected=\"selected\" value=\"$count\">$count</option>";
                            }else {
                                echo "<option value=\"$count\">$count</option>";
                            }
                            $count ++;
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="cvc">Verification code:</label>
                    <input id="cvc" type="text" name="cvc" class="short" <?php
                    // Check to see if they have already tried to validate. If so refil the form with their info.
                    if (isset($_SESSION['cvc'])) {
                        $cvc = $_SESSION['cvc'];
                        echo "value='$cvc'";
                    }
                    ?>>
                </p>
            </fieldset>
            <input type="submit" value="Checkout">
        </form>

    </div>

<?php include("_php/footer.php"); ?>