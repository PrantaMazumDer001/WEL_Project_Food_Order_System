
  
<?php
        include('../config/constants.php');

        // First check the vaild argument
        if(isset($_GET['id'])){


        // 1. Get the id of admin


        $id =  mysqli_real_escape_string($conn , $_GET['id']);

        /* 
        Given methods are old  one and not secure in sql injection

        $id = $_GET['id'];

        */

        //2. Query for delete data from database
        $sql = "DELETE FROM tbl_admin WHERE id = $id";

        // Execute this query
        $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                // Check the execution of query

                if($res == true){

                                // Display message of successfully the deletation of admin in admin-management by session variable
                                $_SESSION['delete'] = "<div class = 'success' > Successfully delete the admin. </div>";
                                        // Redirected into add admin page
                                        header("location:".SITEURL.'admin/manage-admin.php');    



                                }else{

                                    $_SESSION['delete'] = " <div class = 'error' > Faild to delete the admin . </div> ";
                                    // Redirected into add admin page
                                    header("location:".SITEURL.'admin/manage-admin.php');    


                                }

        // 3. Redirected to admin management page

        }else{


                
                // if data is not inserted then this message is shown
                $_SESSION['unauthorization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
            
                // Redirected to manage-catagory page

                header("location:".SITEURL.'admin/manage-admin.php');    


        }
?>

    
<?php


// This page is secure from sql injection and also structured...


?>
  
