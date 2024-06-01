<?php include('partials/menu.php') ?>
<div class="wrapper">
    <h1 class="text-center heading">This is admin password management site</h1>

    <br><br>
    <?php 
        // Wether passing id  is available or not

        if(isset($_GET['id']))
        {

            $id =  mysqli_real_escape_string($conn , $_GET['id']);


            /*
                Given methods are old  one and not secure in sql injection

            $id = $_GET['id'];

            */


?>

    <form action="" method="POST">


        <table class="tbl-form">
            <tr>
                <td> To Verify You :</td>
                <td><input type="password" name="current_password" placeholder="Enter old password"></td>
            </tr>
            <tr>
                <td>New Password : </td>
                <td><input type="password" name="new_password" placeholder="Enter new password"></td>
            </tr>
            <tr>
                <td>Confirm Password : </td>
                <td><input type="password" name="confirm_password" placeholder="Confirm new password"></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>
                <td colspan="2" class="text-center">
                    <input type="hidden" name="id" value="<?php echo $id  ?>">


                    <input type="submit" name="submit" value="Update Password" class="btn-primary">
                </td>
            </tr>
        </table>



    </form>

    <div class="clearfix"></div>


</div>

<?php
                    // Check the update button is weather clicked
                    if(isset($_POST['submit']))
                    {


                                // Get the updated values by POST method
                            $id =  mysqli_real_escape_string($conn ,  $_POST['id']);

                            
                            /*
                                Given methods are old  one and not secure in sql injection

                            $id = $_POST['id'];

                            */


                            $current_password = md5($_POST['current_password']); 
                            $new_password = md5($_POST['new_password']);
                            $confirm_password = md5($_POST['confirm_password']);







                                // Update value in database 
                                $sql = "SELECT * FROM tbl_admin WHERE id = '$id' AND password = '$current_password'";
                                $res = mysqli_query($conn , $sql)  or die(mysqli_error());


                                if($res == true)
                                {

                                    // Checked the vailidity of user's input
                                    $count = mysqli_num_rows($res);

                                    if($count == 1)
                                    {
                                                                    
                                        // If update process is success than redirected to manage-admin page and show the success message
                                        if($new_password == $confirm_password)
                                        {

                                                $sql2 = "UPDATE tbl_admin SET 
                                                password = '$new_password'
                                                WHERE id = '$id'";
                                                $res2 = mysqli_query($conn , $sql2) or die(mysqli_error());
                                                if($res == true)
                                                {
                                                                                                
                                                        $_SESSION['update-p-s'] = "<div class = 'success' > Successfully changed the password  </div>";
                                                        // Redirected into add admin page
                                                        header("location:".SITEURL.'admin/manage-admin.php');

                                                }
                                                else
                                                {

                                                                                            
                                                    $_SESSION['update-p-se'] = "<div class = 'error' > Faild to change password and try again.  </div>";
                                                    // Redirected into add admin page
                                                    header("location:".SITEURL.'admin/manage-admin.php');


                                                }
                                                
                                        }
                                        else
                                        {
                                            

                                            // If new password is not match with confirm password than it redirected into manage-admin page
                                            $_SESSION['update-pc-s'] = "<div class = 'error' > The new password and confirm password you entered are not matched and try again. </div>";
                                            // Redirected into add admin page
                                            header("location:".SITEURL.'admin/manage-admin.php');
                                                


                                        }


                                    }
                                    else
                                    {

                                                                
                                        // If current passord is not correct than it redirect 
                                        $_SESSION['update-p-e'] = " <div class = 'error' > The current password you entered is not correct and try again. </div> ";
                                        // Redirected into add admin page
                                        header("location:".SITEURL.'admin/manage-admin.php');    

                                    }
                                
                                }







                    }
                    
        }
        else
        {


                
                // if data is not inserted then this message is shown
                $_SESSION['unauthorization'] = "<div class = 'error' > Invalid arrgument passing. </div>";
            
                // Redirected to manage-catagory page

                header("location:".SITEURL.'admin/manage-admin.php');    

        }


?>


<?php include('partials/footer.php') ?>


   
<?php


// This page is secure from sql injection and also structured...


?>