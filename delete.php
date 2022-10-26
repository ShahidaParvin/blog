<?php

include('connection.php');

  if(isset($_GET['delete_id'])){

     $id = $_GET['delete_id'];
    $sql="delete from registration where id='$id'";
   $result =  mysqli_query($con,$sql);
   if($result){
   	header('location:list.php');
   }else{
   	die("Data not deleted.");
   }
   



  }
 

?>