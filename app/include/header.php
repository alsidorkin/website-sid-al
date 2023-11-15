
<?php //unset($_SESSION['login']);
session_start(); 

?>
<header class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-4">
          <h1><a href=" <?= BASE_URL ?>">My blog</a></h1>
        </div>
        <nav class="col-8">

        
          <ul>
            <li><a href="<?= BASE_URL ?>">
                <i class="fa-solid fa-person"></i> Главная</a></li>
            <li><a href="<?= BASE_URL.'about.php'?>">
            <i class="fa-solid fa-image"></i></i>О нас</a></li>
            <li><a href="#"> <i class="fa-solid fa-heart"></i></i> Услуги</a></li>

        <li>
        <?php if(isset($_SESSION['id'])):   ?>

<a href="#">
  <i class="fa fa-user"></i>
  <?=$_SESSION['login'];?>
</a>
<ul>


<?php if($_SESSION['admin']):   ?>
  <li><a href="/admin/topics/index.php">Админ панель</a></li>
  <?php endif; ?>

  <li><a href="logout.php">Выход</a></li>
</ul>

<?php  else: ?>
  <a href="<?php echo BASE_URL. 'log.php'?>"><i class="fa fa-user"></i>Войти</a>

<ul>
  <li><a href="<?php echo BASE_URL. 'reg.php'?>">Регистрация</a></li>
  <!-- <li><a href="#">Выход</a></li> -->
</ul>
<?php endif; ?>


            </li>

            
          </ul>
        </nav>
      </div>
    </div>
  </header>
