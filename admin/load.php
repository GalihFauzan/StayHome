
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
            require("penyewa.php");
            break;
        case "3":
            require("kamar.php");
            break;
        case "4":
            require("petugas.php");
            break;
        case "5":
            require("invoice.php");
            break;
        case "6":
            require("pembayaran.php");
            break;
        case "7":
            require("pesan.php");
            break;
        case "8":
            require("pengaturan.php");
            break;
        case "9":
            require("detail_pembayaran.php");
            break;
        case "10":
            require("tarif_sewa.php");
            break;
    }
    ?>