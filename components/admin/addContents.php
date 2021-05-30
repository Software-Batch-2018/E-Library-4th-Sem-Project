<?php
ob_start();
include('../header.php');
include('C:\xampp\htdocs\E-Library\auth\config.php');
include('C:\xampp\htdocs\E-Library\auth\config.php');
if (!isset($_SESSION['username']) || ($_SESSION['role']!='admin')) {
    header("Location: /E-Library/index.php");
}

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
    <section id="one">
<form action="" method="POST">
  <div class="container">
    <?php
    
    if (!isset($_GET['class']) && !isset($_GET['sub'])) {
    ?>
        <h1 id="title" class="text-center">Select Class</h1>
        <div style=" display:flex;">
            <label>
        <?php
          $a = "SELECT * FROM classes";
          $num = mysqli_query($conn ,$a);
          if (mysqli_num_rows($num) > 0) {
            while($row = mysqli_fetch_array($num)){
                        $faculty = $row['class_name'];
                        $facultyid = $row['class_id'];
                        echo "<br><input type='checkbox' class='input-radio' name='chk' value='$facultyid'>$faculty</input>";
                        /*$stuff = array($faculty);
                        foreach ($stuff as $value) {
                            //echo $value, "\n";
                            echo "<input type='checkbox' name='chkl[]' value='$facultyid'>$value</input><br />";          
                        }*/
            }?>
            </label>
            </div >
                  <button type="submit" value="Submit" class='submit-button' name='Submit'>Submit </button>
         <?php
            
          }
        }
        elseif (isset($_GET['class'])){
        ?>
            <h1 id="title" class="text-center">Select Subject</h1>
            <div style=" display:flex;">
                <label>
        <?php
            $id = $_GET['class'];
            $a = "select s.sub_id, sub_name from classes l inner JOIN class_sub cs on l.class_id = cs.class_id INNER JOIN subjects s ON cs.sub_id = s.sub_id WHERE l.class_id = $id";
            $num = mysqli_query($conn ,$a);
                if (mysqli_num_rows($num) > 0) {
                    while($row = mysqli_fetch_array($num)){
                                $subject = $row['sub_name'];
                                $subjectId = $row['sub_id'];
                                echo "<br><input type='radio' class='input-radio' name='chk' value='$subjectId'>$subject</input>";
                                /*$stuff = array($faculty);
                                foreach ($stuff as $value) {
                                    //echo $value, "\n";
                                    echo "<input type='checkbox' name='chkl[]' value='$facultyid'>$value</input><br />";
                                    
                                }*/           
                    }?>
                    </label>
                    </div >
                          <button type="submit" value="Submit" class='submit-button' name='Submit-sub'>Submit </button>
                 <?php
                }
        }
        elseif(isset($_GET['sub'])){
            $name = $_GET['name'];
            echo "<h1 id='title' class='text-center'>$name</h1>";

        ?>
        <?php $id = $_GET['sub']; ?>

            <form action="" method="POST" style="width: 60vw  !important;">
                <input type="hidden" id="custId" name="sub_id" value=<?php echo($id);?>>
                <label for="basic-url" class="form-label text-white">Chapter Name</label>
                <div class="input-group mb-3 mt-3">
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="name" />
                </div>


                <label for="basic-url" class="form-label text-white">Chapter Detail</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="detail" />
                </div>

                <label for="basic-url" class="form-label text-white">Contents</label>
                <div class="input-group">
                    <textarea name="content" id="editor" cols="12">
                        &lt;p&gt;This is some sample content.&lt;/p&gt;
                    </textarea>
                </div>
                <br>
                <button type="submit" value="Submit" class='submit-button' name='Submit-content'>Submit </button>
            </form>
        
        <?php } ?>

</form>

       
<?php  
     if(isset($_POST['Submit'])){
         $checkbox = $_POST['chk'];
         header("Location: addContents.php?class=$checkbox");
    }
    if(isset($_POST['Submit-sub'])){
        $id = $_POST['chk'];
        $sql = "Select sub_name from subjects where sub_id = $id";
        $subName = mysqli_query($conn ,$sql);
        $row = mysqli_fetch_array($subName);
        $subName = $row['sub_name'];

        header("Location: addContents.php?sub=$id&name=$subName");
   }
   if(isset($_POST['Submit-content'])){
       $id = $_POST['sub_id'];
       $name = $_POST['name'];
       $detail = $_POST['detail'];
       $content = $_POST['content'];
       $final_content = mysqli_real_escape_string($conn,$content);
       $result = mysqli_query($conn, "insert into chapters (`sub_id`, `chapter_name`, `chapter_detail`, `contents`) values ('$id', '$name', '$detail', '$final_content')");
       if ($result) {
           header("Location: /E-Library/components/course-contents/view_content.php?sub_id=$id");

       } else {
           echo $content;
        echo("Error description: " . mysqli_error($conn));
    }
    }
?> 
</section>
<?php include ('../footer.php') ?>
<script>
    	initSample();
</script>
</body>
</html>

