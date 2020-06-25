<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>BudgetME</title>
  </head>
  <body>
    <div class="jumbotron">
  <h1 class="display-4">Add Transaction</h1>


  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="RegistarPage.php">Registration Page</a></li>

  </ol>
</nav>

</div>

<div class = "container">
<form method="post" action="transactionsHandler.php">

  <div class="form-group">
    <label for="exampleInputPassword1">Payee</label>
    <input type="Username" class="form-control" name = "payee" id="exampleInputPassword1" placeholder="Payee">
  </div>
  <div class="form-group">
  <label for ="exampleInputPassword1">Section</label>
  <select class="custom-select" name = "section" id="inputGroupSelect03">


        <?php
        session_start();
        $server = 'localhost';
        $user = 'root';
        $pass = 'usbw';
        $db = 'BudgetMe';
        $conn = new mysqli($server, $user, $pass, $db);
        if($conn->connect_error)
        {
        die("Connection Failed: " . $conn->connect_error);
        }
        $sql = "SELECT sections.type FROM sections WHERE sections.userid=".$_SESSION['id'];
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc())
        {
          $section = $row["type"];
          echo "<option value ='".$section."' name ='".$section."'>".$section."</option>";
        }

        ?>

    </select>
    <!-- <label for="exampleInputPassword1">Section</label>
    <input type="Username" class="form-control" name  = "section" id="exampleInputPassword2" placeholder="Section"> -->
  </div>
  <div class="form-group">

    <label for="exampleInputPassword1">Amount</label>
    <input type="Username" class="form-control" name  = "amount" id="exampleInputPassword2" placeholder="$Amount$">
  </div>
  <div class="form-check">

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
session_start();
  if(isset($_SESSION['Wrong']))
  {
    echo "<div> You entered an incorrect username or password </div>";
      unset($_SESSION['Wrong']);
  }


?>
</div>





  </div>
</form>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
