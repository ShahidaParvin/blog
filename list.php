<?php 

include('connection.php');



        

        


         $sql1="SELECT * FROM registration";
         $result = mysqli_query($con,$sql1);


        $totalRow=mysqli_num_rows($result);
        




    







?>









<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
 
</head>
<body>

<div class="container">
  <h2>Registration List <a href="index.php">Registration Form</a></h2>

  <?php if(!empty($error['success'])): ?>
    <div class="alert alert-success">
    <strong>Success!<?php echo $error['success'];?></strong> .
  </div>
  <?php endif;  ?>

  <?php if(!empty($error['warning'])): ?>
    <div class="alert alert-warning">
    <strong>Warning!<?php echo $error['warning'];?></strong> .
  </div>
  <?php endif;  ?>

  <div class="row">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th>Gender</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if($totalRow > 0): ?>

<?php 

$sl=1;
 while ($row=mysqli_fetch_array($result)) {?>

          <tr>
            <td><?php echo $sl++;?></td>
            <td><?php echo $row['full_name'];?></td>
            <td><?php echo $row['phone'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['gender'];?></td>
            <td>
            <a class="btn btn-success" href="edit.php?edit_id=<?php echo $row['id'];?>">Edit</a>
            <a class="btn btn-info"  href="delete.php?delete_id=<?php echo $row['id'];?>">  Delete</a>
           <a class="btn btn-primary"  href="view.php?view_id=<?php echo $row['id'];?>">  View</a></td>
          </tr>

<?php } ?>

          <?php else:?>
            <tr>
              <td colspan="6"><center>No Registration found</center></td>
            </tr>
          <?php endif;?>
        </tbody>
      </table>

  </div>


</div>

</body>
</html>
