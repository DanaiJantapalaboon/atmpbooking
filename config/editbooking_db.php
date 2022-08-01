<?php

    session_start();
    require_once 'connection.php';

    if (isset($_POST['editbooking'])) {
        $id = $_POST['id'];
        $scheduler = $_POST['scheduler'];
        $purpose = $_POST['purpose'];
        $room = $_POST['room'];
        $startdate = $_POST['startdate'];
        $finisheddate = $_POST['finisheddate'];
        $editby = $_POST['editby'];

        try {

            $sql = $conn->prepare("UPDATE booking SET name = :name, surname = :surname, email = :email, position = :position, organisation = :organisation, password = :password WHERE id = :id");

            $sql->bindParam(":id", $id);
            $sql->bindParam(":name", $name);
            $sql->bindParam(":surname", $surname);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":position", $position);
            $sql->bindParam(":organisation", $organisation);
            $sql->bindParam(":password", $passwordHash);
            $sql->execute();

                echo "<script>alert('Update Account Successfully!'); window.location.href='../login/main.php';</script>";

            } catch(PDOException $e) {
                echo $e->getMessage();

            }
        }


?>