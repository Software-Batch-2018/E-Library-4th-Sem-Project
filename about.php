
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
    <section id="one" style="min-height: 80vmin;">
        <div class="content parallax" style="position: absolute; top:30px;left:10px">
            <div>
                <h1>ABOUT-US</h1><svg class="title"><text x="0" y="40">ABOUT-US</text>
                    <path d="M 0 66 50 61"></path>
                </svg>
                <p style ="font-size:30px" class="lead">
                This Project is completed in joint collaboration of:
                <ul style="font-size: 20px;">
                <li>Milan Pokhrel</li>
                <li>Kusal Lamsal</li>
                <li>Sagar Gurung</li>
                <li>Bibek Bhujel</li>
                <li>Dipesh Subedi</li>
                </ul>
                </p>
            </div>
        </div>
    </section>
    <?php include('./components/footer.php') ?>
</div>
</body>
</html>