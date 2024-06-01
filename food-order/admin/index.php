<?php 


include('partials/menu.php')


?>

<!--Main Content Starts -->


<div class="main-content">

    <div class="wrapper">
        <h1 class="text-center heading">DASHBOARD</h1>
        <br>
        <div class="col-4 text-center">
            <h1>
                <?php

                              //Query to get all admin's information
                              $sql = "SELECT id FROM tbl_admin"; 

                              // Eexecute the query
                              $res = mysqli_query($conn , $sql ) or die(mysqli_error());
                              // Check weather query is worked or not
                              if($res==TRUE)
                              {

                                 $count = mysqli_num_rows($res); // Function to count all the rows from database

                                 echo $count;

                              }
                              else
                              {
                     ?>

                <div class="error-small"> An error is occured! </div>
                              <?php
                              }
                              ?>



            </h1>
            <br>
            Admin


        </div>
        <div class="col-4 text-center">
            <h1>
                <?php

                              //Query to get all admin's information
                              $sql2 = "SELECT id FROM tbl_catagory"; 

                              // Eexecute the query
                              $res2 = mysqli_query($conn , $sql2 ) or die(mysqli_error());
                              // Check weather query is worked or not
                              if($res2==TRUE)
                              {

                                 $count2 = mysqli_num_rows($res2); // Function to count all the rows from database

                                 echo $count2;

                              }
                              else
                              {
                  ?>

                <div class="error-small"> An error is occured! </div>
                              <?php
                              }
                              ?>



            </h1> <br>
            Catagories


        </div>
        <div class="col-4 text-center">
            <h1>
                <?php

                              //Query to get all admin's information
                              $sql3 = "SELECT id FROM tbl_food"; 

                              // Eexecute the query
                              $res3 = mysqli_query($conn , $sql3 ) or die(mysqli_error());
                              // Check weather query is worked or not
                              if($res3==TRUE)
                              {

                                 $count3 = mysqli_num_rows($res3); // Function to count all the rows from database

                                 echo $count3;

                              }
                              else
                              {
                ?>

                <div class="error-small"> An error is occured! </div>
                              <?php
                                  }
                              ?>



            </h1> <br>
            Foods


        </div>
        <div class="col-4 text-center">
            <h1>
                <?php

                                       //Query to get all admin's information
                                       $sql1 = "SELECT id FROM tbl_order"; 

                                       // Eexecute the query
                                       $res1 = mysqli_query($conn , $sql1 ) or die(mysqli_error());
                                       // Check weather query is worked or not
                                       if($res1==TRUE)
                                       {

                                          $count1 = mysqli_num_rows($res1); // Function to get all the rows from database

                                          echo $count1;

                                       }
                                       else
                                       {
                ?>

                <div class="error-small"> An error is occured! </div>
                                       <?php
                                          }
                                       ?>



            </h1> <br>
            Orders


        </div>
        <div class="col-4 text-center">
            <h1>
                <?php

                                       //Query to get all admin's information
                                       $sql5 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Delivered'"; 

                                       // Eexecute the query
                                       $res5 = mysqli_query($conn , $sql5 ) or die(mysqli_error());
                                       // Check weather query is worked or not
                                       if($res5==TRUE)
                                       {

                                          $rows5 = mysqli_fetch_assoc($res5); // Function to get all the rows from database
                                          $Total_revenue = $rows5['Total'];
                                          echo "$";

                                       echo $Total_revenue ;

                                       }
                                       else
                                       {
                ?>

                <div class="error-small"> An error is occured! </div>
                                     <?php
                                         }
                                     ?>



            </h1> <br>
            Revenue


        </div>
        <div class="clearfix"></div>


    </div>
</div>


<!--Main Content End -->

<?php include('partials/footer.php') ?>


    
<?php


// This page is secure from sql injection and also structured...


?>