<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../");
}
?>
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>
<?php include "load.php"; ?>

<?php include "templates/footer.php"; ?>