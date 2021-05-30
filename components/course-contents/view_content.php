
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>View</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
        TeX: {
    //    equationNumbers: {autoNumber: "AMS"},
          extensions: ["begingroup.js"],
          noErrors: {disabled: true}
        },
        showProcessingMessages: false,
        tex2jax: { inlineMath: [['$','$'],['\\(','\\)']] }
      });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  
  <script>
      $(document).ready(function(){
        if(localStorage.selected) {
          $('#' + localStorage.selected ).attr('checked', true);
        }
        $('.inputabs').click(function(){
          localStorage.setItem("selected", this.id);
        });
      });

  </script>
    <script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"></script>
    <link rel="stylesheet" href="../css/view_content.css">

</head>
<body>
<?php
$fullUrlc = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  include ('../headeremg.php');
  include ('course_query.php');
  $array = ['One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve'];
  $count = 0;
?>

<section id="one" style="min-height: 78vmin;">
<?php
  $sub_id = $_GET['sub_id'];
  $sql = "SELECT sub_name FROM subjects WHERE sub_id = '$sub_id'";
  $query = mysqli_query($conn, $sql);
  while($result = mysqli_fetch_array ($query)){
    $name = $result['sub_name'];    
  }
?>
<h1 style="font-size: 30px ; padding:10px"><?php echo $name ?> </h1>
<div class="container">
  
<div class="chapter">
    <?php
        include ('course_chapter.php');
    ?>
</div>


<div class="tabs">
  
  <input type="radio" id="tab1" class="inputabs" name="tab-control" checked>
  <input type="radio" id="tab2" class="inputabs" name="tab-control">
  <ul>
    <li title="View"><label for="tab1" role="button"><svg viewBox="0 0 24 24"><path d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z"/>
    </svg><br><span>Notes</span></label></li>
    <li title="Test Quiz"><label for="tab2" role="button"><svg viewBox="0 0 24 24"><path d="M2,10.96C1.5,10.68 1.35,10.07 1.63,9.59L3.13,7C3.24,6.8 3.41,6.66 3.6,6.58L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.66,6.72 20.82,6.88 20.91,7.08L22.36,9.6C22.64,10.08 22.47,10.69 22,10.96L21,11.54V16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V10.96C2.7,11.13 2.32,11.14 2,10.96M12,4.15V4.15L12,10.85V10.85L17.96,7.5L12,4.15M5,15.91L11,19.29V12.58L5,9.21V15.91M19,15.91V12.69L14,15.59C13.67,15.77 13.3,15.76 13,15.6V19.29L19,15.91M13.85,13.36L20.13,9.73L19.55,8.72L13.27,12.35L13.85,13.36Z" />
    </svg><br><span>Test Quiz</span></label></li>
  </ul>
  
  <div class="content">
    <section>
      <?php
        include('chapter_content.php')
      ?>
    </section>

    <section>
    <?php if(isset($_SESSION['role'])){
        if($_SESSION['role']== 'admin'){?>
          <li><a href="../quiz_module/admin_dashboard.php?q=4&ch_id=<?php echo $_GET['chapter_id']; ?>">Add Quiz</a></li>
    <?php }elseif($_SESSION['role']=='user'){
            include ('../quiz_module/quiz.php');
    }
  }
  if(!isset($_SESSION['role'])){ ?>
        <h1>Login to acess quiz</h1><br>
        <div class="login-btn" style="text-align: center;">
    		  <a href="/E-Library/auth/login.php?redirectl=<?php echo $fullUrlc;?>"><button type="button" class="btn btn-info">Login</button></a>
        </div>
  <?php 
  }
    ?>

    
    </section>
  </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script>
  hljs.highlightAll();
</script>
</section>
</body>
</html>
