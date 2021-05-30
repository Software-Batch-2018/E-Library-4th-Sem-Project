<?php 

session_start();

?>
<header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="/E-Library/components/css/headerfooter.css">
        <h3><a href="/E-Library/index.php"><img src="/E-Library/components/logo.png" alt="E-Library"><img></a></h3>
        <ul>
            <li ><a style="text-decoration: none;"  href="/E-Library/index.php">Home</a></li>
            <li><a style="text-decoration: none;" href="/E-Library/components/blog/blog.php">Blog</a></li>
            <li><a style="text-decoration: none;" href="/E-Library/about.php">About</a></li>
            <?php
			$fullUrlh = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    		if(isset($_SESSION['username']))
    		{
          	if(isset($_SESSION['role']))
				{
					if($_SESSION['role'] == 'admin')
					{
   			    		echo '<li><a style="text-decoration: none;" href="/E-Library/components/admin/admin.php">Dashboard</a></li>';
						echo '<li><a style="text-decoration: none;" href="/E-Library/auth/logout.php?redirectl='.$fullUrlh.'">Logout</a></li>';
  			  		}
					else
					{
						echo '<li><a style="text-decoration: none;" href="/E-Library/auth/logout.php?redirectl='.$fullUrlh.'">Logout</a></li>';
					}
			   }
   			}
   			else
   			{
          echo '<li><a style="text-decoration: none;" href="/E-Library/auth/login.php?redirectl='.$fullUrlh.'">LogIn</a></li>';
			}
			?>
        </ul>
    </header>
