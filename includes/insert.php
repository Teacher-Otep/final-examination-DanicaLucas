<?php
include 'db.php';

if(isset($_POST['savebtn'])){
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $sql = "INSERT INTO students (surname, name, middlename, address, contact)
            VALUES ('$surname', '$name', '$middlename', '$address', '$contact')";

    if($conn->query($sql)){
        header("Location: ../public/index.php?status=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
