<!DOCTYPE html>
<!-- This page displays an editable form which is all about asking information from the user.
  This is a lab exercise in CMSC 128 by Salvy Jessa M. Arnaiz -->
<html>
  <head>
    <meta charset = "utf-8"/>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
     <script src="bootstrap/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
     <link rel="stylesheet" type="text/css" href="css/style_registration.css">
  </head>
   <body>
    <?php 
      include 'connect.php';
      mysqli_select_db($dbconn, $db);
      /*if($dbcon == True){ 
        echo "true";
      }else{
        echo "false";
      }*/
      if (isset($_POST['submit'])){
        $acc_id=$_GET["acc_id"];
        $firstname=$_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $place = $_POST['place'];
        $numparty = $_POST['numparty'];
        $sched = $_POST['sched'];
        $time = $_POST['time'];
        $query = "INSERT INTO request(`acc_id`, `number`, `place`, `numparty`, `sched`, `time`)  VALUES (0,'$number','$place','$numparty','$sched','$time')";
        $result = mysqli_query($dbcon,$query);
        $affectedrows = mysqli_affected_rows($result);
        echo $result;
        if($affectedrows = 1){
           header("location: home_page.php");
         }
        
        }
      ?>
      <div class="container">
        <form method="post" action = "Request_Form.php" autocomplete="on" role="form">
            <legend><h1>Request Form</h1></legend>
            <br><label>First Name:</label> <input type="text" required name="fname" autofocus placeholder="First Name">
             <label>Last Name:</label><input type="text" required name="lname" placeholder="Last Name">
             <label>E-mail:</label><input type="email" required name="email" multiple autocomplete="off">
             <label>Contact Number:</label><input type="text" required name="number" pattern="09[0-9]{9}"><br>
             <label>Place to Tour:</label><input type="text" required>
             <label>Number in Party:</label><input type="number" required><br>
             <label>Date for Tour:</label><input type="date" required>
             <label>Time:</label><input type="time" required>
          
            <input type ="submit" name="submit" value="SUBMIT">
            <p>
             Please re-check the informations you have entered to avoid wrong information. Thank you.
            </p>
        </form> 
      </div>
    </body>
</html>