<?php
include("connection.php");

session_start();
error_reporting(0);

if(!isset($_SESSION['user_mail'])) {
  header('location:login.php');
  exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM form4 WHERE id = '$id'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container">
   <form action="#" method="POST" enctype="multipart/form-data">
     <div class="title">
        Update Student Details 
     </div>
 
     <div class="form">
       <div class="Input_field">
          <label>Upload Image</label>
          <input type="file" name="uploadfile" style="width: 100%"><br>
       </div>

       <div class="Input_field">
          <label>First Name</label>
          <input type="text" name="FName" value="<?php echo $result['first_name']; ?>" class="input" required>
       </div>

       <div class="Input_field">
        <label>Last Name</label>
        <input type="text" name="LName" value="<?php echo $result['last_name']; ?>" class="input" required>
       </div>
     
       <div class="Input_field">
        <label>Password</label>
        <input type="password" name="Password" value="<?php echo $result['password']; ?>" class="input" required> 
       </div> 
    
       <div class="Input_field">
        <label>Email Address</label>
        <input type="email" name="Email" value="<?php echo $result['email']; ?>" class="input" required> 
       </div> 
     
       <div class="Input_field">
        <label>Phone Number</label>
        <input type="tel" name="phone" value="<?php echo $result['phone']; ?>" class="input" required> 
       </div> 
     
       <div class="Input_field">
        <label>Choose Your State</label>
        <div class="coustome_select">
         <select name="State" required> 
            <option value="">Select</option>  
            <option value="Jaipur" <?php if($result['state'] == 'Jaipur'){ echo "selected"; } ?>>Jaipur</option>
            <option value="Dohlpur" <?php if($result['state'] == 'Dohlpur'){ echo "selected"; } ?>>Dohlpur</option>
            <option value="Dungharpur" <?php if($result['state'] == 'Dungharpur'){ echo "selected"; } ?>>Dungharpur</option>
            <option value="Badmer" <?php if($result['state'] == 'Badmer'){ echo "selected"; } ?>>Badmer</option>
         </select>
        </div> 
       </div> 
     <br>  
     
     <div class="Input_field">
        <label>Subject</label>
        <?php
            $subjects = explode(',', $result['subjects']);
        ?>
        Math<input type="checkbox" name="Subject[]" value="Math" <?php if(in_array('Math', $subjects)) { echo "checked"; } ?>>
        Physics<input type="checkbox" name="Subject[]" value="Physics" <?php if(in_array('Physics', $subjects)) { echo "checked"; } ?>>  
        Chemistry<input type="checkbox" name="Subject[]" value="Chemistry" <?php if(in_array('Chemistry', $subjects)) { echo "checked"; } ?>> 
        Bio<input type="checkbox" name="Subject[]" value="Bio" <?php if(in_array('Bio', $subjects)) { echo "checked"; } ?>> 
     </div>
     
     <br> 
       <div class="Input_field">
        <label>Gender</label>
        Male<input type="radio" name="gender" value="Male" <?php if($result['gender'] == 'Male'){ echo "checked"; } ?>>
        Female<input type="radio" name="gender" value="Female" <?php if($result['gender'] == 'Female'){ echo "checked"; } ?>>
       </div>
     <br> 
       <div class="Input_field terms">
        <label class="check">
            <input type="checkbox" name="terms" value="Agree" <?php if($result['terms'] == 'Agree'){ echo "checked"; } ?>>
            <span class="checkmark"></span>
        </label>
        <p>Agree to terms and conditions</p>
       </div>
     
       <div class="Input_field">
        <input type="submit" value="Update" class="btn" name="update"> 
       </div> 

     </div>

   </form>

</div> 

</body>
</html>

<?php
if(isset($_POST['update'])) {
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  
  // Check if a new file is uploaded
  if (!empty($filename)) {
    $folder = "images/".$filename; 
    if (move_uploaded_file($tempname, $folder)) {
        $imagePath = $folder;
    } else {
        echo "<script>alert('Failed to upload image');</script>";
    }
  } else {
    // Keep the old image path if no new image is uploaded
    $imagePath = $result['std_image'];
  }

  $firstName = $_POST['FName'];
  $lastName = $_POST['LName'];
  $password = $_POST['Password']; 
  $email = $_POST['Email'];
  $phone = $_POST['phone'];
  $state = $_POST['State'];

  $subject = isset($_POST['Subject']) ? implode(',', $_POST['Subject']) : '';
  $gender = $_POST['gender'];
  $terms = isset($_POST['terms']) ? $_POST['terms'] : 'Disagree';

  $query = "UPDATE form4 SET std_image='$imagePath', first_name='$firstName', last_name='$lastName', password='$password', email='$email', phone='$phone', state='$state', subjects='$subject', gender='$gender', terms='$terms' WHERE id='$id'";
          
  $result = mysqli_query($conn, $query);
  if($result){
      echo "<script>alert('Record Updated');</script>";
      ?>
      <meta http-equiv="refresh" content="0; url=http://localhost/GauravPHP/display.php"/>
      <?php 
  } else {
      echo "Error: " . mysqli_error($conn);
  }
  mysqli_close($conn);
}
?>
