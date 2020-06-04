<?php
session_start();
include('security.php');

$connection = mysqli_connect("localhost","root","","adminpanel");

if(isset($_POST['save_admin_btn'])){
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $cpassword  = $_POST['confirmpassword'];
    $usertype   = $_POST['usertype'];

    if($password === $cpassword){
        
        $query = "INSERT INTO user_admin (username,email,password,usertype) VALUES('$username','$email','$password','$usertype')";
        $query_run = mysqli_query($connection,$query);

        if($query_run){
            // echo "Saved";
            $_SESSION['success'] = "Congratulations! Admin Profile Data is Added";
            header('Location: user_admin.php');
        } else {
            // echo "Not Saved";
            $_SESSION['status'] = "Sorry! Admin Profile Data is Not Added";
            header('Location: user_admin.php');
        }

    } else {
        $_SESSION['status'] = "Please try again! Password and Confirm Password Does Not Match";
        header('Location: user_admin.php');
    }

}

if(isset($_POST['update_admin_btn'])){

    $id         = $_POST['edit_id'];
    $username   = $_POST['edit_username'];
    $email      = $_POST['edit_email'];
    $password   = $_POST['edit_password'];
    $usertype   = $_POST['update_usertype'];

    $query = "UPDATE user_admin SET username='$username',email='$email',password='$password', usertype='$usertype' WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your Data is Update.";
        header('Location: user_admin.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Update.";
        header('Location: user_admin.php');
    }
}

if(isset($_POST['delete_admin_btn'])){

    $id = $_POST['delete_id'];
    $query = "DELETE FROM user_admin WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your Data is Delete.";
        header('Location: user_admin.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Delete.";
        header('Location: user_admin.php');
    }

}

if(isset($_POST['about_save_btn'])){

    $title        = $_POST['title'];
    $subtitle     = $_POST['subtitle'];
    $description  = $_POST['description'];
    $links        = $_POST['links'];

    $query = "INSERT INTO abouts (title,subtitle,description,links) VALUES('$title','$subtitle','$description','$links')";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your About Us is Added.";
        header('Location: aboutus.php');
    }else{
        $_SESSION['status'] = "Sorry! Your About is Not Added.";
        header('Location: aboutus.php');
    }

}

if(isset($_POST['update_about_btn'])){

    $id            = $_POST['edit_id'];
    $title         = $_POST['edit_about_title'];
    $subtitle      = $_POST['edit_about_subtitle'];
    $description   = $_POST['edit_about_description'];
    $links         = $_POST['edit_about_links'];

    $query = "UPDATE abouts SET title='$title',subtitle='$subtitle',description='$description', links='$links' WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your Data is Update.";
        header('Location: aboutus.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Update.";
        header('Location: aboutus.php');
    }
}

if(isset($_POST['delete_about_btn'])){

    $id = $_POST['delete_id'];
    $query = "DELETE FROM abouts WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your Data is Delete.";
        header('Location: aboutus.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Delete.";
        header('Location: aboutsus.php');
    }

}

if(isset($_POST['post_save_btn'])){

    $post_title        = $_POST['post_title'];
    $post_subtitle     = $_POST['post_subtitle'];
    $post_date         = $_POST['post_date'];
    $post_description  = $_POST['post_description'];
    $post_image        = $_FILES["post_image"]['name'];

    if(file_exists("upload/".$_FILES["post_image"]["name"])){
        $store = $_FILES["post_image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store.'";
        header('Location: post.php');
    }else{
        $query = "INSERT INTO post (`title`,`subtitle`,`date`,`descrip`,`images`) VALUES('$post_title','$post_subtitle','$post_date','$post_description','$post_image')";
        $query_run = mysqli_query($connection,$query);

        if($query_run){
            move_uploaded_file($_FILES["post_image"]["tmp_name"], "upload/".$_FILES["post_image"]["name"]);
            $_SESSION['success'] = "Congratulations! Your Post is Added.";
            header('Location: post.php');
        }else{
            $_SESSION['status'] = "Sorry! Your Post is Not Added.";
            header('Location: post.php');
        }
    }

}

if(isset($_POST['update_post_btn'])){

    $edit_id                = $_POST['edit_id'];
    $edit_post_title        = $_POST['edit_title'];
    $edit_post_subtitle     = $_POST['edit_subtitle'];
    $edit_post_date         = $_POST['edit_date'];
    $edit_post_description  = $_POST['edit_description'];
    $edit_post_image        = $_FILES["post_image"]['name'];

    $query = "UPDATE post SET title='$edit_post_title',subtitle='$edit_post_subtitle',date='$edit_post_date',descrip='$edit_post_description', images='$edit_post_image' WHERE id='$edit_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        move_uploaded_file($_FILES["post_image"]["tmp_name"], "upload/".$_FILES["post_image"]["name"]);
        $_SESSION['success'] = "Congratulations! Your Post is Update.";
        header('Location: post.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Update.";
        header('Location: post.php');
    }
}

if(isset($_POST['delete_post_btn'])){

    $id = $_POST['delete_id'];
    $query = "DELETE FROM post WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your Data is Delete.";
        header('Location: post.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Delete.";
        header('Location: post.php');
    }

}

if(isset($_POST['search_data'])){
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE post SET visible='$visible' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
}

if(isset($_POST['search_user_data'])){
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE user_admin SET visible='$visible' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
}

if(isset($_POST['delete_user_checked'])){
    $id = "1";
    $query = "DELETE FROM user_admin WHERE visible='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your Data is Delete.";
        header('Location: user_admin.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Delete.";
        header('Location: user_admin.php');
    }

}

if(isset($_POST['delete_post_checked'])){
    $id = "1";
    $query = "DELETE FROM post WHERE visible='$id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['success'] = "Congratulations! Your Data is Delete.";
        header('Location: post.php');
    }else{
        $_SESSION['status'] = "Sorry! Your Data is Not Delete.";
        header('Location: post.php');
    }

}


?>