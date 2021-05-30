<?php include('./auth/config.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,800' rel='stylesheet' type='text/css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<link rel="stylesheet" href="./components/css/index.css">
<link rel="stylesheet" href="./components/css/pop.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="./components/css/index.js"></script>

<body>
<div class="smooth">
<?php include('./components/header.php') ?>
    <section id="one">
        <div class="content parallax">
            <div>
                <h1>E-Library</h1><svg class="title"><text x="0" y="40">E-Library</text>
                    <path d="M 0 66 50 61"></path>
                </svg>
                <p class="lead">
                E-Library is an E-Learning platform mostly focused for students which helps on curriculum 
references and also helps students on preparation of examinations. Here students can find every 
kind of learning materials about their interest of subjects and field. We believe that Knowledge 
and Experience are the two major factors that creates a knowledgeable person. E-Library also 
offers practice exercise, evaluation tests and a personalized learning dashboard that empower 
learners to study at their own pace in and outside of the classroom. 
                </p>
                <p class="lead">
                  Presented By : GROUP D - BE SOFTWARE(POKHARA UNIVERSITY)
                </p>
                <br>
                <br>
                <p class="lead">
                  Scroll Down To Continue 
                </p>
            </div>
        </div>
    </section>
    <section style="background: transparent;"></section>
    <section id="two">
    <?php
      $a = "SELECT l_name,id FROM levels";
      $num1 = mysqli_query($conn ,$a);
      if (mysqli_num_rows($num1) > 0) 
      {
        while($row = mysqli_fetch_array($num1))
        {
          $lev = $row['l_name'];
          $lid = $row['id'];
          echo '<div class="level"><h2><span>'.$lev.'</span></h2>';
          echo'<div class="blocks">';
          $a = "select class_id , class_name from levels l inner JOIN classes c on l.id = c.id where l.id = $lid";
          $num2 = mysqli_query($conn ,$a);
          if (mysqli_num_rows($num2) > 0) 
          {
            while($row = mysqli_fetch_array($num2))
            {
              $lev = $row['class_name'];
              $lid = $row['class_id'];       
              echo'<a href="#popup'.$lid.'"><div class="block"><p> '.$lev.'</p>
              </div></a>
              <div class="overlay" id="popup'.$lid.'">
              <div class="popup">
              <div class = "head"><h2>'.$lev.'</h2></div>
		          <a class="close" href="#">&times;</a>
              <div class="content">';
              $a = "select sub_name, s.sub_id, image , sub_detail from levels l inner JOIN classes c
              on l.id = c.id inner join class_sub cs 
              on cs.class_id = c.class_id inner JOIN subjects s 
              on cs.sub_id = s.sub_id where cs.class_id = $lid";
              $num3 = mysqli_query($conn ,$a);
              if (mysqli_num_rows($num3) > 0) 
              {
                while($row = mysqli_fetch_array($num3))
                {
                  $lev = $row['sub_name'];
                  $lid = $row['sub_id'];
                  $img = $row['image'];
                  $det = $row['sub_detail'];
                  echo '
                      <div class="cols">
                      <div class="col" ontouchstart="this.classList.toggle("hover");">
                      <a href="/E-Library/components/course-contents/view_content.php?sub_id='.$lid.'">
                        <div class="container">
                          <div class="back">
                            <div class="inner">
                              <h1>'.$lev.'</h1>
                            </div>
                          </div>
                          <div class="front" style="background-image: url(data:image/jpeg;base64,'.base64_encode( $img ).') ; background-size:cover ; ">
                              <div class="head"><p style="max-height:30px ;font-size:17px ; display:flex"><strong>'.$lev.'</strong></p></div>
                              <div style="min-height:8px"></div>
                          </div>
                      </div>
                    </a>
                    </div>
                    </div>
                  '; 
                }
              }echo'</div>
              </div>
              </div>';
            }echo'</div></a>'; 
          } echo'</div>';      
        }
      }
    ?>
    </section>
    <?php include('./components/footer.php') ?>
</div>
</body>
</html>
