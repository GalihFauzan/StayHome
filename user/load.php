
 <?php

    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    switch ($page) {

        case "1":
            require("dashboard.php");
            break;
        case "2":
            require("pembayaran.php");
            break;
        case "3":
            require("riwayat_pembayaran.php");
            break;
        case "4":
            require("pesan.php");
            break;
        case "5":
            require("bantuan.php");
            break;
        case "6":
            require("checkout-process.php");
            break;
    }
    ?>