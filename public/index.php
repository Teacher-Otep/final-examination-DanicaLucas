<?php include '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD Operations</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">
    <img src="../images/logo.svg" id="logo">

    <button class="navbarbuttons" onclick="showSection('create')">Create</button>
    <button class="navbarbuttons" onclick="showSection('read')">Read</button>
    <button class="navbarbuttons" onclick="showSection('update')">Update</button>
    <button class="navbarbuttons" onclick="showSection('delete')">Delete</button>
</nav>

<section id="home" class="homecontent">
    <h1 class="splash">Welcome to Student Management System</h1>
</section>


<section id="create" class="content">
    <h1 class="contenttitle">Insert New Student</h1>

    <form action="../includes/insert.php" method="POST">
        <input type="text" name="surname" placeholder="Surname" class="field" required><br/>
        <input type="text" name="name" placeholder="Name" class="field" required><br/>
        <input type="text" name="middlename" placeholder="Middle name" class="field"><br/>
        <input type="text" name="address" placeholder="Address" class="field"><br/>
        <input type="text" name="contact" placeholder="Mobile Number" class="field"><br/>

        <div id="btncontainer">
            <button type="button" onclick="clearFields()" class="btns">Clear Fields</button>
            <button type="submit" name="savebtn" class="btns">Save</button>
        </div>
    </form>
</section>


<section id="read" class="content">
<h1>Student Records</h1>

<?php
    $result = $conn->query("SELECT * FROM students");

    if($result && $result->num_rows > 0){

        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        
        echo "<tr>
                <th>ID</th>
                <th>Surname</th>
                <th>Name</th>
                <th>Middle Name</th>
                <th>Address</th>
                <th>Mobile #</th>
              </tr>";

        while($row = $result->fetch_assoc()){

            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['surname']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['middlename']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['contact']}</td>
                  </tr>";
        }

        echo "</table>";

    } else {
        echo "<p>No records found.</p>";
    }
    ?>
</section>


<section id="update" class="content">
    <h1 class="contenttitle">Update Student Record</h1>

    <form method="POST">

        <label class="label">Student ID</label>
        <input type="number" name="id" class="field" required><br/>

        <label class="label">Surname</label>
        <input type="text" name="surname" class="field"><br/>

        <label class="label">Name</label>
        <input type="text" name="name" class="field"><br/>

        <label class="label">Middle Name</label>
        <input type="text" name="middlename" class="field"><br/>

        <label class="label">Address</label>
        <input type="text" name="address" class="field"><br/>

        <label class="label">Mobile Number</label>
        <input type="text" name="contact" class="field"><br/>

        <div id="btncontainer">
            <button type="button" onclick="clearFields()" class="btns">Clear Fields</button>
            <button type="submit" name="updatebtn" class="btns">Update</button>
        </div>

    </form>
</section>


<section id="delete" class="content">
    <h1 class="contenttitle">Delete Student Record</h1>

    <form method="POST">

        <label class="label">Student ID</label>
        <input type="number" name="delete_id" class="field" required><br/>

        <div id="btncontainer">
            <button type="submit" name="deletebtn" class="btns">
                Delete
            </button>
        </div>

    </form>
</section>


<?php
if(isset($_POST['updatebtn'])){
    $id = $_POST['id'];

    $updates = [];

    if(!empty($_POST['surname'])) $updates[] = "surname='" . $_POST['surname'] . "'";
    if(!empty($_POST['name'])) $updates[] = "name='" . $_POST['name'] . "'";
    if(!empty($_POST['middlename'])) $updates[] = "middlename='" . $_POST['middlename'] . "'";
    if(!empty($_POST['address'])) $updates[] = "address='" . $_POST['address'] . "'";
    if(!empty($_POST['contact'])) $updates[] = "contact='" . $_POST['contact'] . "'";

    if(!empty($updates)){
        $sql = "UPDATE students SET " . implode(", ", $updates) . " WHERE id=$id";

        if($conn->query($sql)){
            echo "<script>alert('Update successful');</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('No fields to update');</script>";
    }
}
        if(isset($_POST['deletebtn'])){

    $id = $_POST['delete_id'];

    $sql = "DELETE FROM students WHERE id='$id'";

    if($conn->query($sql) === TRUE){
        echo "<script>
                alert('Student record deleted successfully');
                window.location='index.php';
              </script>";
    } else {
        echo "<script>alert('Delete failed');</script>";
    }
}
?>

<script src="script.js"></script>
</body>
</html>
