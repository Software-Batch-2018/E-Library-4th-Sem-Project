<?php
  include('course_query.php');
?>
<head>
    <style>
        .tabs ul li {
            box-sizing: border-box !important;
            flex: auto !important;
            width: auto !important;
            padding: inherit !important;
            text-align: inherit !important;
        }
        th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd !important;
		}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<?php foreach($query2 as $q){  ?>
          <div class="content-header">
              <div class="h2" style="text-decoration:underline;"><?php echo $q['chapter_name'] ?></div>
          </div>
          <?php
            if(isset($_SESSION['role'])&& $_SESSION['role']=='admin'){?>
                <div class="edit-delete">
                    <a href="/E-Library/components/admin/edit_contents.php?sub_id=<?php echo $_GET['sub_id']?>&chapter_id=<?php echo $_GET['chapter_id']?>" style="margin-right: 20px;"><button type="button" class="btn btn-info btn-sm ml-2">Edit</button></a>
                    <form method='POST'>
                    <input type='text' hidden value='<?php echo $_GET['chapter_id']?>' name='chapter_id'>
                    <input type='text' hidden value='<?php echo $_GET['sub_id']?>' name='sub_id'>
                    <button class='btn btn-danger btn-sm ml-2' name='delete'>Delete</button>
                    </form>
                </div><br>
                <?php }
            ?>
          <div class="content">
            <?php
              $content = htmlspecialchars_decode($q['contents']);
              echo nl2br($content) ?>
          </div>
<?php } ?>