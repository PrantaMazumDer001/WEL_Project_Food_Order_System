<?php

include('partials/menu.php');

?>
<div class="main-content">

    <div class="wrapper">
        <h1 class="text-center heading">This is new food adding page</h1>
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

                
                if(isset($_SESSION['food-u'])){  // Checking the variable is set

                    echo $_SESSION['food-u']; // Display the message
                    unset($_SESSION['food-u']); //Removing the message
                }









        ?>
        <br><br>








        <form action="" method="POST" enctype="multipart/form-data">


            <table class="tbl-form-category">
                <tr>
                    <td>Product Title :</td>
                    <td><input type="text" name="title" placeholder="Enter product name"></td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td>
                        <textarea name="description" cols="30" rows="3"
                            placeholder="Enter the descriotion of food!"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price">
                    </td>
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
                    <td>
                        Category id :
                    </td>
                    <td>
                        <select name="category_id">
                            <?php

                                    // Get the data from database...

                                    // Create sql query to get data from database

                                    // Display them in page

                                    $sql = "SELECT * FROM tbl_catagory WHERE active = 'yes'";

                                    // Execute the query now...

                                    $res = mysqli_query($conn , $sql ) or die(mysqli_error());

                                    $count = mysqli_num_rows($res); // Function to get all the rows from database


                                if($count > 0)
                                {
                                    // If data found then this step is done
                                    // We have data in database
                                    while($rows = mysqli_fetch_assoc($res)){

                                        // Use while loop for getting all data from database and this loop is run as long as we have data in database
                                        //Get individual data
                                        $id = $rows['id'];
                                        $title = $rows['title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>
                                        <?php




                                    }
                                }else{
                                    // If data  not found then this step is done
                                ?>
                                        <option value="0">No category found</option>

                                        <?php
                                
                                } 
                    

                            ?>

                        </select>
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
                    <td colspan="2" class="text-center"><input type="submit" name="submit" value="Add food"
                            class="btn-primary"></td>
                </tr>
            </table>



        </form>

        <?php

                // Check wether add category button is clicked

                if(isset($_POST['submit'])){


                // Get all the value from above form

                $title =  mysqli_real_escape_string($conn , $_POST['title']);
                $description =  mysqli_real_escape_string($conn ,  $_POST['description']);
                $price =  mysqli_real_escape_string($conn ,  $_POST['price']);
                $category =  mysqli_real_escape_string($conn , $_POST['category_id']);



                        /*
                            Given methods are old  one and not secure in sql injection

                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $category = $_POST['category_id'];

                        */

                // Check wether feature radio button is clicked

                if(isset($_POST['featured'])){

                    // Get the value from form
                    $featured = mysqli_real_escape_string($conn ,  $_POST['featured']);
                                                
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
                            $active =  mysqli_real_escape_string($conn ,  $_POST['active']);
                    

                                    /*
                                Given methods are old  one and not secure in sql injection

                                    $active = $_POST['active'];

                                 */



                        }else{
                        
                        
                            // Set the default value
                            $active = "no";
                        
                        
                        }
        
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

                            $image_name = "food_No_".rand(00000,99999).".".$ext; // Now , it converted into food_category_35091.jpg



                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/food/".$image_name;

                            // Finally upload the image
                            $upload = move_uploaded_file($source_path , $destination_path);

                                                                        // To confirm image upload 
                                            if($upload == false){

                                                            // Show the error message
                                                            $_SESSION['upload-image-u'] = "<div class = 'error' > Image upload unsuccessfully and try again. </div>";
                                                            // Redirected into category management page
                                                            header("location:".SITEURL.'admin/add-food.php');

                                                            // To stop current state

                                                            die();
                                                        

                                                            }

                                                                        }
                            }else{

                                // Don't upload the image and image nane will remain blank
                                $image_name = "";



                            }

                            // Write SQL command for data store in database



                            $sql2 = "INSERT INTO tbl_food SET
                            title = '$title',
                            image_name = '$image_name',
                            description = '$description',
                            price = '$price',
                            catagory_id = '$category',
                            featured = '$featured',
                            active = '$active'";

                                                        // Execute sql coomand 

                            $res2 = mysqli_query($conn , $sql2) or die(mysqli_error());

                            if($res2==true)
                            {
                                // if data is inserted then this message is shown
                                $_SESSION['food-s'] = "<div class = 'success' > New food item added successfully. </div>";
                                // Redirected into category management page
                                header("location:".SITEURL.'admin/manage-food.php');
                            }
                            else
                            {
                                // if data is not inserted then this message is shown
                                $_SESSION['food-u'] = "<div class = 'error' > Failed to add new food item. </div>";
                                // Redirected into add category managment page
                                header("location:".SITEURL.'admin/add-food.php'); 

                            }




                    // After successfully add the food then redirected into manage-food page
                    }


       ?>

        <div class="clearfix"></div>


    </div>
</div>


<?php 


include('partials/footer.php'); 
     
     
?>



    
<?php


// This page is secure from sql injection and also structured...


?>