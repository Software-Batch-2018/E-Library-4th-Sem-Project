

<?php
include('../header.php');
include('../../auth/config.php');
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
    <link rel="stylesheet" href="/E-Library/components/css/style.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:200i,400&display=swap');

:root {
  --color-white: #f3f3f3;
  --color-darkblue: #1b1b32;
  --color-darkblue-alpha: rgba(27, 27, 50, 0.8);
  --color-green: #37af65;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.4;
  color: var(--color-white);
  margin: 0;
}

/* mobile friendly alternative to using background-attachment: fixed */
body::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 1;
  background: var(--color-darkblue);
  background-image: linear-gradient(
      115deg,
      rgba(58, 58, 158, 0.8),
      rgba(136, 136, 206, 0.7)
    ),
    url(https://cdn.freecodecamp.org/testable-projects-fcc/images/survey-form-background.jpeg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

h1 {
  font-weight: 400;
  line-height: 1.2;
}

p {
  font-size: 1.125rem;
}

h1,
p {
  margin-top: 0;
  margin-bottom: 0.5rem;
}

label {
  padding: 20px;
  margin-right:250px ;
  
  align-items: center;
  font-size: 1.125rem;
  margin-bottom: 0.5rem;
}

input,
button,
select,
textarea {
  margin: 0;
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
}

button {
  border: none;
}

.container {
  width: 100%;
  margin: 3.125rem auto 0 auto;
}

@media (min-width: 576px) {
  .container {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .container {
    max-width: 720px;
  }
}

.header {
  padding: 0 0.625rem;
  margin-bottom: 1.875rem;
}

.description {
  font-style: italic;
  font-weight: 200;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
}

.clue {
  margin-left: 0.25rem;
  font-size: 0.9rem;
  color: #e4e4e4;
}

.text-center {
  text-align: center;
}

/* form */

form {
  background: var(--color-darkblue-alpha);
  padding: 2.5rem 0.625rem;
  border-radius: 0.25rem;
  width: 60vw;
  margin: auto;
  margin-top: 50px;
  z-index: 1;
}

@media (min-width: 480px) {
  form {
    padding: 2.5rem;
  }
}

.form-group {
  margin: 0 auto 1.25rem auto;
  padding: 0.25rem;
}

.form-control {
  display: block;
  width: 100%;
  height: 2.375rem;
  padding: 0.375rem 0.75rem;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.input-radio,
.input-checkbox {
  display: inline-block;
  margin-right: 0.625rem;
  min-height: 1.25rem;
  min-width: 1.25rem;
}

.input-textarea {
  min-height: 120px;
  width: 100%;
  padding: 0.625rem;
  resize: vertical;
}

.submit-button {
  display: block;
  width: 100%;
  margin-top: 20px;
  height: 50px;
  padding: 0.75rem;
  background: var(--color-green);
  color: inherit;
  border-radius: 2px;
  cursor: pointer;
}
</style>
<title>Dashboard</title>
</head>
<body>
  <section id="one">
<form action="" method="POST" enctype="multipart/form-data">
  <div class="container">
  <h1 id="title" class="text-center">Add Subject</h1>
  <div style=" display:flex; width:413px;">
  <label>
    <?php
          $a = "SELECT * FROM classes";
          $num = mysqli_query($conn ,$a);
          if (mysqli_num_rows($num) > 0) {
            while($row = mysqli_fetch_array($num)){

                        $faculty = $row['class_name'];
                        $facultyid = $row['class_id'];

                        echo "<input type='checkbox' class='input-radio' name='chkl[]' value='$facultyid'>$faculty</input>";

                        /*$stuff = array($faculty);
                        foreach ($stuff as $value) {
                            //echo $value, "\n";
                            echo "<input type='checkbox' name='chkl[]' value='$facultyid'>$value</input><br />";
                            
                        }*/
            }
          }
      ?>
  </label>
  </div >
    <div class="form-group">
      <label id="email-label">Subject Name</label>
      <input
        type="text"
        name="subjectn"
        class="form-control"
        placeholder="Enter Subject"
        required
      />
      <br>
      <label id="email-label">Subject Detail</label>
      <input
        type="text"
        name="subjectd"
        class="form-control"
        placeholder="About Subject "
        required
      />
      <br>
      <label>Upload Image File:</label><br /> <input name="userImage"
            type="file" class="inputFile" />
        <button type="submit" value="Submit" class='submit-button' name='Submit'>Submit </button>
        </form>
    </div>

       
<?php  
//for add subject
     if(isset($_POST['Submit'])){
      if (count($_FILES) > 0) 
      {
        if (is_uploaded_file($_FILES['userImage']['tmp_name'])) 
        {
          $subName = $_POST['subjectn'];
          $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
          $sub_detail = $_POST['subjectd'];
          $sql = "INSERT INTO subjects (sub_name,image, sub_detail)
          VALUES('$subName','{$imgData}', '$sub_detail')";
          $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        }
       }
        
        //get lastet value from subject
        $query = "SELECT * FROM subjects where sub_id=(select max(sub_id) from subjects)";
        $ch = mysqli_query($conn ,$query);
        if (mysqli_num_rows($ch) > 0) {
            while($getss = mysqli_fetch_array($ch)){
                $sublastID = $getss['sub_id'];  
            }
        }

        //for choose faculty
        $checkbox1 = $_POST['chkl'] ;  

        if ($_POST["Submit" ]=="Submit")  {  
            for ($i=0; $i<sizeof ($checkbox1); $i++) {    
                $query = "INSERT INTO `class_sub` (`cs_id`, `class_id`, `sub_id`) VALUES (NULL, '".$checkbox1[$i]. "', '".$sublastID. "')";
                mysqli_query($conn, $query) or die(mysqli_error($conn));  
            }  
            echo "Record is inserted"; 
        }
    }
?> 
</section>
<?php include ('../footer.php')?>
</body>
</html>

