<?php
   include("config.php");
   session_start();
   $name=$age=$gender=$Password=$CPassword=$eid=$pno="";$err=0;

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $name=test_input($_POST["name"]); if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
      {echo  "Only letters and white space allowed"; 
       $err=1;}


  $age=test_input($_POST["age"]);
  
  
  $gender=test_input($_POST["gender"]);
  

  $eid=test_input($_POST["eid"]);if (!filter_var($eid, FILTER_VALIDATE_EMAIL)) 
      {echo "Invalid email format"; 
      $err=1;}

  $Password=test_input($_POST["Password"]);
  $CPassword=test_input($_POST["CPassword"]);
    if($_POST['Password'] != $_POST['CPassword'])$err=1;  
  $pno=test_input($_POST["pno"]);
}

if($err!=0){
  header("location:javascript://history.go(-1)");
}



require_once("db.php");
$db_handle = new DBController();
$query = "INSERT INTO registered_users (name,age,eid,gender,Password,pno) VALUES
('" . $_POST["name"] . "', '" . $_POST["age"] . "', '" . $_POST["eid"] . "', '" . md5($_POST["gender"]) . "', '" . $_POST["Password"] . "', '" . $_POST["pno"] . "')";
$result = $db_handle->insertQuery($query);
if(!empty($result)) {
  $message = "You have edited successfully!"; 
  unset($_POST);
} else {
  $message = "Problem in editing. Try Again!"; 
}

{echo"<br><br><br>";
echo"You are ";
echo $name;echo"<br>";
echo "And ur age is :";
echo $age;echo"<br>";
echo "mail-id:".$eid;echo"<br>";
echo "Gender:";echo $gender;echo "<br>";
echo "Password:";echo $Password."<br>";
echo "Phone number is:".$pno;
}
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      
      mysqli_real_escape_string($db,$_POST['name'])=$name;
      mysqli_real_escape_string($db,$_POST['Password'])=$Password;
      mysqli_real_escape_string($db,$_POST['age'])=$age;
      mysqli_real_escape_string($db,$_POST['eid'])=$eid;
      mysqli_real_escape_string($db,$_POST['gender'])=$gender;
      mysqli_real_escape_string($db,$_POST['pno'])=$pno;

      }
?>