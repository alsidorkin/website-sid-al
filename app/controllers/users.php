<?php 

include("app/database/db.php");

$isSubmit=false;
$errMsg='';
$regStatus='';



function loginUser($existance){
  $_SESSION['id'] =$existance['id'];
$_SESSION['login'] =$existance['username'];
$_SESSION['admin'] =$existance['admin'];

if($_SESSION['admin']){
  header('Location: '.BASE_URL . 'admin/admin.php');

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
  $errMsg='Не все поля заполнены!!!';
}
else if(mb_strlen($login,'UTF8')<2){// проверка на количество символов логина
  $errMsg='Логин должен быть больше 2-х символов!!!';
}
else if($passF!==$passS){// проверка на одинаковость паролей
  $errMsg='Пароли в обеих полях должны быть одинаковы!!!';
}
else {

$existance=selectOne('users',['email'=>$email]);
// tt($existance);
   //  exit();
if($existance &&$existance['email']===$email){
  $errMsg='Пользователь с такими данными уже существует!!!';
}else {

  $pass=password_hash($passS,PASSWORD_BCRYPT) ;
  $post=[
    'admin'=>$admin,
    'username'=>$login,
    'email'=>$email,
    'password'=>$pass,

    ];
  
       $id=insert('users',$post);
      //  $errMsg='Пользователь '. $login.' успешно зарегистрирован!!';
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
      $errMsg='Не все поля заполнены!!!';
    }else{

      $existance=selectOne('users',['email'=>$email]);
      // tt($existance);
      // exit();
      if($existance && password_verify($pass,$existance['password'])){        
//авторизовать
           loginUser($existance);
      }else {
        //ошибка авторизации
        
        $errMsg='Почта либо пароль введены не правильно!!!';
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