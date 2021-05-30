<?php
    include('C:\xampp\htdocs\E-Library\auth\config.php');
    if(isset($_GET['chapter_id'])&& isset($_GET['sub_id'])){
        $sub_id = $_GET['sub_id'];
        $chapter_id = $_GET['chapter_id'];
        $sql = "SELECT * FROM chapters WHERE sub_id = '$sub_id'";
        $query = mysqli_query($conn, $sql);
        $content = "SELECT * FROM chapters WHERE sub_id = '$sub_id' AND chapter_id='$chapter_id'";
        $query2 = mysqli_query($conn, $content);

    }
    elseif(isset($_GET['sub_id'])){
        $sub_id = $_GET['sub_id'];
        $sql = "SELECT * FROM chapters WHERE sub_id = '$sub_id'";
        $query = mysqli_query($conn, $sql);
        $content = "SELECT * FROM chapters WHERE sub_id = '$sub_id' LIMIT 1";
        $query2 = mysqli_query($conn, $content);
        while($result = mysqli_fetch_array ($query2)){
            $name = $result['chapter_id'];
            header("Location: view_content.php?sub_id=$sub_id&chapter_id=$name");
        }
    }
    else{
        $sql = "SELECT * FROM chapters WHERE sub_id = 3";
        $query = mysqli_query($conn, $sql);
        $content = "SELECT * FROM chapters WHERE sub_id = 3 AND chapter_id = 2 ";
        $query2 = mysqli_query($conn, $content);
    }

    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['chapter_id'];
        $sub_id = $_REQUEST['sub_id'];
        $sql = "DELETE FROM chapters where chapter_id='$id' ";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: view_content.php?sub_id=$sub_id");
        }
        else{
            echo mysqli_error($conn);
        }

    }
?>