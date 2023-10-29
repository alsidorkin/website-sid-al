<?php 
session_start();

  require_once 'path.php'; 
  //  require_once 'app/database/db.php';
  require_once 'app/controllers/topics.php';        
  require_once 'app/controllers/posts.php';  
  
  // tt($postsAdm);
  //    exit();
  ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <!-- font google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
  <!-- custom styling -->
  <link rel="stylesheet" href="assets/css/style.css">
  <title>My blog</title>
</head>

<body>

<!-- HEADER -->
<?php 
  require_once 'app/include/header.php'; 
  ?>
  <!-- END HEADER -->
  <!-- блок карусели start-->

  <div class="container">
    <div class="row">
      <h2 class="slider-title">Топ публикации </h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/images\foto_bee\bee3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption-hack carousel-caption d-none d-md-block">
            <h5><a href="/"> First slide label</a></h5>
          </div>
        </div>

        <div class="carousel-item">
          <img src="assets/images\foto_bee\bee5.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption-hack carousel-caption d-none d-md-block">
            <h5><a href="/">Second slide label</a></h5>
          </div>
        </div>

        <div class="carousel-item">
          <img src="assets/images\foto_bee\bee6.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption-hack carousel-caption d-none d-md-block">
            <h5><a href="/">Third slide label</a></h5>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <!-- блок карусели end  -->

 
   

  <!-- блок main start  -->
  <div class="container">
    <div class="content row">

     
        
      <!-- main content -->
<div class="main-conent col-md-9 col-12">

        <h2>Последние публикации</h2>
        <?php
foreach($postsAdm as $post){
  ?><?//=  ROOT_PATH. "\assets\images\posts\\" .$post['img'];?>
        <div class="post row">
          <div class="img col-12 col-md-4">
          <img src="<?php //echo ROOT_PATH. "\assets\images\posts\bee10.jpg" ;?>" alt="" class="img-thumbnail">
          </div>
          <div class="post_text col-12 col-md-8">
            <h3>
              <a href="#"><?=$post['title']?></a>
            </h3>
            <i class="far fa-user"><?=$post['username']?></i>
            <i class="far fa-calendar "><?=$post['created_data']?></i>
            <p class="preview-text"><?=$post['content']?></p>
          </div>
        </div>
<?php }?>

        



  
          
        </div>



</div>
<!-- блок main content end   -->


 <!-- sidebar content -->
 <div class="sidebar col-md-3 col-12 ">

  <div class="section search">
    <h3>Search</h3>
    <form action="index.php" method="post">
      <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
    </form>
  </div>
  
  
  <div class="section topics">
    <h3>Категории</h3>
  
    <ul>

    <?php
    foreach($topics as $key=> $topic){ ?>
      <li><a href="#"> <?= $topic['name'] ;?></a></li>
     <?php  }?>
    </ul>
  
  </div>
  
  
        </div>
  <!-- sidebar content end-->

 
    </div>

  </div>

  <!-- блок main end  -->


<!-- FOOTER  -->

<?php 
  require_once 'app/include/footer.php'; 
  ?>
<!-- FOOTER end -->



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
  crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script> -->

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  <!-- font avesom -->
  <script src="https://kit.fontawesome.com/1d9689321f.js" crossorigin="anonymous"></script>
</body>

</html>