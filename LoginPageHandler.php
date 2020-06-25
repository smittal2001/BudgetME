<?php
require_once('mysqli_connect.php');

header("Location: http://localhost:8080/PHP/BudgetME/LoginPage.php");


$check = true;
  $sql = "SELECT * FROM users";
  $result = @mysqli_query($dbc,$sql);
  while ($row = $result->fetch_assoc())
  {
    if($row['username']===$user && $row['password']===$pass)
    {
      $_SESSION['isLog'] = true;
      header("Location: http://localhost:8080/PHP/BudgetME/HomePage.php");
      $_SESSION['user'] = $user;
      $_SESSION['id'] = $row['id'];
      $check = false;
}

}
if($check === true)
{
  $_SESSION['Wrong']= "wrong thingy";
}

 ?>
