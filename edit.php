<?php 

include('connection.php');


if(isset($_GET['edit_id'])){
  $id = $_GET['edit_id'];
  $sql= "SELECT * FROM registration where id=".$id;
  $result = mysqli_query($con,$sql);
  $editRow = mysqli_fetch_object($result);


  $hobbyInfo=explode(",", $editRow->hobby);

  // echo "<pre>";
  // print_r($editRow->email);
  // die;

}


$error=array();

$fullname='';
$email='';
$phone='';
$hobby='';
$gender='';
$country='';
$password='';




if(isset($_POST['submit'])){
  
  //$fullname = $_POST['fullname'];
  //$email = $_POST['email']

  extract($_POST);



  if(empty($fullname)){

      $error['fullname'] = 'Please type fullname';

 }

 if(empty($email)){

      $error['email'] = 'Please type email';

 }

 if(empty($phone)){

      $error['phone'] = 'Please type phone';

 }
 if(empty($hobby)){

      $error['hobby'] = 'Please check hobby';

 }

  if(empty($gender)){

      $error['gender'] = 'Please check gender';

 }

  if(empty($country)){

      $error['country'] = 'Please select country';

 }

 


     if(count($error) == 0){


        $hobby = implode(",",$hobby);
        $filed="";
        $filed.="full_name='$fullname'";
        $filed.=",email='$email'";
        $filed.=",phone='$phone'";
        $filed.=",country='$country'";
        if(!empty($password)):
        $filed.=",password='$password'";
        endif;
        $filed.=",gender='$gender'";
        $filed.=",hobby='$hobby'";

        $sql1="UPDATE registration SET ".$filed."WHERE id=".$id;


       
        $result = mysqli_query($con,$sql1);
        
/*

 $sql2="UPDATE MyGuests SET lastname='Doe',email='xyz@gamil.com',password='123456' WHERE id=2";
        $sql2= "INSERT INTO registration (full_name,email,phone,gender,hobby,country,password) VALUES ('$fullname','$email','$phone','$gender','$hobby','$country','$password') ";
       $result = mysqli_query($con,$sql2);

*/
       if($result){

        $error['success'] = "Data Successfully save database.";
header("location:list.php");
die;
        }else{
        $error['warning'] = "Data not save. something is woring!!";
       }



    }











}








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
  <h2>Edit Form <a href="list.php">User List</a></h2>

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

  <form method="POST" action="">
    <div class="form-group">
      <label for="fullname">Full Name:</label>
      <input type="text" class="form-control" id="name" value="<?php if(!empty($editRow->full_name)){ echo $editRow->full_name;}?>" placeholder="Enter Full Name" name="fullname">
      <span style="color:red;"><?php if(!empty($error['fullname'])){ echo $error['fullname'];}?></span>
    </div>
    <div class="form-group">
      <label for="email">E-mail:</label>
      <input type="email" class="form-control" value="<?php if(!empty($editRow->email)){ echo $editRow->email;}?>" id="email" placeholder="Enter E-mail" name="email">
       <span style="color:red;"><?php if(!empty($error['email'])){ echo $error['email'];}?></span>
    </div>

    <div class="form-group">
      <label for="email">Phone:</label>
      <input type="text" class="form-control" value="<?php if(!empty($editRow->phone)){ echo $editRow->phone;}?>" id="phone" placeholder="Enter phone" name="phone">
    </div>


    <div class="form-group">
       <label for="Hobby">Hobby:</label>
        <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" <?php if(!empty($editRow->hobby) && in_array('Traveling', $hobbyInfo)): echo "checked";endif;?> name="hobby[]" class="form-check-input" value="Traveling">Traveling
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox"  <?php if(!empty($editRow->hobby) && in_array('Cooking', $hobbyInfo)): echo "checked";endif;?> name="hobby[]" class="form-check-input" value="Cooking">Cooking
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" name="hobby[]"  <?php if(!empty($editRow->hobby) && in_array('Drawing', $hobbyInfo)): echo "checked";endif;?> class="form-check-input" value="Drawing" >Drawing
      </label>
    </div>



   </div>



    <div class="form-group">
      <label>Gender</label>
        <div class="form-check-inline">
          <label class="form-check-label" for="radio1">
            <input type="radio" <?php if(!empty($editRow->gender) && $editRow->gender == 'Male'){ echo 'checked';}?> class="form-check-input" id="radio1" name="gender" value="Male" checked>Male
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label" for="radio2">
            <input type="radio" <?php if(!empty($editRow->gender) && $editRow->gender == 'Female'){ echo 'checked';}?> class="form-check-input" id="radio2" name="gender" value="Female">Female
          </label>
        </div>
    </div>

    <div class="form-group">
      <label for="sel1">Select Country:</label>
      <select class="form-control" id="sel1" name="country">
        <option <?php if(!empty($editRow->country) && $editRow->country == 'Japan'){ echo 'selected';}?> value="Japan">Japan</option>
        <option <?php if(!empty($editRow->country) && $editRow->country == 'Bangladesh'){ echo 'selected';}?>  value="Bangladesh">Bangladesh</option>
        <option <?php if(!empty($editRow->country) && $editRow->country == 'India'){ echo 'selected';}?>  value="India">India</option>
        <option <?php if(!empty($editRow->country) && $editRow->country == 'Pakistan'){ echo 'selected';}?>  value="Pakistan">Pakistan</option>
      </select>
    </div>


    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
   
    <button type="submit" onclick="validation()" name="submit" class="btn btn-primary">Update</button>
     <!-- <button type="button" onclick="validation()" name="submit" class="btn btn-primary">Submit</button> -->
  </form>
</div>





<script type="text/javascript">
  


  function validation(){

    var fullname=false;
    var phone = false;
    var email = false;
    var hobby = false;
    var gender = false;
    var country = false;
    var password= false;

var fullnameCheck = $("#").val();




    alert("hello");



  }




</script>





</body>
</html>
