<?php
session_start();

require_once '../../path.php';
require_once '../../app/controllers/posts.php';
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
    <?php require_once '../../app/include/sidebar-admin.php'; ?>
    <!-- sidebar end -->

    <div class="posts col-8">
      <div class="row title-table">
        <h2>Обновление записи</h2>
      </div>
      <div class="row add-post">
        <div class="mb-12 col-12 col-md-12 err">

          <!-- вывод массива с ошибками -->
          <?php require_once '../../app/helps/errorInfo.php'; ?>

        </div>
        <form action="edit.php" method='post' enctype="multipart/form-data">
          <div class="col mb-4">
            <input name='title' value='<?= $title ?>' type="text" class="form-control" placeholder="Название"
              aria-label="Название">
          </div>
          <input type="hidden" name='id' value="<?= $id ?>">
          <div class="col">
            <label for="editor" class="form-label ">Содержимое записи</label>
            <textarea id='editor' name='content' class="form-control" rows="6"><?= $content ?></textarea>
          </div>
          <div class="input-group col mb-4 mt-4">
            <input type="file" name='img' class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          <select class="form-select mb-2" name='topic' aria-label="Default select example">
            <?php
            foreach ($topics as $key => $topic) { ?>

              <option value="<?= $topic['id']; ?>">
                <?= $topic['name'] ?>
              </option>

            <?php } ?>
          </select>
          <div class="form-check">
            <?php if (empty($publish) && $publish == 0) { ?>
              <input name='publish' class="form-check-input" type="checkbox" id="flexCheckChecked">
              <label class="form-check-label" for="flexCheckChecked">
                Publish
              </label>
            <?php } else { ?>
              <input name='publish' class="form-check-input" type="checkbox" id="flexCheckChecked" checked>
              <label class="form-check-label" for="flexCheckChecked">
                Publish
              </label>
            <?php } ?>
          </div>
          <div class="col col-6">
            <button class="btn btn-primary" name='post_edit' type="submit">Сохранить запись</button>
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