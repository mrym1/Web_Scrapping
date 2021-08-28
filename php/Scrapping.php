<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("Location:/WEB_SCRAPPING/index.php");
        exit;
}

include ('../partials/db_conn.php');
include('simple_html_dom.php');

$SCRAP_Table = "CREATE TABLE `NOVEL`(`SID` INT(6) NOT NULL AUTO_INCREMENT,
                                    `N_NAME` VARCHAR(200) NOT NULL,
                                    `A_NAME` VARCHAR(200) NOT NULL,
                                    `STAR` VARCHAR(50) NOT NULL,
                                    `RATING` VARCHAR(50) NOT NULL,
                                    PRIMARY KEY (`SID`))";
$STable_Query = mysqli_query($Connect_DB, $SCRAP_Table);

if ($STable_Query) {
    $SCRAP_FIRST_INSERT = "INSERT INTO NOVEL (`N_NAME`,`A_NAME`,`STAR`,`RATING`) VALUES('NONE','NONE','NONE','NONE')";
    mysqli_query($Connect_DB, $SCRAP_FIRST_INSERT);
      
}
if(isset($_POST['_submit']))
{  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $Search = $_POST['_search'];
        $html = file_get_html("$Search");
        if($html){
        $nov_name = $html->find('h2[class="pt4 pb4 oh mb4 auto_height"]', 0)->plaintext;
        // echo "$nov_name";
        $auther = $html->find('p[class="ell dib vam"]', 0)->plaintext;
        // echo "$auther";
        $stars = $html->find('strong[class="vam fs24 mr8"]', 0)->plaintext;
        // echo "$stars";
        $rating = $html->find('small[class="fs16 dib vam"]', 0)->plaintext;
        // echo "$rating";
        // $des = "t all started with a stolen kiss on 'their first encounter'. [Warning: Mature content *NO rape and NO major misunderstanding!] Status: COMPLETED ****** “Miss Lana Huang… Expect a notice of harassment on your doorway soon…”";




        $Scrap_DATA_INSERT = "INSERT INTO `NOVEL` (`N_NAME`,`A_NAME`,`STAR`,`RATING`) VALUES('$nov_name','$auther','$stars','$rating')";
        $RUN = mysqli_query($Connect_DB, $Scrap_DATA_INSERT);
        IF($RUN){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Data entried
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Something Went Wrong!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital@1&display=swap" rel="stylesheet">
  
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="stylesheet" href="../Css/apanel.css">

    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  
    <title>Scrap Table</title>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                 "scrollX": true
            });
        });
    </script>
    <style>
        @media screen and (max-width: 500px) {

            div.dataTables_wrapper {
                width: 50px;
                margin: 0 auto;
                display: nowrap;
            }
        }

        @media screen and (max-width: 700px) {

            div.dataTables_wrapper {
                width: 100%;
                margin: 0 auto;
                display: nowrap;
            }
        }
    </style>
   
</head>
        <?php
             include ('../partials/sidebar.php');
        ?>

<body style="background-image: url('../images/2.jpg'); background-size: cover;" id="body-pd">

    <form action="/WEB_SCRAPPING/php/Scrapping.php" method="POST" class="mx-5 mt-2 d-flex">
            <input type="text" class="form-control me-2" placeholder="URL" id="_search" name="_search" aria-describedby="emailHelp">
        <button type="submit" name="_submit" class="btn btn-primary">+ADD</button>
    </form>
  

 <!-- Modal 2 for Update or Delete -->
                <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content text-light bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel"><strong>SCRAP-DATA-SET</strong></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            <?php if (isset($_GET['error'])): ?>
                                <p><?php echo $_GET['error']; ?></p>
                            <?php endif ?>

                                <form action="/WEB_SCRAPPING/php/Scrap_Script.php" method="POST" enctype="multipart/form-data" class="container">
                                    <fieldset>
                                            <input type="hidden" name="snoEdit1" id="snoEdit1">
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Novel Name" class="form-control" name="n_name1" id="n_name1" required aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Auther Name" class="form-control" name="a_name1" id="a_name1" required aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Stars" class="form-control" name="star1" id="star1" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Rating" class="rating1" name="desc1" id="rating1" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>
                                         
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


    <!-- Table -->

    <div class=" d-flex justify-content-center p-2 m-5 rounded _table">
            <div class="bf-info">
                <table class="table table-dark table-striped table-responsive" style="width: 1000px;" id="myTable">
                    <!-- #SR Username Iteam Name Date Description Quantity Estimated Cost -->

                    <thead>
                        <tr>
                            <th scope="col"><small>SR#</small></th>
                            <th scope="col"><small>Novel Name</small></th>
                            <th scope="col"><small>Auther Name</small></th>
                            <th scope="col"><small>STAR</small></th>
                            <th scope="col"><small>RATING</small></th>
                            <th scope="col"><small>Action</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="table">
                            <?php
                            $sql1 = "SELECT *FROM `NOVEL`";
                            $result1 = mysqli_query($Connect_DB, $sql1);
                            $num = 0;
                            $form = 0;
                            if ($result1) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    $form += 1;
                                    echo "<tr>
                                <th scope='row'><small>" . $form . "</small></th>
                                <td><small>" . $row['N_NAME'] . "</small></td>
                                <td><small>" . $row['A_NAME'] . "</small></td>
                                <td><small>" . $row['STAR'] . "</small></td>
                                <td><small>" . $row['RATING'] . "</small></td>
                                <td><i type='button' id=" . $row['SID'] . " class='edit las la-edit' ></i>&nbsp <i type='button' id=d" . $row['SID'] . " class='delete las la-trash'></i></td>
                                
                                </tr>";
                                }
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
   
        <div class="text-center">
            <a href="/WEB_SCRAPPING/php/panel.php"><button type="button" class="btn btn-outline-light text-dark mb-3"><strong>
            <i class="las la-arrow-alt-circle-left"></i>
            </strong></button></a>
        </div>

        
    <?php
        // $html = file_get_html('https://www.webnovel.com/book/big-shot-little-jiaojiao-breaks-her-persona-again_19668760106035605');
        // echo $html->find('title', 0)->plaintext.'<br>';

        // echo $html->find('p[class="c_000"]', 0)->plaintext.'<br>';
        // echo $html->find('div[class="_sd g_col _4"]', 0)->scr.'<br>';
        // echo $html->find('div[class=""_mn]', 0)->scr.'<br>';

    ?>

        








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    
    <script>
    
                edits = document.getElementsByClassName('edit');
                Array.from(edits).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        tr = e.target.parentNode.parentNode;
                        n_name = tr.getElementsByTagName("td")[0].innerText;
                        a_name = tr.getElementsByTagName("td")[1].innerText;
                        star = tr.getElementsByTagName("td")[2].innerText;
                        rate = tr.getElementsByTagName("td")[3].innerText;
                        n_name1.value = n_name;
                        a_name1.value = a_name;
                        star1.value = s_star;
                        rating1.value = r_rate;
                        snoEdit1.value = e.target.id;
                        $('#editModal').modal('toggle');
                        
                    })
                })
                deletes = document.getElementsByClassName('delete');
                Array.from(deletes).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        // console.log(e.target.id.substr(1, ));
                        sno = e.target.id.substr(1, );
                        if (confirm("You want to delete this record?")) {
                            console.log("yes");
                            window.location = `/WEB_SCRAPPING/php/Scrap_Script.php?delete=${sno}`;
                        }

                    })
                })
        </script>
  </body>
</html>