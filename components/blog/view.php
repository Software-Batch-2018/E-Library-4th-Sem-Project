<?php
  include ('../../auth/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Blog</title>
</head>
<style>
    button,
button::after {
  -webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
  -o-transition: all 0.3s;
	transition: all 0.3s;
}

button {
  background: none;
  border: 3px solid #fff;
  border-radius: 5px;
  color: #fff;
  display: block;
  font-size: 15px;
  font-weight: bold;
  margin: 1em auto;
  padding: 0.5em 2em;
  position: relative;
  text-transform: uppercase;
}

button::before,
button::after {
  background: #fff;
  content: '';
  position: absolute;
  z-index: -1;
}

button:hover {
  color: #4a5683;
}

.bton::after {
  height: 100%;
  left: 0;
  top: 0;
  width: 0;
}

.bton:hover:after {
  width: 100%;
}
</style>
<body>
<?php
    include ('../header.php');
    include ('logic.php');
?>
<section id="one" style="min-height:75vmin">
   <div class="container mt-5" style="position: relative; top:0 ; border-style:solid">

        <?php foreach($query as $q){?>
            <div class="bg-transparent p-5 rounded-lg text-white text-center" >
            <div style="position:absolute;top:0;right:0;left:0; background-color:#4a5683 ; border-radius:6px">
                <h1>
                    <?php 
                        $title = htmlspecialchars($q['title']);
                        echo nl2br($title);
                    ?>
                </h1>
                <h8 style="position: absolute; right: 2%;">Blog By: <?php echo $q['username'] ?></h8>
                  <?php

                  ?>
                </h3>
            
            <?php
            
                if(isset($_SESSION['role']))
                {
                    if($_SESSION['role'] == 'admin')
                    {
                ?>

                <div class='d-flex mt-2 justify-content-center align-items-center'>
                    <a href='edit.php?id=<?php echo $q['blog_id']?>' class='btn btn-light btn-sm' name='edit'>Edit</a>
                    <form method='POST'>
                        <input type='text' hidden value='<?php echo $q['id']?>' name='id'>
                        <button class='btn btn-danger btn-sm ml-2' name='delete'>Delete</button>
                    </form>
                </div>

                <?php
                    }
                }
            ?>
            </div>
            </div>

            <p style="font-size: 14px;" class="mt-5 border-left border-dark pl-3">
                <?php 
                    $content = htmlspecialchars($q['content']);
                    echo nl2br($content);
                ?></p>
        <?php } ?>    

        <a style="text-decoration: none;" href="blog.php"> <button class="bton">Go Home</button></a>
   </div>
</section>
<?php include ('../footer.php')?>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>