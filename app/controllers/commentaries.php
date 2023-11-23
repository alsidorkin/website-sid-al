<?php 
//   $user=selectOne('users');

//   tt($user);
//   exit();
require_once SITE_ROOT . '/app/database/db.php';
$commentsForAdm=selectAll('comments');



// $page= $_GET['post'];
// $page = $_GET['post'];
$page = isset($_GET['post']) ? $_GET['post'] : null;
$email='';
$comment='';
$errMsg=[];
$status=0;
$comments=[];

// код для добавления комментария
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['goComment'])) {
    // tt($_POST);
    // exit();
    // код для добавления комментария
   
    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);

    if ($email === '' || $comment === '') { // проверка на заполнение всех полей
      array_push($errMsg, "Не все поля заполнены!!!");
    } else if (mb_strlen($comment, 'UTF8') < 5) { // проверка на количество символов логина
      array_push($errMsg, "Комментарий должен быть больше 50-ти символов!!!");
    } else {

       
        // $user=selectOne('users',['email'=>$email]);

        // tte($user);
        // exit();&&$user['admin']==1
    

        // if ($user['email']==$email){
        //     $status=1;
        // }
      $comment = [
        'status' =>$status,
        'page' => $page,
        'email' => $email,
        'comment' => $comment,
      ];
     
        insert('comments', $comment);
      $comments=selectAll('comments',['page'=>$page ]);
       header('Location: ' . BASE_URL . 'single.php?post=' . $page);
      // exit();
  }
  } else {
    // сохранение значений инпутов логин и имейл, 'status'=>1
  
    $email = '';
    $comment = '';
    $comments=selectAll('comments',['page'=>$page ]);

  }
  

  if($_SERVER['REQUEST_METHOD']=== 'GET'&&isset($_GET['id'])){
    $comments=selectOne('comments', ['id'=>$_GET['id']]);
    $id=$comments['id'];
    $text=$comments['comment'];
    $mail=$comments['email'];
    $status=$comments['status'];
    //  tte($email);
  
  }


// код для изменения комментария
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_edit'])) {
  // tt($_POST);
  // exit();
  $comment = trim($_POST['comment']);

  if ( $comment === '') { // проверка на заполнение всех полей
    array_push($errMsg, "Комментарий не имеет текста!!!");
  } else if (mb_strlen($comment, 'UTF8') < 5) { // проверка на количество символов логина
    array_push($errMsg, "Комментарий должен быть больше 50-ти символов!!!");
  } else {

     $status = isset($_POST['$status']) ? 1 :0;
      // $user=selectOne('users',['email'=>$email]);

      // tt($user);
      // exit();&&$user['admin']==1
  

      // if ($user['email']==$email){
      //     $status=1;
      // }
    $comment = [
      'status' =>$status,
      'comment' => $comment,
    ];
   $id=$_POST['id'];
  update('comments',$id, $comment);
    // $comments=selectAll('comments',['page'=>$page , 'status'=>1]);
    header('location: ../../admin/comments/index.php ');
}
} else {
  // сохранение значений инпутов логин и имейл

  // $comment = $comments['comment'];
  $status = isset($_POST['$status']) ? 1 :0;
}


// удаление комментария
if($_SERVER['REQUEST_METHOD']=== 'GET'&&isset($_GET['delete_id'])){
 
  $id=$_GET['delete_id'];
  deletes('comments',$id);
  //  tte($email);
  header('location: ../../admin/comments/index.php ');
}


// изменение publish
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {

  $id = $_GET['pub_id'];
  $publish = $_GET['publish'];

  update('comments', $id, ['status' => $publish]);
  header('location: ../../admin/comments/index.php ');
  exit();
}