<?php
require_once __DIR__ . '/../../app/database/db.php';
if (!$_SESSION) {
  header('location: ' . BASE_URL . 'log.php');
}

$errMsg = [];
$errMsg1 = '';
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';
$publish = '';
$topics = selectAll('topics');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');

// код для добавления записей
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {

  // добавление избражения  
  require_once '../../app/helps/changeImage.php';

  // код для добавления записей
  // $id = $postsAdm['id'];
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $topic = trim($_POST['topic']);
  $img = isset($_POST['img']) ? trim($_POST['img']) : '';
  $publish = isset($_POST['publish']) && trim($_POST['publish']) !== null ? 1 : 0;

  if ($title === '' || $content === '' || $topic === '') { // проверка на заполнение всех полей
    array_push($errMsg, "Не все поля заполнены!!!");
  } else if (mb_strlen($title, 'UTF8') < 7) { // проверка на количество символов логина
    array_push($errMsg, "Название статьи должен быть больше 7-ми символов!!!");
  } else {
    if (!empty($img)) {
    $contents = [
      'id_user' => $_SESSION['id'],
      'title' => $title,
      'content' => $content,
      'img' => $img,
      'status' => $publish,
      'id_topic' => $topic,
    ];
   
    $post = insert('posts', $contents);
    header('location: ../../admin/posts/index.php ');
  }
  else {
    $contents = [
      'id_user' => $_SESSION['id'],
      'title' => $title,
      'content' => $content,
      'status' => $publish,
      'id_topic' => $topic,
    ];
   
    $post = insert('posts', $contents);
    header('location: ../../admin/posts/index.php ');
  }
}
} else {
  // сохранение значений инпутов логин и имейл

  $id = '';
  $title = '';
  $content = '';
  $publish = '';
  $topic = '';
}

// редактирование записи 
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $post = selectOne('posts', ['id' => $id]);
  $id = $post['id'];
  // tt($id);
  $title = $post['title'];
  $content = $post['content'];
  $topic = $post['id_topic'];
  $publish = $post['status'];

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_edit'])) {

  // добавление избражения  
  require_once '../../app/helps/changeImage.php';

  $id = $_POST['id'];
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $topic = trim($_POST['topic']);
  $img = isset($_POST['img']) ? trim($_POST['img']) : '';
  $publish = isset($_POST['publish']) && trim($_POST['publish']) !== null ? 1 : 0;

  if ($title === '' || $content === '' || $topic === '') { // проверка на заполнение всех полей
    array_push($errMsg, "Не все поля заполнены!!!");
  } else if (mb_strlen($title, 'UTF8') < 7) { // проверка на количество символов логина
    array_push($errMsg, "Название статьи должен быть больше 7-ми символов!!!");
  } else {

    $contents = [
      'id_user' => $_SESSION['id'],
      'title' => $title,
      'content' => $content,
      'img' => $img,
      'status' => $publish,
      'id_topic' => $topic,
    ];

    if (!empty($img)) {
      update('posts', $id, $contents);

      header('location: ../../admin/posts/index.php ');
    }
  }
} else {
  // сохранение значений инпутов логин и имейл

  $publish = isset($_POST['publish']) ? 1 : 0;
 

}

// изменение publish
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {

  $id = $_GET['pub_id'];
  $publish = $_GET['publish'];

  update('posts', $id, ['status' => $publish]);
  header('location: ../../admin/posts/index.php ');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {

  $id = $_GET['delete_id'];
  deletes('posts', $id);
  header('location: ../../admin/posts/index.php ');
}
