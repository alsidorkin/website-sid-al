<?php 
require_once __DIR__ . '/../../app/database/db.php';
// require_once  'app/database/db.php';
$errMsg='';
$id='';
$title='';
$content='';
$img='';
$topic='';
$publish='';
 $topics=selectAll('topics');
//  $posts=selectAll('posts');
//  $user=selectOne('users',['id'=>$_SESSION ['id']]);
 $postsAdm=selectAllFromPostsWithUsers('posts','users');
  // tt($postsAdm);
  //   exit();

// код для добавления записей
if ($_SERVER['REQUEST_METHOD']==='POST' &&isset($_POST['add_post'])){
    // tt($_POST);
    // exit();
    // echo 'форма регистрации!!';
     
  $title=trim($_POST['title']);
  $content=trim($_POST['content']);
  $topic=trim($_POST['topic']);
  $img=trim($_POST['img']);
  $publish=isset($_POST['publish']) && trim($_POST['publish']) !==null ? 1:0;
  
 

  // tt($_POST);
  //   exit();
  
  
  if($title===''||$content===''||$topic===''){// проверка на заполнение всех полей
    $errMsg='Не все поля заполнены!!!';
  }
  else if(mb_strlen($title,'UTF8')<7){// проверка на количество символов логина
    $errMsg='Название статьи должен быть больше 7-ми символов!!!';
  }
  else {
  
  
 
    // tt($_SESSION);
    // exit();
    
    $contents=[
      'id_user'=>$postsAdm ['id'],
      'title'=>$title,
      'content'=>$content,
      'img'=>$img,
      'status'=>$publish,
      'id_topic'=>$topic,

  
      ];
      // tt($contents);
      // die();
         $post=insert('posts',$contents);
        //  $errMsg='Пользователь '. $login.' успешно зарегистрирован!!';
       $posts=selectOne('posts',['id'=>$id]);
      //  $user=selectOne('users',['id'=>$id]);
        header('location: ../../admin/posts/index.php '); 
    // tt($_SESSION);
    // die();
   }
  } 
  else{
  // сохранение значений инпутов логин и имейл
  $title='';
  $content='';
  }



  

  // редактирование категории 
  if ($_SERVER['REQUEST_METHOD']==='GET'&& isset($_GET['id'])){
  $id=$_GET['id'];
  $topic=selectOne('topics' , ['id'=>$id]);
  $id=$topic['id'];
  $name=$topic['name'];
  $description=$topic['description'];



  //header('location: ../../admin/topics/create.php '); 
  // tt($topic);
  
  }


  // tt($id);
  if ($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['topic-edit'])){
    // tt($_POST);
    // exit();
    // echo 'форма регистрации!!';
     
  $name=trim($_POST['name']);
  $description=trim($_POST['description']);
  
  
//   tt($_POST);
//     exit();
  
  
  if($name===''||$description===''){// проверка на заполнение всех полей
    $errMsg='Не все поля заполнены!!!';
  }
  else if(mb_strlen($name,'UTF8')<2){// проверка на количество символов категории
    $errMsg='Категория должна быть больше 2-х символов!!!';
  }
  // else {
  
  // $existance=selectOne('topics',['name'=>$name]);
  // // tt($existance);
  //    //  exit();
  // if($existance &&$existance['name']===$name){
  //   $errMsg='Категория с таким названием уже существует!!!';
  // }
  else {
  
    $topic=[
      'name'=>$name,
      'description'=>$description,
  
      ];
    
         $id=$_POST['id'];
        //  $errMsg='Пользователь '. $login.' успешно зарегистрирован!!';
        // $topic=selectOne('topics',['id'=>$id]);
       update('topics',$id,$topic);

        header('location: ../../admin/topics/index.php '); 
    // tt($_SESSION);
    // die();
   }
  } 
  // }


  // удаление категории
  if ($_SERVER['REQUEST_METHOD']==='GET'&& isset($_GET['delete_id'])){
   
  $id=$_GET['delete_id'];


  deletes ('topics',$id);
  // $topic=selectOne('topics' , ['id'=>$id]);
 header('location: ../../admin/topics/index.php '); 
  }
