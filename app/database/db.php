<?php 
session_start();
require('connect.php');

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
function tte($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
     exit();
}
// проверка выполнения запроса к бд
function dbCheckError($query){
    $errInfo = $query->errorInfo();

    if($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}


// запрос на прлучение данных с одной таблицы

function selectAll($table,$params=[]){
    global $pdo;
$sql="SELECT * FROM $table ";
if(!empty($params)){
   $i=0;
   foreach($params as $key=>$value){
if(!is_numeric($value)){
    $value="'".$value."'";
}
 if($i===0){
$sql=$sql." WHERE $key=$value";
}
else{
     $sql=$sql." AND $key=$value";
 }
 $i++;
   }
}
$query=$pdo->prepare($sql);
$query->execute();
dbCheckError($query);
return $query->fetchAll();
}

// tt($sql);
// exit();

// запрос на получение одной строки с выбранной таблицы
function selectOne($table,$params=[]){
    global $pdo;
    $sql="SELECT * FROM $table ";
    if(!empty($params)){
       $i=0;
       foreach($params as $key=>$value){
    if(!is_numeric($value)){
        $value="'".$value."'";
    }
    
     if($i===0){
    $sql=$sql." WHERE $key=$value";
    }
    else{
         $sql=$sql." AND $key=$value";
     }
     $i++;
       }
    }
    // $sql=$sql."LIMIT 1";
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
     return $query->fetch();

    // tt($query->fetch());
    //  exit();
    }


    //запись в таблицу бд

    function insert($table,$params){
        global $pdo;
//INSERT INTO `users` (admin, username, email, password)VALUES ('0', 'fatal', 'fgjjhfh@com.ua', 'jjjjjjj');
//  $sql="INSERT INTO $table (admin, username, email, password , created)VALUES (:admin, :username, :email, :password, :created)";
$i=0;
$coll='';
$mask='';
foreach($params as $key=>$value){
if($i===0){
    $coll=$coll."$key";
    $mask=$mask."'"."$value"."'"; 
}else{
    $coll=$coll.", $key";
    $mask=$mask.", '"."$value"."'";
}
$i++;
}


 $sql="INSERT INTO $table ($coll) VALUES ($mask)";

// tt($sql);
// exit();

$query=$pdo->prepare($sql);
$query->execute();
dbCheckError($query);
 return $pdo->lastInsertId();
}


// обновление строки в таблице
function update($table,$id,$params){
    global $pdo;
$i=0;
$str='';
foreach($params as $key=>$value){
if($i===0){

$str=$str.$key." = '".$value."'"; 
}else{

    $str=$str.", ".$key." = '".$value."'";
}
$i++;
}


$sql="UPDATE $table SET $str WHERE id=$id";

// tt($sql);
// exit();

$query=$pdo->prepare($sql);
$query->execute();
dbCheckError($query);

}


// удаление строки в таблице
function deletes ($table,$id){
    global $pdo;
//DELETE FROM `users` WHERE `users`.`id` = 26

$sql="DELETE FROM $table WHERE `id` = $id";

// tt($sql);
// exit();

$query=$pdo->prepare($sql);
$query->execute();
dbCheckError($query);

}

$arrData=[
    'admin'=>'1',
    'username'=>'bubka-krummsa',
    'email'=>'ljbubajm@com.ua',
    'password'=>'rrrrrrrrr',
    'created'=>'2022-08-24 20:17:08'
];

$params=[
    'id'=>'9',
    'admin'=>'0',
     'email'=>'sanyok1234@rambler.r4u',
     'username'=>'alexandr-soikl',
];


//   выборка записей (posts) с автором в админку

function selectAllFromPostsWithUsers($table1,$table2){
    global $pdo;

    $sql="SELECT 
    t1 .id,
    t1 .title,
    t1 .img,
    t1 .content,
    t1 .status,
    t1 .id_topic,
    t1 .created_data,
    t2 .username

    FROM $table1 t1 
    JOIN $table2 t2 
    ON t1.id_user=t2.id"; 
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);  
    return $query->fetchAll();

}
function selectAllFromPostsWithUsersOneIndex($table1,$table2, $limit , $offset){
    global $pdo;

    $sql="SELECT p.*, u.username
    FROM $table1 AS P
    JOIN $table2 AS u
    ON p.id_user=u.id
    WHERE p.status=1
    LIMIT $limit 
    OFFSET $offset"; 

    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);  
    return $query->fetchAll();

}

// выборка записей (post ) с автором на главную
function selectTopTopicFromPostsOneIndex($table1){
    global $pdo;

    $sql="SELECT *
    FROM $table1
    WHERE id_topic = 16 "; 
    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);  
    return $query->fetchAll();

}

// поиск по заголовкам и содержимому (простой)
function searchInTitleAndContent($text,$table1,$table2){
    global $pdo;
    $text=trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    $sql="SELECT p.*, u.username
    FROM $table1 AS P
    JOIN $table2 AS u
    ON p.id_user=u.id
    WHERE p.status=1
    AND p.title LIKE '%$text%'
    OR p.content LIKE '%$text%'"; 

    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);  
    return $query->fetchAll();

}

// выборка записи (post ) с автором для single
function selectPostFromPostsWithUsersOneSingle($table1,$table2,$id){
    global $pdo;

    $sql="SELECT p.*, u.username
    FROM $table1 AS P
    JOIN $table2 AS u
    ON p.id_user=u.id
    WHERE p.id=$id"; 

    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);  
    return $query->fetch();

}
// выборка записи (post ) с автором для single
function countRow($table){
    global $pdo;

    $sql="SELECT COUNT(*)
    FROM $table WHERE status = 1"; 

    $query=$pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);  
    return $query->fetchColumn();

}
// tt(selectOne('users',$params));
// tt(selectAll('users',$params));
 //insert('users',$arrData);
 //update('users',2,$arrData);
 //deletes ('users', 6);




