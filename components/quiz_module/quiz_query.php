<?php
include ('../../auth/config.php');
if(!isset($_SESSION)){
  session_start();
}else{
  $email=$_SESSION['id'];
}

//add quiz
if(isset($_SESSION['role'])){
  if(@$_GET['q']== 'addquiz' && $_SESSION['role']== 'admin') {
    $name = $_POST['name'];
    $chapter_id = $_GET['ch_id'];

    $name= ucwords(strtolower($name));
    $total = $_POST['total'];
    $sahi = $_POST['right'];
    $wrong = $_POST['wrong'];
    $time = $_POST['time'];
    $desc = $_POST['desc'];
    $id=uniqid();
    $q3=mysqli_query($conn,"INSERT INTO quiz VALUES  ('$id','$chapter_id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc', NOW())");
    if($q3){
      header("location:admin_dashboard.php?q=4&step=2&eid=$id&n=$total");
    }
    else{
      echo "error";
    }
  }
}

//add question
if(isset($_SESSION['role'])){
  if(@$_GET['q']== 'addqns' && $_SESSION['role']== 'admin') {
    $n=@$_GET['n'];
    $eid=@$_GET['eid'];
    $ch=@$_GET['ch'];

    for($i=1;$i<=$n;$i++)
    {
      $qid=uniqid();
      $qns=$_POST['qns'.$i];
      $q3=mysqli_query($conn,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
      $oaid=uniqid();
      $obid=uniqid();
      $ocid=uniqid();
      $odid=uniqid();
      $a=$_POST[$i.'1'];
      $b=$_POST[$i.'2'];
      $c=$_POST[$i.'3'];
      $d=$_POST[$i.'4'];
      $qa=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
      $qb=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
      $qc=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
      $qd=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
      $e=$_POST['ans'.$i];
      switch($e)
      {
        case 'a':
          $ansid=$oaid;
          break;
        case 'b':
          $ansid=$obid;
          break;
        case 'c':
          $ansid=$ocid;
          break;
        case 'd':
          $ansid=$odid;
          break;
        default:
          $ansid=$oaid;
      }


      $qans=mysqli_query($conn,"INSERT INTO answer VALUES  ('$qid','$ansid')");

    }
    header("location: ../../index.php");
  }
}

//quiz start
if($_GET['q']== 'quiz' && $_GET['step']== 2) {
  $email = $_SESSION['id'];
  $eid=@$_GET['quiz_id'];
  $sn=@$_GET['n'];
  $total=@$_GET['t'];
  $ans=$_POST['ans'];
  $qid=@$_GET['qid'];
  $sub_id = $_GET['sub_id'];
  $chapter_id = $_GET['chapter_id'];
  $q=mysqli_query($conn,"SELECT * FROM answer WHERE qid='$qid' " );
  while($row=mysqli_fetch_array($q) )
  {
    $ansid=$row['ansid'];
  }
  if($ans == $ansid){
    $q=mysqli_query($conn,"SELECT * FROM quiz WHERE quiz_id='$eid' " );
    while($row=mysqli_fetch_array($q) )
    {
      $sahi=$row['sahi'];
    }
    if($sn == 1)
    {
      $q=mysqli_query($conn,"INSERT INTO history (id, quiz_id,score,level,sahi,wrong,date) VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
    }
    $q=mysqli_query($conn,"SELECT * FROM history WHERE quiz_id='$eid' AND id='$email' ")or die('Error115');
    while($row=mysqli_fetch_array($q) )
    {
      $s=$row['score'];
      $r=$row['sahi'];
    }
    $r++;
    $s=$s+$sahi;
    $q=mysqli_query($conn,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  id = '$email' AND quiz_id = '$eid'")or die('Error124');
  } 
  else
  {
    $q=mysqli_query($conn,"SELECT * FROM quiz WHERE quiz_id='$eid' " )or die('Error129');

    while($row=mysqli_fetch_array($q) ){
      $wrong=$row['wrong'];
    }
    if($sn == 1){
      $q=mysqli_query($conn,"INSERT INTO history (id, quiz_id,score,level,sahi,wrong,date) VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
    }
    $q=mysqli_query($conn,"SELECT * FROM history WHERE quiz_id='$eid' AND id='$email' " )or die('Error139');
    while($row=mysqli_fetch_array($q) ){
      $s=$row['score'];
      $w=$row['wrong'];
    }
    $w++;
    $s=$s-$wrong;
    $q=mysqli_query($conn,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  id = '$email' AND quiz_id = '$eid'")or die('Error147');
  }
  if($sn != $total){
    $sn++;
    header("location:../course-contents/view_content.php?sub_id=$sub_id&chapter_id=$chapter_id&q=quiz&step=2&quiz_id=$eid&n=$sn&t=$total")or die('Error152');
  }
  else if( $_SESSION['role']!= 'admin'){
    $q=mysqli_query($conn,"SELECT score FROM history WHERE quiz_id='$eid' AND id='$email'" )or die('Error156');
    while($row=mysqli_fetch_array($q) )
    {
      $s=$row['score'];
    }
    $q=mysqli_query($conn,"SELECT * FROM rank WHERE id='$email'" )or die('Error161');
    $rowcount=mysqli_num_rows($q);
    if($rowcount == 0)
    {
      $q2=mysqli_query($conn,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
    }
    else
    {
      while($row=mysqli_fetch_array($q) ){
        $sun=$row['score'];
      }
      $sun=$s+$sun;
      $q=mysqli_query($conn,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE id= '$email'")or die('Error174');
    }
    header("location:../course-contents/view_content.php?sub_id=$sub_id&chapter_id=$chapter_id&q=result&quiz_id=$eid");
  }
  else
  {
  header("location:../course-contents/view_content.php?sub_id=$sub_id&chapter_id=$chapter_id&q=result&quiz_id=$eid");
  }
}

//restart quiz
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
  $eid=@$_GET['eid'];
  $n=@$_GET['n'];
  $t=@$_GET['t'];
  $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
  while($row=mysqli_fetch_array($q) ){
    $s=$row['score'];
  }
  $q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
  $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
  while($row=mysqli_fetch_array($q) ){
    $sun=$row['score'];
  }
  $sun=$sun-$s;
  $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
  header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}


if(isset($_GET['ch_id'])){
  $chapter_id = $_GET['ch_id'];
  $sql = "SELECT chapter_name FROM chapters WHERE chapter_id = '$chapter_id'";
  $query = mysqli_query($conn, $sql);
  while($result = mysqli_fetch_array ($query)){
    $name = $result['chapter_name'];
           
  }

}




?>



