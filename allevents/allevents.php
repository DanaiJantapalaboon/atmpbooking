<?php

    session_start();
    require_once '../config/connection.php';

    if (!isset($_SESSION['user_login'])) {
        header("location: ../index.php");
    } else {

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM booking WHERE id = $delete_id");
        $deletestmt->execute();
    
        if ($deletestmt) {
            //echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted successfully";
            header("refresh:2; url=allevents.php"); // หน่วงเวลา refresh 2 วินาที เพื่อให้แสดงข้อความ session
        }
    }

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

<?php   // เอาไว้ดึง login ไปหน้าอื่นๆ
    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM account WHERE id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }


    include "../component_header.php";
    include "component_navbar_allevents.php";
?>


<div class="container px-3 py-3 table-responsive">
    <table class="table table-hover">
        <thead class="table-danger">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Scheduler</th>
                <th scope="col">Purpose</th>
                <th scope="col">Room</th>
                <th scope="col">Start-Date</th>
                <th scope="col">End-Date</th>
                <th scope="col">Edit by</th>
                <th scope="col">Timestamp</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success">
                    <?php    // สคริปต์ดึงข้อความ success
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <?php   // สคริปต์ดึงข้อมูลจากตาราง booking
                

                $stmt = $conn->query("SELECT * FROM booking");
                $stmt->execute();
                $booking = $stmt->fetchAll();

                if (!$booking) {
                    echo "<p><td colspan='9' class='text-center'>No booking found</td></p>";
                } else {
                    foreach ($booking as $user_booking) {
            ?>

            <tr>
                <th scope="row"><?php echo $user_booking['id']; ?></th>
                <td><?php echo $user_booking['scheduler']; ?></td>
                <td><?php echo $user_booking['purpose']; ?></td>
                <td><?php echo $user_booking['room']; ?></td>
                <td><?php echo $user_booking['start']; ?></td>
                <td><?php echo $user_booking['end']; ?></td>
                <td><?php echo $user_booking['editby']; ?></td>
                <td><?php echo $user_booking['timestamp']; ?></td>

                <td>
                    <!-- Pass Value ไป Modal ต้องใช้ button เท่านั้น -->
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#editBooking<?php echo $user_booking['id']; ?>" class="btn btn-success">Edit</button>
                    <a href="?delete=<?php echo $user_booking['id']; ?>" class="btn btn-danger" onclick="return confirm('Please confirm to delete ?')">Delete</a>
                </td>
            </tr>

            <?php
                    include "../modal_editbooking.php";
                    }
                }
            ?>
            
        </tbody>
    </table>
</div>



    <footer class="py-3 mt-3 text-bg-info text-center">
        &copy; 2022 ATMP Centre, Medical Life Sciences Institute, All rights reserved.
    </footer>
</body>
</html>

<?php } ?>