<?php
    ob_start();
    include ('../header.php');
    include ('../../auth/config.php');

    if ($_SESSION['role'] !='admin')
    {
        header("Location: index.php");
        die();
    }
    $chapter_id = $_GET['chapter_id'];
    $sql = "SELECT * FROM chapters where chapter_id='$chapter_id'";
    $query = mysqli_query($conn, $sql);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/E-Library/components/css/index.css">
    <!-- Font Awesome -->
    <script src="./ckeditor/ckeditor.js"></script>
    <script src="./ckeditor/config.js"></script>
    <script src="./ckeditor/build-config.js"></script>
    <script src="./ckeditor/samples/js/sample.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet"/>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/admin.css">


<title>Dashboard</title>
</head>
<body>
<?php foreach($query as $q){ ?>
    <form action="" method="POST" style="width: 60vw  !important;">
        <input type="hidden" name="chapter_id" value=<?php echo $_GET['chapter_id'];?>>
        <label for="basic-url" class="form-label text-white">Chapter Name</label>
        <div class="input-group mb-3 mt-3">
            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="name" value="<?php echo $q['chapter_name']?>"/>
        </div>


        <label for="basic-url" class="form-label text-white">Chapter Detail</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="detail" value="<?php echo $q['chapter_detail']?>"/>
        </div>

        <label for="basic-url" class="form-label text-white">Contents</label>
        <div class="input-group">
            <textarea name="content" id="editor" cols="12">
                <?php echo $q['contents']?>
            </textarea>
        </div>
        <br>
        <button type="submit" value="Submit" class='submit-button' name='Submit-content'>Submit </button>
    </form>
<?php } ?>


<script>
    	initSample();
</script>

<?php
   
   if(isset($_POST['Submit-content'])){
    $id = $_POST['chapter_id'];
    $sub_id = $_GET['sub_id'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $content = $_POST['content'];
    $final_content = mysqli_real_escape_string($conn,$content);
    $sql = "UPDATE chapters SET chapter_name = '$name', chapter_detail = '$detail', contents='$content' WHERE chapter_id = '$id'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../../components/course-contents/view_content.php?chapter_id=$id&sub_id=$sub_id");
   }
?>

</body>
</html>
        
