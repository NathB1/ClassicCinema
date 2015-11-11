<doctype html>

    <html>
    <head>
        <title>A simple cookie counter 2</title>
    </head>
    <body>
    <header>
        <a href="sessionCounter1.php">Session Counter 1</a>
        Session Counter 2
        <a href="sessionCounter3.php">Session Counter 3</a>

    </header>
    <h1>Cookie Counter 2</h1>

    <?php
    $counter2 = 1;
    if (isset($_COOKIE['counter2'])) {
        $counter2 = (int)$_COOKIE['counter2'];
    }
    echo "<p> You have been here $counter2 time(s) recently</p>";
    setcookie('counter2', $counter2 + 1, time() + 10, '/');
    ?>

    </body>
    </html>


