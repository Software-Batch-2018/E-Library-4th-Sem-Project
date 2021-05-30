<?php 
session_start();
session_destroy();
if (isset($_GET['redirectl'])) {
    if (isset($_GET['chapter_id']))
    {
        $url = $_GET['redirectl'].'&chapter_id='.$_GET['chapter_id'];
    }
    else
    {
        $url= $_GET['redirectl'];
    }
    header("Location: $url");
} else {
    header("Location: /E-library/index.php");
}
?>