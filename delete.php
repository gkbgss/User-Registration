<?php
include("connection.php");

$id = $_GET['id'];

$query ="DELETE FROM form4 WHERE id ='$id'";
$data = mysqli_query($conn,$query);

if($data){
    echo "<script>alert('Record Deleted');</script>";
   ?>

<meta http-equiv = "refresh" content = "0; url =http://localhost/GauravPHP/display.php"/>

<?php
}
else{
    echo "<script>alert('ERROR to  Deleted');</script>";
}

?>