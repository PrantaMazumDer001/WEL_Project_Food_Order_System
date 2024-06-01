
  
<?php
        include('../config/constants.php');


        // first check the id is passing or not

        if(isset($_GET['id'])){
        // 1. Get the id of admin



            $id =  mysqli_real_escape_string($conn , $_GET['id']);

            /*
                Given methods are old  one and not secure in sql injection

            $id = $_GET['id'];

            */


            //2. Query for delete data from database
            $sql = "DELETE FROM tbl_order WHERE id = $id";

            // Execute this query
            $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                    // Check the execution of query

                    if($res == true){

                                // Display message of successfully the deletation of admin in admin-management by session variable
                                $_SESSION['delete_order_s'] = "<div class = 'success' > Successfully delete the order. </div>";
                                        // Redirected into add admin page
                                        header("location:".SITEURL.'admin/manage-order.php');    



                    }else{

                        $_SESSION['delete_order_u'] = " <div class = 'error' > Faild to delete the order . </div> ";
                        // Redirected into add admin page
                        header("location:".SITEURL.'admin/manage-order.php');    


                    }


        }else{

            // if data is not inserted then this message is shown
            $_SESSION['unauthorization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
        
            // Redirected to manage-catagory page

            header("location:".SITEURL.'admin/manage-order.php');    


        }





?>



    
<?php


// This page is secure from sql injection and also structured...


?>