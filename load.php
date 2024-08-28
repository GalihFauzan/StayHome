
 <?php

    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    switch ($page) {

        case "1":
            require("layout/booking.php");
            break;
        case "2":
            require("layout/login.php");
            break;
    }
    ?>