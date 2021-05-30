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
    
	.course {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	display: flex;
	max-width: 28%;
	margin: 20px;
	overflow: hidden;
	width: 700px;
}

.course h6 {
	opacity: 0.6;
	margin: 0;
	letter-spacing: 1px;
	text-transform: uppercase;
}

.course h2 {
	letter-spacing: 1px;
	margin: 10px 0;
}

.course-preview {
	background-color: #2A265F;
	color: #fff;
	padding: 30px;
	max-width: 250px;
}

.course-preview a {
	color: #fff;
	display: inline-block;
	font-size: 12px;
	opacity: 0.6;
	margin-top: 30px;
	text-decoration: none;
}

.course-info {
	padding: 30px;
	position: relative;
	width: 100%;
}

.progress-container {
	position: absolute;
	top: 30px;
	right: 30px;
	text-align: right;
	width: 150px;
}

.progress {
	background-color: #ddd;
	border-radius: 3px;
	height: 5px;
	width: 100%;
}

.progress::after {
	border-radius: 3px;
	background-color: #2A265F;
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	height: 5px;
	width: 66%;
}

.progress-text {
	font-size: 10px;
	opacity: 0.6;
	letter-spacing: 1px;
}

.btn {
	background-color: #2A265F;
	border: 0;
	border-radius: 50px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	color: #fff;
	font-size: 16px;
	padding: 12px 25px;
	position: absolute;
	bottom: 30px;
	right: 30px;
	letter-spacing: 1px;
}

</style>


    <title>Dashboard</title>
</head>
<body>
<?php
include('.././header.php');
include('../../auth/config.php');
if (!isset($_SESSION['username']) || ($_SESSION['role']!='admin')) {
    header("Location: /E-Library/index.php");
}
?>
<div id="one" style="min-height: 80vmin;">
<div class="courses-container">
	<div class="course">
		<div class="course-preview">
			<h2>Add Subjects</h2>
		</div>
		<div class="course-info">

			<a href="addsubject.php">
			<button class="btn">Continue</button>
            </a>
		</div>
	</div>
</div>
<div class="courses-container">
	<div class="course">
		<div class="course-preview">
			<h2>Add Chapters</h2>
		</div>
		<div class="course-info">

			<a href="addContents.php">
			<button class="btn">Continue</button>
            </a>
		</div>
	</div>
</div>

</div>
<?php include ('../footer.php')?>


</body>
</html>


