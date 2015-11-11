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
        <h2>Register</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" id="regForm">
            <fieldset>
                <!-- First section of form is delivery address etc. -->
                <legend>Register:</legend>
                <p>
                    <label for="username">Username:</label>
                    <input id="username" type="text" name="username">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input id="password" type="text" name="password">
                </p>
                <p>
                    <label for="password2">Password:</label>
                    <input id="password" type="text" name="password2">
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input id="email" type="text" name="email">
                </p>
            </fieldset>
            <input type="submit" value="Register">
        </form>

        <?php
        function count_digit($number) {
            return strlen((string) $number);
        }

        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            $con = new mysqli('sapphire', 'nblomfield', 'oR69754', 'nblomfield_dev');
            if ($con->connect_errno) {
                // Something went wrong with the connection.
                echo "<p>Cannot connect to the database. Please try again later.</p>";
            }

            $new_username = $con->real_escape_string($_POST['username']);
            $new_password = $con->real_escape_string($_POST['password']);
            $new_password_digits = count_digit($new_password);
            $new_password2 = $con->real_escape_string($_POST['password2']);
            $new_password2_digits = count_digit($new_password2);
            $new_email = $con->real_escape_string($_POST['email']);

            $query = "SELECT * FROM Users WHERE username = \"$new_username\";";
            $result = $con->query($query);

            if($new_password_digits == 0){
                    echo "<p>Password cannot be empty</p>";
            }else if($new_password_digits && $new_password2_digits < 7){
                echo "<p>Password Must be at least 8 character long</p>";
            }else if($new_password_digits != $new_password2_digits) {
                echo "<p>Passwords given are not the same!</p>";
            }else if ($result->num_rows === 0) {
                $query = "INSERT INTO Users (username, password, email)
                      VALUES (\"$new_username\", SHA(\"$new_password\"), \"$new_email\");";
                $con->query($query);
                if ($con->error) {
                    //Something went wrong.
                    echo "<p>Could not create new user</p>";
                } else {
                    echo "<p>Regristration successful</p>";
                }
            } else if ($result->num_rows > 0) {
                // Username is already taken.
                echo "<p>Username is already taken. Please try again.</p>";
            }

            $result->free();
            $con->close();

            exit;
        }
        ?>

    </div>

<?php include("_php/footer.php"); ?>