<?php 

require_once __DIR__ . '/../../app/database/db.php';

$isSubmit=false;
$errMsg=[];
$regStatus='';
    $id = '';
    // tt($id);
    $admin = '';
    $username = '';
    $email = '';

$users=selectAll('users');


function loginUser($existance){
$_SESSION['id'] =$existance['id'];
$_SESSION['login'] =$existance['username'];
$_SESSION['admin'] =$existance['admin'];

if($_SESSION['admin']){
  header('Location: '.BASE_URL . 'admin/posts/index.php');

}else {
header('Location: '.BASE_URL);
}
}

// код для формы регистрации
if ($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['button-reg'])){
  // tt($_POST);
  // echo 'форма регистрации!!';
  //   exit();
$admin=0;  
$login=trim($_POST['login']);
$email=trim($_POST['email']);
$passF=trim($_POST['pass-first']);
$passS=trim($_POST['pass-second']);




if($login===''||$email===''||$passF===''||$passS===''){// проверка на заполнение всех полей
 array_push($errMsg,"Не все поля заполнены!!!");
}
else if(mb_strlen($login,'UTF8')<2){// проверка на количество символов логина
 array_push($errMsg,"Логин должен быть больше 2-х символов!!!");
}
else if($passF!==$passS){// проверка на одинаковость паролей
 array_push($errMsg,"Пароли в обеих полях должны быть одинаковы!!!");
}
else {

$existance=selectOne('users',['email'=>$email]);
// tt($existance);
   //  exit();
if($existance &&$existance['email']===$email){
 array_push($errMsg,"Пользователь с такими данными уже существует!!!");
}else {

  $pass=password_hash($passS,PASSWORD_BCRYPT) ;
  $post=[
    'admin'=>$admin,
    'username'=>$login,
    'email'=>$email,
    'password'=>$pass,

    ];
  
       $id=insert('users',$post);
      // array_push($errMsg,"Пользователь '. $login.' успешно зарегистрирован!!';
      $user=selectOne('users',['id'=>$id]);

      loginUser($existance);
  // tt($_SESSION);
  // die();
}
} 
}else{
// сохранение значений инпутов логин и имейл
$login='';
$email='';
}

// session_unset(); 
// $sessionTimeout = 1 * 60;
// $_SESSION['session_start_time'] = time();
// if (!isset($_SESSION['login_attempts'])) {
//   $_SESSION['login_attempts'] = 0;
// }
// код для формы авторизации
if ($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['button-log'])){
    $email=trim($_POST['email']);
    $pass=trim($_POST['password']);
    if($email===''||$pass===''){// проверка на заполнение всех полей
     array_push($errMsg,"Не все поля заполнены!!!");
    }else{

      $existance=selectOne('users',['email'=>$email]);
      // tt($existance);
      // exit();
      if($existance && password_verify($pass,$existance['password'])){        
//авторизовать
           loginUser($existance);
      }else {
        //ошибка авторизации
        
       array_push($errMsg,"Почта либо пароль введены не правильно!!!");
        // if (isset($_SESSION['session_start_time']) && (time() - $_SESSION['session_start_time']) > $sessionTimeout) {
          //  $_SESSION['login_attempts'] = 0;
        // }

          // Увеличение счетчика попыток входа
      //   $_SESSION['login_attempts']++;

      //   if ($_SESSION['login_attempts'] > 3) {
      //     // Реализуйте механизм блокировки здесь, например, перенаправьте на страницу блокировки
      //     header('Location: ' . BASE_URL . 'index.php');
      //     exit();
      // }
      }
    }
}
else{
  // сохранение значений инпутов логин и имейл
  
  $email='';
  }


  // код добавления пользователя в админке

  if ($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['create-user'])){
    // tt($_POST);
    //   exit();
  $admin=0;  
  $login=trim($_POST['login']);
  $email=trim($_POST['email']);
  $passF=trim($_POST['pass-first']);
  $passS=trim($_POST['pass-second']);
  
  
  
  
  if($login===''||$email===''||$passF===''||$passS===''){// проверка на заполнение всех полей
   array_push($errMsg,"Не все поля заполнены!!!");
  }
  else if(mb_strlen($login,'UTF8')<2){// проверка на количество символов логина
   array_push($errMsg,"Логин должен быть больше 2-х символов!!!");
  }
  else if($passF!==$passS){// проверка на одинаковость паролей
   array_push($errMsg,"Пароли в обеих полях должны быть одинаковы!!!");
  }
  else {
  
  $existance=selectOne('users',['email'=>$email]);
  // tt($existance);
     //  exit();
  if($existance &&$existance['email']===$email){
   array_push($errMsg,"Пользователь с такими данными уже существует!!!");
  }else {
  
    $pass=password_hash($passS,PASSWORD_BCRYPT) ;
if(isset($_POST['admin'])){
  $admin=1;
}
    $user=[
      'admin'=>$admin,
      'username'=>$login,
      'email'=>$email,
      'password'=>$pass,
  
      ];
    
         $id=insert('users',$user);
        // array_push($errMsg,"Пользователь '. $login.' успешно зарегистрирован!!';
        $users=selectOne('users',['id'=>$id]);
        header('location: ../../admin/users/index.php ');
        // loginUser($users);
    // tt($_SESSION);
    // die();
  }
  } 
  }else{
  // сохранение значений инпутов логин и имейл
  $login='';
  $email='';
  }



  // редактирование пользователя
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $id = $_GET['id'];
    $user = selectOne('users', ['id' => $id]);
    $id = $user['id'];
    // tt($id);
    $admin = $user['admin'];
    $username = $user['username'];
    $mail = $user['email'];
   
  }
  
  if ($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['user-edit'])){
    // tt($_POST);
    //   exit();
  $id=$_POST['id']; 
  $admin=isset($_POST['admin'])?1:0; 
  $login=trim($_POST['login']);
  $email=trim($_POST['email']);
  $passF=trim($_POST['pass-first']);
  $passS=trim($_POST['pass-second']);
  
  
  
  
  if($login===''){// проверка на заполнение всех полей
   array_push($errMsg,"Не все поля заполнены!!!");
  }
  else if(mb_strlen($login,'UTF8')<2){// проверка на количество символов логина
   array_push($errMsg,"Логин должен быть больше 2-х символов!!!");
  }
  else if($passF!==$passS){// проверка на одинаковость паролей
   array_push($errMsg,"Пароли в обеих полях должны быть одинаковы!!!");
  }
  else {
  
  // $existance=selectOne('users',['email'=>$email]);
  // // tt($existance);
  //    //  exit();
  // if($existance &&$existance['email']===$email){
  //  array_push($errMsg,"Пользователь с такими данными уже существует!!!");
  // }else {
  
    $pass=password_hash($passS,PASSWORD_BCRYPT) ;
// if(isset($_POST['admin'])){
//   $admin=1;
// }
    $user=[
      'admin'=>$admin,
      'username'=>$login,
      // 'email'=>$email,
      'password'=>$pass,
  
      ];
    
         update('users',$id,$user);
         header('location: ../../admin/users/index.php '); 
        // array_push($errMsg,"Пользователь '. $login.' успешно зарегистрирован!!';
       // $users=selectOne('users',['id'=>$id]);
  
        //loginUser($users);
    // tt($_SESSION);
    // die();
  // }
  } 
  }else{
  // сохранение значений инпутов логин и имейл
  $login='';
  $email='';
  }












// удаление пользователя

  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {

    $id = $_GET['delete_id'];
    deletes('users', $id);
    header('location: ../../admin/users/index.php ');
  }