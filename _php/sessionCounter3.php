<doctype html>

    <html>
    <head>
        <title>A simple cookie counter 3</title>
    </head>
    <body>
    <header>
        <a href="sessionCounter1.php">Session Counter 1</a>
        <a href="sessionCounter2.php">Session Counter 2</a>
        Session Counter 3

    </header>
    <h1>Cookie Counter 3</h1>

    <?php
    $counter3 = 1;
    if (isset($_COOKIE['counter3'])) {
        $counter3 = (int)$_COOKIE['counter3'];
    }
    echo "<p> You have been here $counter3 time(s) recently</p>";
    setcookie('counter3', $counter3 + 1, time() + 10, '/');
    ?>

    </body>
    </html>


