<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="HomePage.js"></script>
    <title>BudgetME</title>
  </head>
  <body>
<button type="button" class="btn btn-warning" name = "Logout"><a href = "LoginPage.php">Log Out</a></button>
    <div class="jumbotron  bg-success">
  <h1 style= "color:rgb(255, 255, 255);" class="display-4">Sections</h1>

  <p class="lead"> </p>
  <hr class="my-4">
  <!-- <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <?php
      session_start();

        if(isset($_SESSION['user']))
        {
          echo "Thank you for logging in ";
          echo $_SESSION['user'];
        }
        else {
            header("Location: http://localhost:8080/PHP/BudgetME/HomePage.php");

        }
      ?>
    </li>


  </ol> -->

  <ul class="nav justify-content-center">
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link active" href="HomePage.php">Section</a>
  </li>
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link" href="transactions.php">Transactions</a>
  </li>
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link" href="#">Link</a>
  </li>
</ul>

</div>

<div class = "container">
<div class="row">
  <ul class = "col-sm" id= "list">

    <?php
    $server = 'localhost';

    $user = 'root';

    $pass = 'usbw';

    $db = 'BudgetMe';

    $conn = new mysqli($server, $user, $pass, $db);

    if($conn->connect_error)
    {

    die("Connection Failed: " . $conn->connect_error);
    }

    //Makes a section for every transaction made
    //$sql = "SELECT sections.lim,SUM(DISTINCT transactions.amount), sections.type, sections.userid, transactions.section FROM transactions INNER JOIN sections ON (sections.userid=transactions.userid AND transactions.section = sections.type)";
  //  $sql = "SELECT * FROM sections WHERE sections.userid=".$_SESSION['id'];
//   $sql = "SELECT SUM(transactions.amount) , to_sections.type, from_sections.userid, from_sections.lim, transactions.section
// FROM transactions
// INNER JOIN sections from_sections ON ( from_sections.userid = transactions.userid )
// INNER JOIN sections to_sections ON ( to_sections.type = transactions.section )
// WHERE transactions.section = to_sections.type AND transactions.userid = ".$_SESSION['id'];
$sql = "SELECT sections.type, sections.lim FROM sections WHERE sections.userid=".$_SESSION['id'];


    $result = $conn->query($sql);
    $sections = array();
    $limits = array();
    //$exists = true;
    while ($row = $result->fetch_assoc())
    {
      array_push($limits, $row["lim"]);
      array_push($sections, $row["type"]);
      // if($row["userid"] === $_SESSION["id"]&&$row["type"]===$row["section"])
      // {
      //   //$arr[count($arr)-1] = $row["type"];
      //   $balance = $row["SUM(transactions.amount)"]/3;
      //   $lim = $row["lim"];
      //   $percent = ($balance/$lim)*100;
      //   echo "<li> <h2>".$row["type"]." </h2>";
      //   echo "<div class ='container'>";
      //   echo "  <div class='progress'>";
      //   //echo $balance;
      // //  echo $lim;
      // //echo $percent;
      //   echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:".$percent."%'></div>";
      //   echo "</div>";
      //   echo "<p align='right' style = 'font-weight: bold; color:rgb(0,0,0); ' >  ".$percent."%</p>";
      //   echo  "<button type='button' class='btn btn-secondary'>limit: ".$lim."</button>";

      //   if(count($arr)!=0)
      //   {
      // for($i=0;$i<count($arr);$i++)
      // {
      // //  echo $arr[$i];
      //   //echo "<br>";
      //   if(isset($arr[$i]))
      //   {
      //   if($row["type"] === $arr[$i])
      //   {
      //     $exists=true;
      //   }
      // }

      }

      //print_r($sections) ;
      $sql = "SELECT transactions.section, transactions.amount FROM transactions WHERE transactions.userid=".$_SESSION['id'];


          $result = $conn->query($sql);
          $transactions = array();
          $amount = array();
          //$exists = true;
          while ($row = $result->fetch_assoc())
          {
            $found = 0;
            for($k=0;$k<count($transactions);$k++)
               {
                  if($row["section"] === $transactions[$k])
                  {
                    $amount[$k] += $row["amount"];
                    $found = 1;
                  }

                }
                if($found === 0)
                {
                  array_push($transactions, $row["section"]);
                  array_push($amount,$row["amount"]);
                }

              }


        $map = array_combine($transactions, $amount);
          //print_r($transactions) ;
          //print_r($amount) ;
          //print_r($map);
          //echo $map["Gas"];



      for($i=0;$i<count($sections);$i++)
      {
        if (in_array($sections[$i], $transactions))
        {
          if(isset($sections[$i]) && isset($limits[$i]))
          {
             $percent = $map[$sections[$i]]/$limits[$i] *100;
             round($percent);
          }
        }
      else {
        {
          $percent = 0;
        }
      }


        echo "<li> <h2>".$sections[$i]." </h2>";
        echo "<div class ='container'>";
        echo "  <div class='progress'>";
        //echo $balance;
      //  echo $lim;
      //echo $percent;
        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:".$percent."%'></div>";
        echo "</div>";
        echo "<p align='right' style = 'font-weight: bold; color:rgb(0,0,0); ' >  ".$percent."%</p>";
        echo  "<button type='button' class='btn btn-secondary'>limit: ".$limits[$i]."</button>";
      }
    //   $balance = $row["balance"];
    //   $lim = $row["lim"];
    //   $percent = ($balance/$lim)*100;
    //   echo "<li> <h2>".$row["type"]." </h2>";
    //   echo "<div class ='container'>";
    //   echo "  <div class='progress'>";
    //   //echo $balance;
    // //  echo $lim;
    // //echo $percent;
    //   echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:".$percent."%'></div>";
    //   echo "</div>";
    //   echo "<p align='right' style = 'font-weight: bold; color:rgb(0,0,0); ' >  ".$percent."%</p>";
    //   echo  "<button type='button' class='btn btn-secondary'>limit: ".$lim."</button>";

      // {
      //   $arr[count($arr)-1] = $row["type"];
      //   $balance = $row["SUM(transactions.amount)"]/3;
      //   $lim = $row["lim"];









       ?>
  <!-- <ul class="col-sm" id="list">

<li>
  <h2>    </h2>
    <div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>

</div>
<div >

  <h5 style="color:green;">75% of Budget Used</h5>
  <button> Edit</button> <button onClick="stop()"> Remove</button>
</div>
</li>
<br>
<li>
<h2>  Eating Out </h2>
  <div class="progress">
<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>

</div>
<div >
<h5 style="color:green;">75% of Budget Used</h5>

  </div>

</li> -->



</ul>

</div>
<button type="button" class="btn btn-warning" name = "Logout"><a href = "addSection.php">Add Section</a></button>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="addSection.php" method="post">
              <div class="form-group">
                  <textarea name="tweetMaker" class="form-control"></textarea>
              </div>
              <button class="btn btn-outline-primary float-right" type="submit">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
