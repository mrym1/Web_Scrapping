<?php
 session_start();
include '../partials/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['snoEdit1']))

    {   
        
        $SNO = $_POST['snoEdit1'];
        $N_NAME  = $_POST['n_name1'];
        $A_NAME  = $_POST['a_name1'];
        $STAR  = $_POST['s_star'];
        $RATE  = $_POST['r_rate'];

        echo $SNO;
        $sql = "UPDATE `NOVEL` SET `N_NAME` = '$N_NAME', `A_NAME` = '$A_NAME', `STAR` = '$STAR', `RATING` = '$RATE' WHERE `NOVEL`.`SID` = $SNO";
        $result = mysqli_query($Connect_DB,$sql);
        if ($result)
        {
            header("location: /WEB_SCRAPPING/php/Scrapping.php");
        }
        else
        {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Something went wrong!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        
        }

    }
}

// Delete Row
if(isset($_GET['delete']))
{
    $sno = $_GET['delete'];
    echo $sno;
    $sql2 = "DELETE FROM `NOVEL` WHERE `NOVEL`.`SID` = $sno";
    $result2 = mysqli_query($Connect_DB,$sql2);
    if($result2)
    {   
        // unlink('../uploads/'.$IMAGE);
        $_SESSION['status'] = "Account Deleted Successfully";
        header("location: /WEB_SCRAPPING/php/Scrapping.php");
    }
    else{
        $_SESSION['status'] = "Account Did Not Deleted";
        header("location: /WEB_SCRAPPING/php/Scrapping.php");

    }
}

?>