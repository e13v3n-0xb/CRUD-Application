<?php
    include_once 'connection.php';
    $roll = $_GET['delete'];
    $query = "delete from students where id='$roll'";
    $data = mysqli_query($conn,$query);
    if($data)
    {
        echo "<script>alert('Record Deleted')</script>";
        ?>
        <meta http-equiv="refresh" content="0; url =http://127.0.0.1:80/PHP/CRUD/Form.php">
        <?php
    }
    else
    {
        echo "Delete Procss fail";
    }
?>