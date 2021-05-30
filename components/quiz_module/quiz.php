<head>
	<style>
		table {
		border-collapse: collapse;
		width: 100%;
		}

		th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
		}

		tr:hover {
			background-color:#f5f5f5;
		}
	</style>
</head>
<body>
	<?php
			if(isset($_GET['q']) && $_GET['q']=='result'){
				if(@$_GET['q']== 'result' && @$_GET['quiz_id']) 
				{
					$email = $_SESSION['id'];
					$eid=@$_GET['quiz_id'];
					$q=mysqli_query($conn,"SELECT * FROM history WHERE quiz_id='$eid' AND id='$email' ORDER BY history_id DESC LIMIT 1" )or die('Error157');
					echo  '<div class="panel">
					<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';
		
					while($row=mysqli_fetch_array($q) )
					{
						$s=$row['score'];
						$w=$row['wrong'];
						$r=$row['sahi'];
						$qa=$row['level'];
						echo '<tr><td>Total Questions</td><td>'.$qa.'</td></tr>
							<tr><td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td style="color:green;">'.$r.'</td></tr> 
							<tr><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td style="color:red;">'.$w.'</td></tr>
							<tr><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
					}
					echo '</table></div>';
				}
			}

			if(isset($_GET['q']) && $_GET['q']=='quiz'){
			$sub_id = $_GET['sub_id'];
			$chapter_id = $_GET['chapter_id'];
			$sql = "SELECT quiz_id, total FROM quiz WHERE chapter_id='$chapter_id'";
			$query = mysqli_query($conn, $sql);
			while($result = mysqli_fetch_array ($query)){
			  $eid = $result['quiz_id'];
			  $total = $result['total'];		 
			}
			$sn=$_GET['n'];
			echo("
			<span id='countdown' class='timer'></span>
			<script>
			var seconds = 60;
				function secondPassed() {
				var minutes = Math.round((seconds - 30)/60);
				var remainingSeconds = seconds % 60;
				if (remainingSeconds < 10) {
					remainingSeconds = '0' + remainingSeconds; 
				}
				document.getElementById('countdown').innerHTML = minutes + ':' +    remainingSeconds;
				if (seconds <= 10) {
					clearInterval(countdownTimer);
					document.getElementById('countdown').innerHTML = 'Buzz Buzz';
				} else {    
					seconds--;
				}
				}
			var countdownTimer = setInterval('secondPassed()', 1000);
			</script>
			");


			$q=mysqli_query($conn,"SELECT * FROM questions WHERE quiz_id='$eid' AND sn='$sn' " );
			echo '<div class="panel" style="margin:5%">';
			while($row=mysqli_fetch_array($q) )
			{
			$qns=$row['qns'];
			$qid=$row['qid'];
			echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
			}
			$q=mysqli_query($conn,"SELECT * FROM options WHERE qid='$qid' " );
			echo '<form action="../quiz_module/quiz_query.php?sub_id='.$sub_id.'&chapter_id='.$chapter_id.'&q=quiz&step=2&quiz_id='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
			<br />';

			while($row=mysqli_fetch_array($q) )
			{
			$option=$row['option'];
			$optionid=$row['optionid'];
			echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
			}
			echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
			//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
		}
		



	
		if($_GET['sub_id'] && $_GET['chapter_id'] && !isset($_GET['q'])){
			include ('../../auth/config.php');
			$sub_id = $_GET['sub_id'];
			$ch_id = $_GET['chapter_id'];
			$result = mysqli_query($conn,"SELECT * FROM quiz WHERE chapter_id='$ch_id' ORDER BY date DESC") or die('Error');
			$url = "http://";   
			// Append the host(domain name, ip) to the URL.   
			$url.= $_SERVER['HTTP_HOST'];   
			// Append the requested resource location to the URL   
			$url.= $_SERVER['REQUEST_URI'];
			$query = parse_url($url, PHP_URL_QUERY);
			// Returns a string if the URL has parameters or NULL if not
			if(!isset($_GET['q'])){
				$url .= '&q=quiz&n=1';
			}
			
			if($result->num_rows>0){
	?>
				<table>
					<tr>
						<th>Topic</th>
						<th>Total Question</th>
						<th>Marks</th>
						<th>Time Limit</th>
						<th></th>
					</tr>
					<?php
						while($row = mysqli_fetch_array($result)) {
						$title = $row['title'];
						$total = $row['total'];
						$sahi = $row['sahi'];
						$time = $row['time'];
						$eid = $row['chapter_id'];

					?>
					<tr>
						<td><?php echo $title ?></td>
						<td><?php echo $total ?></td>
						<td><?php echo $sahi ?></td>
						<td><?php echo $time ?></td>
						<td> <a href="<?php echo $url ?>"><button type="button" class="btn btn-info">Start Quiz</button></a>
					</tr>
					<?php	
						}
			}else{
				echo '<h1>No quiz available for this chapter!</h1>';
			}
		}?>
		</table><?php ?>
		<?php

		?>
</body>