<?php

        include('../config/constants.php');

        // Wether passing id and  image_name is available or not

        if(isset($_GET['id']) AND isset($_GET['image_name']))
        {

            // Get the value  and delete

            $id =  mysqli_real_escape_string($conn , $_GET['id']);
            $image_name =  mysqli_real_escape_string($conn , $_GET['image_name']);

            /* Given methods are old  one and not secure in sql injection

            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            */

            // 1. Remove the physical file

                if($image_name != "")
                {


                    $path = "../images/food/".$image_name;
                    $remove = unlink($path);
                    if($remove == false)
                    {

                        // If fail to remove image , then display a error message and stop the process


                        // Set the error message
                        $_SESSION['delete-food-image-u'] = "<div class = 'error' > Fail to delete the category. </div>";
                        // Redirected to manage-category.php page

                        header("location:".SITEURL.'admin/manage-food.php');    

                        // Stop the process
                        die();




                    }
                }

                // 2. Delete from database

                $sql = "DELETE FROM tbl_food WHERE id = '$id'";

                $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                                if($res==true)
                {
                    // If data is inserted then this message is shown
                    $_SESSION['food-delete-s'] = "<div class = 'success' >Successfully delete the food item. </div>";
                    // Redirected into category management page
                    header("location:".SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // If data is not inserted then this message is shown
                    $_SESSION['food-delete-u'] = "<div class = 'error' >Fail to delete the food item. </div>";
                    // Redirected into add category managment page
                    header("location:".SITEURL.'admin/manage-food.php');


                } 

        }else{

            // if data is not inserted then this message is shown
            $_SESSION['unauthorization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
        
            // Redirected to manage-catagory page

            header("location:".SITEURL.'admin/manage-food.php');    


        }
?>


    
<?php


// This page is secure from sql injection and also structured...


?>