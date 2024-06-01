<?php

include('partials/menu.php');

?>




<?php

        ob_start();
        // Wether passing id and  image_name is available or not

        if(isset($_GET['id']))
        {

                // Get the value  and delete

                $id =  mysqli_real_escape_string($conn ,  $_GET['id']);

            /*
                Given methods are old  one and not secure in sql injection

                $id = $_GET['id'];

                */

            // 2. Get data from database

            $sql2 = "SELECT * FROM tbl_food WHERE id = '$id'";

            $res2 = mysqli_query($conn , $sql2 ) or die(mysqli_error());


            $count2 = mysqli_num_rows($res2); // Function to get all the rows from database

            if($count2 == 1)
             {
                                
                // Get the data
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $current_image = $row2['image_name'];
                $description = $row2['description'];
                $category_id = $row2['catagory_id'];
                $price = $row2['price'];
                $featured = $row2['featured'];
                $active = $row2['active'];

            }
            else
            {
                // if data is not inserted then this message is shown
                $_SESSION['update-food-u'] = "<div class = 'error' >Fail to upate the food item. </div>";
                // Redirected into add category managment page
                header("location:".SITEURL.'admin/manage-food.php');
            
    
             } 




        }
        else
        {

            // if data is not inserted then this message is shown
            $_SESSION['unauthorization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
        
            // Redirected to manage-catagory page

            header("location:".SITEURL.'admin/manage-food.php');    


        }



?>




<div class="wrapper">
    <h1 class="text-center heading">This is category update site</h1>

    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">


        <table class="tbl-form-category">
            <tr>
                <td>Product Title :</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>
            <tr>
                <td>Description :</td>
                <td>
                    <textarea name="description" cols="30" rows="3"><?php echo $description; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Price :</td>
                <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
            </tr>
            <tr>
                <td>
                    Current image :
                </td>
                <td>
                    <?php 
                                // Process of showing image
                                // First , check the image is available or not by $image_name variable
                                if($current_image != "")
                                {

                                    // If image is found then it shown
                    ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="55px" alt="">

                    <?php



                                }
                                else
                                {

                                    // If image is not available then this error message is shown

                    ?>

                    <div class="error-message">Image not found</div>

                    <?php

                                }

                               
                    ?>



                </td>
            </tr>

            <tr>
                <td>
                    New image :
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
                                        while($rows = mysqli_fetch_assoc($res))
                                        {


                                                    // Use while loop for getting all data from database and this loop is run as long as we have data in database
                                                    //Get individual data
                                                    $id2 = $rows['id'];
                                                    $title2 = $rows['title'];


                        ?>

                        <option <?php if($category_id == $id2){  echo"selected";} ?> value="<?php echo $id2; ?>">
                            <?php echo $title2; ?></option>
                        <?php




                                                }
                            }
                            else
                            {

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
                    <input <?php if($featured == "yes"){  echo"checked";} ?> type="radio" name="featured"
                        value="yes">Yes
                    <input <?php if($featured == "no"){  echo"checked";} ?> type="radio" name="featured" value="no">No


                </td>
            </tr>
            <tr>
                <td>Active :</td>
                <td>
                    <input <?php if($active == "yes"){  echo "checked";} ?> type="radio" name="active" value="yes">Yes
                    <input <?php if($active == "no"){  echo "checked";} ?> type="radio" name="active" value="no">No
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="submit" value="Update"
                        class="btn-primary"></td>
            </tr>
        </table>



    </form>

    <div class="clearfix"></div>


</div>

<?php


        // Check wether update category button is clicked

        if(isset($_POST['submit']))
        {


                // Get all the value from above form
                
                $title3 =  mysqli_real_escape_string($conn , $_POST['title']);

                $price3 =  mysqli_real_escape_string($conn ,  $_POST['price']);
                $category_id3 =  mysqli_real_escape_string($conn , $_POST['category_id']);
                $description3 =  mysqli_real_escape_string($conn , $_POST['description']);
                $featured3 =  mysqli_real_escape_string($conn , $_POST['featured']);
                $active3 =  mysqli_real_escape_string($conn ,  $_POST['active']);




                        
                    /*
                        Given methods are old  one and not secure in sql injection

                        $title3 = $_POST['title'];

                        $price3 = $_POST['price'];
                        $category_id3 = $_POST['category_id'];
                        $description3 = $_POST['description'];
                        $featured3 = $_POST['featured'];
                        $active3 = $_POST['active'];


                    */



                // Work for image section

                // Check new image is selected or not and set the value for image name accordingly

                if(isset($_FILES['image']['name']))
                {

                            // Upload the image


                    //  Here we will handle image by image name , source path and destination path
                    $image_name = $_FILES['image']['name'];

                    // If image not select then
                    if($image_name != "")
                    {


        
                            // Auto rename process of image , first image upload as it's source name e.g. demo.jpg

                                //1. Get the extension

                                    $ext = end(explode('.',$image_name));

                            //2. Rename image

                            $image_name = "food_No_".rand(00000,99999).'.'.$ext; // Now , it converted into food_category_35091.jpg



                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/food/".$image_name;

                            // Finally upload the image
                            $upload = move_uploaded_file($source_path , $destination_path);

                            // To confirm image upload 
                            if($upload == false)
                            {

                                            // Show the error message
                                           $_SESSION['upload-image-u'] = "<div class = 'error' > Image upload unsuccessfully and try again. </div>";
                                            // Redirected into category management page
                                            header("location:".SITEURL.'admin/manage-food.php');

                                            // To stop current state

                                            die();
 


                            }



                            // Now remove old image 
                            // check the existence of current image
                            if($current_image != "")
                            {

                                $path = "../images/food/".$current_image;
                                $remove = unlink($path);
                                if($remove == false)
                                {

                                    // If fail to remove image , then display a error message and stop the process


                                    // Set the error message
                                    $_SESSION['update-food-e'] = "<div class = 'error' > Fail to update the food item. </div>";
                                    // Redirected to manage-category.php page

                                    header("location:".SITEURL.'admin/manage-food.php');    

                                    // Stop the process
                                    die();



 
                                 }

                            }




                     }
                     else
                     {
                        // If click file button but don't select new image then privious image will remain 
                        $image_name = $current_image;

                    }




                }
                else
                {

                    // If don't click file button then privious image will remain 
                    $image_name = $current_image;



                }

                // Write SQL command for data store in database

                $sql5 = "UPDATE tbl_food SET
                title = '$title3',
                description = '$description3',
                catagory_id = '$category_id3',
                price = '$price3',
                image_name = '$image_name',
                featured = '$featured3',
                active = '$active3' 
                WHERE id = '$id'";

                // Execute sql coomand 

                $res5 = mysqli_query($conn , $sql5 ) or die(mysqli_error());

                if($res5==true)
                {
                            // if data is inserted then this message is shown
                            $_SESSION['food-u-s'] = "<div class = 'success' >Food item update successfully. </div>";
                            // Redirected into category management page
                            header("location:".SITEURL.'admin/manage-food.php');
                            ob_end_flush();
                }
                else
                {
                       // if data is not inserted then this message is shown
                       $_SESSION['food-u-u'] = "<div class = 'success' > Failed to update food item. </div>";
                       // Redirected into add category managment page
                       header("location:".SITEURL.'admin/manage-food.php');   
                }





        }

    


?>




<?php

include('partials/footer.php');



?>



<?php


// This page is secure from sql injection and also structured...


?>