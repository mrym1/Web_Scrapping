<?php
include 'partials/db_conn.php';
$login = false;
$showError = false;
//Incase table is not created so create by this query 
$ADMIN_TABLE = "CREATE TABLE `ADMIN`(`SID` INT(6) NOT NULL AUTO_INCREMENT,
                                  `NAME` VARCHAR(25) NOT NULL,
                                  `EMAIL` VARCHAR(50) NOT NULL,
                                  `USERNAME` VARCHAR(25) NOT NULL,
                                  `PASSWORD` VARCHAR(255) NOT NULL,
                                  `PIN_CODE` VARCHAR(50) NOT NULL,
                                  `IMAGE` text NOT NULL DEFAULT '1.png',
                                  PRIMARY KEY (`SID`))";



$Table_Query = mysqli_query($Connect_DB, $ADMIN_TABLE);
if ($Table_Query) {
    $hash = password_hash('admin', PASSWORD_DEFAULT);
    $hash1 = password_hash('1234', PASSWORD_DEFAULT);
 
    $ADMIN_INSERT = "INSERT INTO ADMIN (`NAME`,`EMAIL`,`USERNAME`,`PASSWORD`,`PIN_CODE`,`IMAGE`) VALUES('Admin','admin@gmail.com','admin','$hash','$hash','user.png')";
    $data1 = mysqli_query($Connect_DB, $ADMIN_INSERT);
}

if (isset($_POST['submit'])) {

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
$username = $_POST["username"];
$password = $_POST["password"];



$SQL = "SELECT *FROM `ADMIN` WHERE `USERNAME` = '$username'";
    $result = mysqli_query($Connect_DB, $SQL);
    $num = mysqli_num_rows($result);
    
    if ($num == 1){
        while($row = mysqli_fetch_assoc($result))
        {  
            $pw = $row['PASSWORD'];
            $sid = $row['SID']; 
            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $pin = $row['PIN_CODE'];
            $image = $row['IMAGE'];    
                   
                if (password_verify($password, $pw ))
                // if ($password == 'admin' && $username == 'admin')
                { 
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['USERNAME'] = $username;
                    $_SESSION['PASSWORD'] = $password;
                    $_SESSION['SID'] = $sid;
                    $_SESSION['NAME'] = $name;
                    $_SESSION['EMAIL'] = $email;
                    $_SESSION['PIN'] = $pin;
                    $_SESSION['IMAGE'] = $image;
                    
                
                    header("location: /WEB_SCRAPPING/php/panel.php");
                } 
                else
                {
                    $showError = "Invalid Password";
                }
        }
        
    } 
    else
    {
        $showError = "Invalid UserName";
    }
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="Css/style.css">
    <title>Login</title>
  </head>

  <?php
    if($showError){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
        }
        
    ?>
  <body style="background-image: url('images/bg.jpg');">


  <!-- <div class="d-flex p-2 justify-content-end">
     <a href="/Inventory/php/User_login.php"><button type="button" class="btn btn-block btn-primary px-3"><b>User-Panel</b></button></a>
  </div>    -->

  <div class="container-fluid my-5 p-5 row d-flex justify-content-center align-items-center">
    
      
        <!-- <div class="row main_div d-flex justify-content-center align-items-center "> -->
            <div class="col-12 col-lg-5 col-md-8 col-xxl-5">
                <div class=" login py-3 px-2">
                    <div class="data">
                        <div class="row">
                            <div class="row justify-content-center align-items-center d-flex">
                                <a href="#" class="head-logo" style="color: rgb(40, 89, 247);">       
                                    &nbsp<i><strong class="mx-4">LOGIN</strong></i></a>
                            </div>
                        </div>
                        <form action="/WEB_SCRAPPING/index.php" method="POST" class="mt-5 text-center">
                        <div class="d-flex justify-content-center">
                            <div class="mb-2 col-md-10">
                                <input type="text" class="form-control rounded" id="username" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-2 col-md-10">
                                <input type="password" class="form-control rounded"  name="password" maxlength="20" id="password" placeholder="Password">
                            </div>
                        </div>
                            <!-- <a data-bs-toggle="modal" data-bs-target="#editModal"> Forgot Password </a> -->
                            <div class="my-3 ">
                             <button type="submit" onkeypress="return
                                 enterKeyPressed(event)" name="submit" id="A_submit" class="btn btn-block px-5 btn-primary btn-lg"><b>LOGIN</b></button>
                             </div>

                        </form>

                    </div>

                </div>
            </div>
        <!-- </div> -->
    </div>












    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
    function enterKeyPressed(event) {
           if (event.keyCode == 13) {
               console.log("Enter key is pressed");
               return true;
           } else {
               return false;
           }
       }
   </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<!-- 
$html = file_get_html('https://novelfeast.com/novel/i-want-to-be-the-king-of-football/details');
        echo $html->find('title', 0)->plaintext;
        $search = $html->find('h1[class="product_title entry_title="]', 0);
        echo $search->plaintext; -->
        <!-- // if ($search) {
        //     echo $search->plaintext;
        // }
        // echo $html->find('span[class="nice"]', 0)->plaintext;
        // echo $html->find('div[class="woocommerce-product-details__short-description"]', 0)->plaintext; -->


