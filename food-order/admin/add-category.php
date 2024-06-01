<?php include('partials/menu.php') ?>

<div class="wrapper">
    <h1 class="text-center heading">This is category adding site</h1>

    <br><br>
    <?php

            if(isset($_SESSION['category-u'])){  // Checking the variable is set

                echo $_SESSION['category-u']; // Display the message
                unset($_SESSION['category-u']); //Removing the message
            }





            if(isset($_SESSION['upload-image-u'])){  // Checking the variable is set

                echo $_SESSION['upload-image-u']; // Display the message
                unset($_SESSION['upload-image-u']); //Removing the message
            }









    ?>
    <br><br>


    <form action="" method="POST" enctype="multipart/form-data">


        <table class="tbl-form-category">
            <tr>
                <td>Category Title :</td>
                <td><input type="text" name="title" placeholder="Enter product name"></td>
            </tr>

            <tr>
                <td>
                    Select image :
                </td>
                <td>
                    <input type="file" name="image">
                </td>

            </tr>
            <tr>
                <td>Featured :</td>
                <td>
                    <input type="radio" name="featured" value="yes">Yes
                    <input type="radio" name="featured" value="no">No


                </td>
            </tr>
            <tr>
                <td>Active :</td>
                <td>
                    <input type="radio" name="active" value="yes">Yes
                    <input type="radio" name="active" value="no">No
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="submit" value="Add category"
                        class="btn-primary"></td>
            </tr>
        </table>



    </form>

    <div class="clearfix"></div>


</div>
<br><br>

<?php

            // Check wether add category button is clicked

            if(isset($_POST['submit'])){


                        // Get all the value from above form

                        $title =  mysqli_real_escape_string($conn , $_POST['title']);


                                /* 
                                Given methods are old  one and not secure in sql injection

                                            
                                $title = $_POST['title'];

                                */

                    // Check wether feature radio button is clicked

                            if(isset($_POST['featured'])){

                                            // Get the value from form
                                            $featured =  mysqli_real_escape_string($conn , $_POST['featured']);


                                                /* 
                                                Given methods are old  one and not secure in sql injection

                                                
                                                $featured = $_POST['featured'];

                                                */

                            }else{


                                // Set the default value
                                $featured = "no";


                            }
                    // Check wether active radio button is clicked


                    if(isset($_POST['active'])){

                                // Get the value from form
                                $active = mysqli_real_escape_string($conn ,$_POST['active']);

                                                    
                                        /* 
                                        Given methods are old  one and not secure in sql injection

                                        

                                            $active =  $_POST['active'];

                                            */
                        
                        }else{
                        
                        
                            // Set the default value
                            $active = "no";
                        
                        
                        }

                // print_r($_FILES['image']);
                // die();
                
                // Check the image is selected or not and set the value for image name accordingly

                            if(isset($_FILES['image']['name'])){

                                        // Upload the image


                                        //  Here we will handle image by image name , source path and destination path
                                        $image_name = $_FILES['image']['name'];

                                    // If image not select then
                                                if($image_name != ""){


                                                                    
                                                        // Auto rename process of image , first image upload as it's source name e.g. demo.jpg

                                                        //1. Get the extension

                                                        $ext = end(explode('.',$image_name));

                                                        //2. Rename image

                                                        $image_name = "food_category_".rand(00000,99999).'.'.$ext; // Now , it converted into food_category_35091.jpg



                                                        $source_path = $_FILES['image']['tmp_name']; // Where image is currently located
                                                        $destination_path = "../images/category/".$image_name; // Where image is currently locate

                                                        // Finally upload the image
                                                                                    $upload = move_uploaded_file($source_path , $destination_path);

                                                                                    // To confirm image upload 
                                                                if($upload == false){

                                                                                // Show the error message
                                                                                $_SESSION['upload-image-u'] = "<div class = 'error' > Image upload unsuccessfully and try again. </div>";
                                                                                // Redirected into category management page
                                                                                header("location:".SITEURL.'admin/add-category.php');

                                                                                // To stop current state

                                                                                die();
                                                                

                                                                        }

                                                }
                            }else{

                                // Don't upload the image and image nane will remain blank
                                $image_name = "";



                            }

                                // Write SQL command for data store in database

                                $sql = "INSERT INTO tbl_catagory SET
                                title = '$title',
                                image_name = '$image_name',
                                featured = '$featured',
                                active = '$active'";

                                // Execute sql coomand 



                                $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                                    if($res==true)
                                    {
                                        // if data is inserted then this message is shown
                                        $_SESSION['category-s'] = "<div class = 'success' > New category added successfully. </div>";
                                        // Redirected into category management page
                                        header("location:".SITEURL.'admin/manage-catagory.php');
                                    }
                                    else
                                    {
                                        // if data is not inserted then this message is shown
                                        $_SESSION['category-u'] = "<div class = 'error' > Failed to add new category. </div>";
                                        // Redirected into add category managment page
                                        header("location:".SITEURL.'admin/add-catagory.php');    }





            }







?>


<?php 


include('partials/footer.php')


?>


    
<?php


// This page is secure from sql injection and also structured...


?>