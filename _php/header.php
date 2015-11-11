<?php
// Start the session
if (session_id() === "") {
    session_start();
}
$_SESSION['lastPage'] = $_SERVER['PHP_SELF'];
?>

<!DOCTYPE html>

<html>
<head>
    <title>Classic Cinema</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="_style/style.css">
    <?php
    if (isset($scriptList) && is_array($scriptList)) {
        foreach ($scriptList as $script) {
            echo "<script src='$script'></script>";
        }
    }
    ?>
</head>

<body>

<header>
    <h1>Classic Cinema</h1>
    <?php
    echo $_SESSION['authenticatedUser'];
    ?>

    <?php if (isset($_SESSION['authenticatedUser'])) { ?>
        <div id="logout">
            <p>Welcome</p>
            <form id="logoutForm" method="post" action="logout.php">
                <input type="submit" id="logoutSubmit" value="Logout" name="logoutSubmit">
            </form>
        </div>
    <?php } else { ?>
        <div id="login">
            <form id="loginForm" method="post" action="login.php">
                <fieldset>
                    <legend>Login</legend>
                    <label for="loginUser">Username: </label>
                    <input type="text" name="loginUser" id="loginUser"><br>
                    <label for="loginPassword">Password: </label>
                    <input type="password" name="loginPassword" id="loginPassword"><br>
                    <input type="submit" id="loginSubmit" value="Login" name="loginSubmit">
                </fieldset>
            </form>
        </div>
    <?php } ?>
</header>

<nav>
    <ul>
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']);
        if (isset($_SESSION['authenticatedUser'])) {
            $linkList = array(
                "index.php" => "Home",
                "classic.php" => "Classic",
                "scifi.php" => "Sci-Fi",
                "hitchcock.php" => "Hitchcock",
                "checkout.php" => "Checkout",
                "orders.php" => "Orders",
            );
        } else {
            $linkList = array(
                "index.php" => "Home",
                "classic.php" => "Classic",
                "scifi.php" => "Sci-Fi",
                "hitchcock.php" => "Hitchcock",
                "register.php" => "Register"
            );
        }
        $access = false;
        if (isset($scriptList) && is_array($scriptList)) {
            foreach ($linkList as $link => $title) {
                if ($currentPage != ($link)) {
                    echo "<li> <a href='$link'>$title</a>";
                } else {
                    echo "<li> $title";
                }
                if ($link === $currentPage) {
                    $access = true;
                }
            }
        }
        if ($access == false) {
            header("Location: index.php");
            exit;
        }
        ?>
    </ul>
</nav>
