<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container">
   <form action="#" method="POST" enctype="multipart/form-data">
     <div class="title">
         Register FORM 
     </div>
 
     <div class="form">
     
     <div class="Input_field" style="">
          <label>Upload Image</label>
          <input type ="file" name="uploadfile" style="width: 100%"><br>
       </div>



       <div class="Input_field">
          <label>First Name</label>
          <input type="text" name="FName" class="input" required>
       </div>

       <div class="Input_field">
        <label>Last Name</label>
        <input type="text" name="LName" class="input" required>
       </div>
     
     <div class="Input_field">
        <label>Password</label>
        <input type="password" name="Password" class="input" required> 
     </div> 
    
     <div class="Input_field">
        <label>Email Address</label>
        <input type="email" name="Email" class="input" required> 
     </div> 
     
     <div class="Input_field">
        <label>Phone Number</label>
        <input type="tel" name="phone" class="input" required> 
     </div> 
     
     <div class="Input_field">
        <label>Choose Your State</label>
        <div class="coustome_select">
         <select name="State"> 
            <option value="Not Selected">Select</option>  
            <option value="Jaipur">Jaipur</option>
            <option value="Dohlpur">Dohlpur</option>
            <option value="Dungharpur">Dungharpur</option>
            <option value="Badmer">Badmer</option>
         </select>
        </div> 
     </div> 
     <br>  
     
     <div class="Input_field">
        <label>Subject</label>
         Math<input type="checkbox" name="Subject[]" value="Math">
         Physics<input type="checkbox" name="Subject[]" value="Physics">  
         Chemistry<input type="checkbox" name="Subject[]" value="Chemistry"> 
         Bio<input type="checkbox" name="Subject[]" value="Bio"> 
     </div> 
     
     <br> 
     <div class="Input_field">
        <label>Gender</label>
        Male<input type="radio" name="gender" value="Male">
        Female<input type="radio" name="gender" value="Female">
     </div>
     <br> 
     <div class="Input_field terms">
        <label class="check">
            <input type="checkbox" name="terms" value="Agree">
            <span class="checkmark"></span>
        </label>
        <p>Agree to terms and conditions</p>
     </div>
     
     <div class="Input_field">
        <input type="submit" value="Register" class="btn" name="submit"> 
        <input type="reset" value="Clear" class="btn"> 
     </div> 

     </div>
   </form>
</div> 

</body>
</html>

<?php
if(isset($_POST['submit']))
{


   $filename =  $_FILES["uploadfile"]["name"];
   $tempname = $_FILES["uploadfile"]["tmp_name"];
   $folder = "images/".$filename; 
   move_uploaded_file($tempname,$folder);


    $firstName = $_POST['FName'];
    $lastName = $_POST['LName'];
    $password = $_POST['Password']; 
    $email = $_POST['Email'];
    $phone = $_POST['phone'];
    $state = $_POST['State'];

    $subject = isset($_POST['Subject']) ? implode(',', $_POST['Subject']) : '';
    $gender = $_POST['gender'];
    $terms = isset($_POST['terms']) ? $_POST['terms'] : 'Disagree';

    $query = "INSERT INTO form4(std_image,first_name, last_name, password, email, phone, state, subjects, gender, terms)
              VALUES ('$folder','$firstName', '$lastName', '$password', '$email', '$phone', '$state', '$subject', '$gender', '$terms')";
              
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script> alert('Registration successful!')</script>";
    }    
    else{

        echo "<script> alert('Error:')</script>";
    }
    mysqli_close($conn);
}
?>
