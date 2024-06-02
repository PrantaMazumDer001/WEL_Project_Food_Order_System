<?php

include('partials/menu.php')

?>




<?php
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

                $sql = "SELECT * FROM tbl_catagory WHERE id = '$id'";

                $res = mysqli_query($conn , $sql ) or die(mysqli_error());


                $count = mysqli_num_rows($res); // Function to get all the rows from database

                if($count==1)
                {
                    // Get the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];

                    $featured = $row['featured'];
                    $active = $row['active'];

                }else{
                    // if data is not inserted then this message is shown
                    $_SESSION['update-category-u'] = "<div class = 'error' >Fail to upate the category. </div>";
                    // Redirected into add category managment page
                    header("location:".SITEURL.'admin/manage-catagory.php');
                
                
                } 




        }else{

            // if data is not inserted then this message is shown
            $_SESSION['update-category-e'] = "<div class = 'error' > Invalid arrgument passing. </div>";
        
            // Redirected to manage-catagory page

            header("location:".SITEURL.'admin/manage-catagory.php');    


        }



?>




<div class="wrapper">
    <h1 class="text-center heading">This is category update site</h1>

    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">


        <table class="tbl-form-category">
            <tr>
                <td>Category Title :</td>
                <td><input type="text" name="title" value="<?php echo $title ?>"></td>
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

                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="55px" alt="">

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
                    <input <?php if($active == "yes"){  echo"checked";} ?> type="radio" name="active" value="yes">Yes
                    <input <?php if($active == "no"){  echo"checked";} ?> type="radio" name="active" value="no">No
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
                
                $title =  mysqli_real_escape_string($conn , $_POST['title']);
                $featured =  mysqli_real_escape_string($conn ,  $_POST['featured']);
                $active =  mysqli_real_escape_string($conn ,  $_POST['active']);



                /*
                Given methods are old  one and not secure in sql injection

                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

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

                            $image_name = "food_category_".rand(00000,99999).'.'.$ext; // Now , it converted into food_category_35091.jpg



                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;

                            // Finally upload the image
                            $upload = move_uploaded_file($source_path , $destination_path);

                            // To confirm image upload 
                            if($upload == false)
                            {

                                            // Show the error message
                                           $_SESSION['upload-image-u'] = "<div class = 'error' > Image upload unsuccessfully and try again. </div>";
                                            // Redirected into category management page
                                            header("location:".SITEURL.'admin/manage-category.php');

                                            // To stop current state

                                            die();
 


                            }

                            // Now remove old image 
                            // check the existence of current image
                            if($current_image != "")
                            {
                                $path = "../images/category/".$current_image;
                                $remove = unlink($path);
                                if($remove == false)
                                {

                                    // If fail to remove image , then display a error message and stop the process


                                    // Set the error message
                                    $_SESSION['update-image-u'] = "<div class = 'error' > Fail to update the category. </div>";
                                    // Redirected to manage-category.php page

                                    header("location:".SITEURL.'admin/manage-catagory.php');    

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

                    $sql2 = "UPDATE tbl_catagory SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id = '$id'";

                    // Execute sql coomand 

                $res2 = mysqli_query($conn , $sql2 ) or die(mysqli_error());

                if($res2==true)
                {
                    // if data is inserted then this message is shown
                    $_SESSION['category-u-s'] = "<div class = 'success' >Category update successfully. </div>";
                    // Redirected into category management page
                    header("location:".SITEURL.'admin/manage-catagory.php');
                }
                                
                else
                {
                    // if data is not inserted then this message is shown
                    $_SESSION['category-u-u'] = "<div class = 'success' > Failed to update category. </div>";
                    // Redirected into add category managment page
                    header("location:".SITEURL.'admin/manage-catagory.php');   
                }





        }

    


?>




<?php

include('partials/footer.php')



?>


    
<?php


// This page is secure from sql injection and also structured...


?>