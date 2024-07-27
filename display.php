
<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        body {
            background: #D071f9;
        }
        table {
            background-color: white;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .update,.delete{

           background-color: Green;
           color:white;
           border:0;
           outline:none;
           border-radius: 5px;
           height: 22px; 
           width: 55x;
           font-weight: bold;
           cursor: pointer;
         }

         .delete{
            background-color: red;
          
         }
    </style>
</head>
<body>

<?php
include("connection.php");

$user= $_SESSION['user_mail'];
if($user == true){


}
else{
    header('location:login.php');
}
$query = "SELECT * FROM form4";
$data = mysqli_query($conn, $query);
?>

<h2 style="text-align:center"><mark>Display All Records</mark></h2>

<center>
<table border="1" cellspacing="7" width="100%">
    <tr>
        <th width="2%">Id</th>
        <th width="10%">Image</th>
        <th width="10%">First Name</th>
        <th width="10%">Last Name</th>
        <th width="10%">Password</th>
        <th width="20%">Email</th>
        <th width="10%">Phone No</th>
        <th width="5%">State</th>
        <th width="13%">Subject</th>
        <th width="2%">Gender</th>
        <th width="18%">Operations</th>
    </tr>

    <?php
    while ($result = mysqli_fetch_assoc($data)) {
        echo "<tr>
           <td>{$result['id']}</td>
           
          <td><img src='{$result['std_image']}' height='100px' width='100px'></td>


            <td>{$result['first_name']}</td>
            <td>{$result['last_name']}</td>
            <td>{$result['password']}</td>
            <td>{$result['email']}</td>
            <td>{$result['phone']}</td>
            <td>{$result['state']}</td>
            <td>{$result['subjects']}</td>
            <td>{$result['gender']}</td>
            <td>
            
            <a href='update_design.php?id=$result[id]'><input type='submit' value='Update' class='update'></a>
           <a href='delete.php?id=$result[id]'><input type='submit' value='Delete' class='delete'onclick='return checkdelete()'></a> 
            
            
            </td> 
        </tr>
        ";
    }
    ?>
</table>
</center>

<a href="logout.php"><input type="submit" name="" value="LOGOUT" style="background: blue; color:white; height: 35px;width: 100px; margin-top:20px; font-size: 18px;border:0px; cursor:pointer;"     >
</a>
<script>
function checkdelete(){
   return confirm('ARE YOU SURE TO DELETE IT?'); 
}

</script>

</body>
</html>

<?php
// Close the connection
mysqli_close($conn);
?>
