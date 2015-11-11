<doctype html>

    <html>
    <head>
        <title>A simple cookie counter 1</title>
    </head>
    <body>
    Session Counter 1
    <a href="sessionCounter2.php">Session Counter 2</a>
    <a href="sessionCounter3.php">Session Counter 3</a>

    <h1>Cookie Counter 1</h1>

    <?php
    $counter1 = 1;
    if (isset($_COOKIE['counter1'])) {
        $counter1 = (int)$_COOKIE['counter1'];
}
    echo "<p> You have been here $counter1 time(s) recently</p>";
    setcookie('counter1', $counter1 + 1, time() + 10, '/');
    ?>

    </body>
    </html>


