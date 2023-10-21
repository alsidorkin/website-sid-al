<?php 
require_once __DIR__ . '/../../app/database/db.php';
// require_once  'app/database/db.php';
$errMsg='';
$id='';
$name='';
$description='';
$topics=selectAll('topics');




// код для добавления категорий
if ($_SERVER['REQUEST_METHOD']==='POST' &&isset($_POST['topic-create'])){
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
  else if(mb_strlen($name,'UTF8')<2){// проверка на количество символов логина
    $errMsg='Категория должена быть больше 2-х символов!!!';
  }
  else {
  
  $existance=selectOne('topics',['name'=>$name]);
  // tt($existance);
     //  exit();
  if($existance &&$existance['name']===$name){
    $errMsg='Категория с таким названием уже существует!!!';
  }else {
  
    $topic=[
      'name'=>$name,
      'description'=>$description,
  
      ];
    
         $id=insert('topics',$topic);
        //  $errMsg='Пользователь '. $login.' успешно зарегистрирован!!';
        $topic=selectOne('topics',['id'=>$id]);
        header('location: ../../admin/topics/index.php '); 
    // tt($_SESSION);
    // die();
  }
  } 
  }else{
  // сохранение значений инпутов логин и имейл
  $name='';
  $description='';
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
