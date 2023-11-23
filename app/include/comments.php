<?php 

// require_once SITE_ROOT.'/app/controllers/commentaries.php';
?>

<div class="col-md-12 col-12 comments">

        <div class="mb-12 col-12 col-md-12 err">
          <!-- вывод массива с ошибками -->
          <?php require_once 'app/helps/errorInfo.php'; ?>
        </div>

        <?php if(count($comments)>0){ ?>

<div class="row all-comments">
<h3 class="col-12"> Комментарии к записи</h3>

<?php foreach($comments as $comment){ ?>

<div class="one-comment col-12"> 
<span><i class="fa-solid fa-envelope"> </i> <?=$comment['email']?></span>
<span><i class="fa-solid fa-calendar-days"> </i> <?=$comment['create_date']?></span>
<div class="col-12 text"><?=$comment['comment']?></div>
</div>

</div>

<?php } ?>

<?php } ?>

   <h3>Оставить комментарии </h3>
<form action="<? BASE_URL."single.php?post=$page"?>" method="post">
    <input type="hidden" name="page" value="<?=$page?>">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label" value="">Email address</label>
  <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Напишите ваш отзыв</label>
  <textarea name ='comment' class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
</div>
<div class="col-12">
    <button type='submit' name='goComment' class='btn btn-primary' >Отправить коментарий</button>
</div>
</form>
</div>




