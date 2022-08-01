<?php

    session_start();
    require_once '../config/connection.php';

    if (!isset($_SESSION['user_login'])) {
        header("location: ../index.php");
    } else {

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleanroom Booking | ATMP Centre, Medical Life Science Institute</title>

    <!-- Bootstrap & custom headers -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom/headers.css" rel="stylesheet">

    <!-- js Bootstrap -->
    <script src="../js/bootstrap.bundle.min.js"></script>

    <!-- Full Calendar Packs-->
    <link href="../lib/main.min.css" rel="stylesheet">
    <script src="../lib/main.min.js"></script>

    <!-- DateTime Picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <?php include "../script_calendar.php"; ?>

</head>


<body>

<?php // เอาไว้ดึง login ไปหน้าอื่นๆ
    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM account WHERE id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }


    include "../component_header.php";
    include "component_navbar_login.php";
    include "../component_calendar.php";
?>
    
</body>
</html>

<?php } ?>