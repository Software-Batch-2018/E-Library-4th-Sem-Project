<?php
  include('course_query.php');
  $array = ['One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve'];
  $count = 0;
?>

<div class="accordion accordion-flush chapters" id="accordionFlushExample">
        <?php foreach($query as $q){  ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $array[$count]; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $array[$count]; ?>">
                <?php echo $q['chapter_name']?>
              </button>
            </h2>
            <div id="flush-collapse<?php echo $array[$count]; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $array[$count]; ?>" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <?php 
                  $content = htmlspecialchars($q['chapter_detail']); 
                  echo $content
                ?> 
                <a href="/E-Library/components/course-contents/view_content.php?sub_id=<?php echo $q['sub_id']?>&chapter_id=<?php echo $q['chapter_id']?>">Read More... </a>
              </div>
            </div>
          </div>
          <?php $count+=1; 
        }?>
</div>