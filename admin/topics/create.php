<?php 
session_start();

  require_once '../../path.php'; 
  require_once '../../app/controllers/topics.php'; 
  // $name='';
  // $description='';
// tt($name);
//   exit();
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
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <title>My blog</title>
</head>

<body>

<!-- HEADER -->
<?php 
  require_once '../../app/include/header-admin.php'; 
  ?>
  <!-- END HEADER -->
  
<div class="container">

<!-- sidebar start -->
<?php require_once '../../app/include/sidebar-admin.php';?>
<!-- sidebar end -->

<div class="posts col-8">
<div class="button row">
<a href="<?= BASE_URL . "admin/topics/create.php" ?>" class="col-2 btn btn-success">Создать</a>
<span class="col-1"></span>
<a href="<?= BASE_URL . "admin/topics/index.php" ?>" class="col-3 btn btn-warning">Изменить</a>

</div>

<div class="row title-table">
  <h2>Создать категорию</h2>
</div>
<div class="row add-post">
<div class="mb-12 col-12 col-md-12 err"><p><?=$errMsg;?></p></div>
 <form action="create.php" method='post'>
    <div class="col">
        <input type="text" name ='name' value="<?=$name;?>" class="form-control" placeholder="Имя категории" aria-label="Имя категории">
    </div>
    <div class="col">
  <label for="content" class="form-label">Описание категории</label>
  <textarea class="form-control" name ='description' id="content" rows="6"><?=$description;?></textarea>
</div>
<div class="col">
    <button class="btn btn-primary" name ='topic-create' type="submit">Создать категорию</button>
  </div>

 </form>
</div>
</div>
</div>
</div>
 
   

  

<!-- FOOTER  -->

<?php 
  require_once '../../app/include/footer.php'; 
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