<?php
  include_once "connection.php";
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>CRUD Application</title>
</head>

<body>
<div class=container >
<h1 align="center"><b>CRUD Application</b></h1>
  <div class ="row justify-content-center">
    <div class="col-md-10"><br><br><br></div>
  </div>
  <div class="row">
  <div class="col-md-4">

  <h3 class="text-center text-dark">Add Record</h3>
<form method = "GET" enctype="multipart/form-data">

  
  <div class="form-group">
    <input type="text" name="id" class="form-control" placeholder="Enter Roll Number" value="<?php echo $_GET['id']; ?>">
  </div>

  <div class="form-group">
    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $_GET['nm']; ?>">
  </div>

  <div class="form-group">
    <input type="email" name="email" class="form-control"  placeholder="Enter E-mail address" value="<?php echo $_GET['em']; ?>">
  </div>

  <div class="form-group">
    <input type="tel" name="phone" class="form-control" placeholder="Enter phone number" value="<?php echo $_GET['ph']; ?>">
  </div>

  <div class="form-group">
    <input type="file" name="image" class="custom-file">
  </div>

  <div class= "form-group">
    <input type="submit" name = "b1" class="btn btn-primary btn-block" value = "Add Record" value="<?php echo $_GET['img'];?>">
  </div>
</form>
</div>


<!---------------Read Structure------------------------------------------------------
----------------------------------------------------------------------------------->
<div class ="col-md-8">
 <?php
  $query = "SELECT * FROM students";   
  $data = mysqli_query($conn,$query);   

 ?> 

  <h3 class="text-center text-dark"> Record present in data</h3>
  <table class="table table-bordered table-hover">
    <thread>
     <tr>   
      <th>#</th>   
      <th>Image</th>   
      <th>Name</th>   
      <th>E-Mail</th>
      <th>Phone</th>   
      <th>Operations</th>
     </tr>
    </thread>

    <tbody>
    <?php   
     while($result = mysqli_fetch_array($data))  {
    ?>
     
      <tr> 
        <td><?= $result['id']; ?></td>
        <td><img src="<?= $result['profile']; ?>" width='20'></td>
        <td><?= $result['name']; ?></td>
        <td><?= $result['email']; ?></td>
        <td><?= $result['phone']; ?></td>
       <td>
       <a href="details.php?details=<?=$result['id'];?>" class ="badge badge-primary">Details</a> |
       <a href="delete.php?delete=<?= $result['id']; ?>" class ="badge badge-danger"  onclick = 'return DeleteRecord()'>Delete</a> |
       <a href="edit.php?edit=<?=$result['id'];?>" class ="badge badge-success">Edit</a>
      </tr>  
     <?php } ?>
    </tbody>
 </table>

 <script>   
   function DeleteRecord()   
   {   
    return confirm("Do u want to delete");   
   }   
  </script>   


</div>
<!------------------------------------------------------------------------------------
----------------------------------------------------------------------------------->

</div>
</div>
</body>
</html>

<?php
    
    if(isset($_GET['b1']))
    {
      $roll= $_GET['id'];
      $name = $_GET['name'];
      $email = $_GET['email'];
      $phone =$_GET['phone'];
      $profile = $_FILES['image'];
      $filename = $_FILES['image']['name'];
      $filetmp = $_FILES['image']['tmp_name'];
      $upload = "upload/".$filename;
      move_uploaded_file($filetmp,$upload);

        if($roll!="" and $email!= "" and $name !="" and $phone!="" and $upload!="")
        {
            $query = "UPDATE students SET id ='$roll',name='$name', email='$email', phone='$phone' where id='$roll'";
            $data = mysqli_query($conn,$query);

            if($data)
            {
              ?>   
              <meta http-equiv="refresh" content="0; url=http://localhost/PHP/CRUD/Form.php">   
              <?php 
            }
            else
            {
                echo "Record not Updated "; 
            }
        }
        else
        {
            echo "All Fields are required"; 
        }

    }
    

?>