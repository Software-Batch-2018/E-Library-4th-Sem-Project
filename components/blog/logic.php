<?php

    // Don't display server errors 
    ini_set("display_errors", "off");

    // Initialize a database connection
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "librarydb";
    
    $conn = mysqli_connect($server, $user, $pass, $database);
    
    // Destroy if not possible to create a connection
    if(!$conn){
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }

    // Get data to display on index page
    $sql = "SELECT * FROM blog_data";
    $query = mysqli_query($conn, $sql);

    // Create a new post
    if(isset($_REQUEST['new_post'])){
        $title = $_REQUEST['title'];
        $user_id = $_REQUEST['user_id'];
        $content =mysqli_real_escape_string($conn, $_REQUEST['content']);

        $sql = "INSERT INTO blog_data(user_id, title, content) VALUES('$user_id','$title', '$content')";
        $add = mysqli_query($conn, $sql);

        if($add){
            echo $sql;
            header("Location: blog.php?info=added");
        }else{
            echo "error";
        }
        exit();
    }

    // Get post data based on id
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
        $sql = "select blog_id, username, title, content from blog_data 
        inner join users on user_id = id
        
        where blog_id = $id";
        $query = mysqli_query($conn, $sql);
    }

    // Delete a post
    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['id'];

        $sql = "DELETE FROM blog_data WHERE id = $id";
        mysqli_query($conn, $sql);

        header("Location: blog.php");
        exit();
    }

    // Update a post
    if(isset($_REQUEST['update'])){
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];

        $sql = "UPDATE blog_data SET title = '$title', content = '$content' WHERE id = $id";
        mysqli_query($conn, $sql);

        header("Location: blog.php");
        exit();
    }

?>