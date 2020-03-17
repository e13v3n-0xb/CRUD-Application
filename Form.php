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
<br>
<h1 align="center"><b>CRUD Application</b></h1>
  <div class ="row justify-content-center">
    <div class="col-md-10"><br><br></div>
  </div>
  <div class="row">
  <div class="col-md-4">

  <h3 class="text-center text-dark">Add Record</h3>
<form method = "POST" enctype="multipart/form-data">

  
  <div class="form-group">
    <input type="text" name="id" class="form-control" placeholder="Enter Roll Number">
  </div>

  <div class="form-group">
    <input type="text" name="name" class="form-control" placeholder="Enter Name">
  </div>

  <div class="form-group">
    <input type="email" name="email" class="form-control"  placeholder="Enter E-mail address">
  </div>

  <div class="form-group">
    <input type="tel" name="phone" class="form-control" placeholder="Enter phone number">
  </div>

  <div class="form-group">
    <input type="file" name="image" class="custom-file">
  </div>

  <div class= "form-group">
    <input type="submit" name = "b1" class="btn btn-primary btn-block" value = "Add Record">
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
       <a href="update.php?id=<?=$result['id'];?>&nm=<?=$result['name'];?>&em=<?=$result['email'];?>&ph=<?=$result['phone'];?>&img=<?=$result['profile'];?>" class ="badge badge-success">Edit</a>
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
    include_once 'connection.php';
    if(isset($_POST['b1']))
    {
        $roll= $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone =$_POST['phone'];
        $profile = $_FILES['image'];
        $filename = $_FILES['image']['name'];
        $filetmp = $_FILES['image']['tmp_name'];
        $upload = "upload/".$filename;
        move_uploaded_file($filetmp,$upload);

        if($roll!="" and $email!= "" and $name !="" and $phone!="" and $upload!="")
        {
            
            $query = "insert into students values('$roll','$upload','$name','$phone','$email')";
            $data = mysqli_query($conn,$query);

            if($data)
            {

              ?>   
              <meta http-equiv="refresh" content="0; url=http://localhost/PHP/CRUD/Form.php">   
              <?php 

            }
            else
            {
                echo "oopsies";
            }
        }
        
      }
?>