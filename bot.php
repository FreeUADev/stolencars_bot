<?php

include "lib.php";
include "settings.php";
define("API_KEY","YOUT-API-KEY");

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
        
    }
    
}

$update = json_decode(file_get_contents("php://input"), TRUE);

$message = $update['message']; 
$text = $message['text']; 
$chat_id = $message['chat']['id']; 

$user = $message['from']['username']; 
$message_id = $update['message']['message_id']; 
$from_id = $update['message']['from']['id']; 
$name = $message['from']['first_name']; 
$surname = $message['from']['last_name']; 
$username = $name . " " . $surname;

$usrn = $message['from']['id'];
$fromusr = $message['from']['username'];
$nm = $message['from']['first_name'] . ' ' . $message['from']['last_name'];

$check_user = check_user($link, $chat_id);
$get_user = get_user($link, $from_id); 
$old_username = $get_user['username'];
if ($username != $old_username){
    
    update_user($link, $username, $from_id, $user);
    
}elseif ($user != $old_user){
    
    update_user($link, $username, $from_id, $user);
    
}


if(!isset($check_user)){
    add_user($link, $username, $chat_id, $user);
}

if(strpos($text, '/start') !== false){
  $reply = "Привіт ".$username."\nВідправте боту номер підозрілого авто для пошуку його в базі викрадених диверсантами автомобілів. \n<b>Приклад повідомлення:</b> <pre>!AA1234AA</pre>\nПовідомлення повинно починатися з ! (знак оклику). Для пошуку можна водити частину номера.";
  $func = ['chat_id'=>$chat_id, 'parse_mode'=>'html', 'disable_web_page_preview'=>true, 'text'=>$reply];
  bot('sendmessage', $func);
  
}


elseif(strpos($text, '!') !== false){
    $number = substr($text, 1);
    $data = get_data($link, $number);
    
    if(empty($data)){
        $reply = "Данні відсутні\n\nВідправте боту номер підозрілого авто для пошуку його в базі викрадених диверсантами автомобілів. \n<b>Приклад повідомлення:</b> <pre>!AA1234AA</pre>\nПовідомлення повинно починатися з ! (знак оклику). Для пошуку можна водити частину номера.";
        $func = ['chat_id'=>$chat_id, 'parse_mode'=>'html', 'disable_web_page_preview'=>true, 'text'=>$reply];
        bot('sendmessage', $func);
    }else{
        $reply = "<b>Ось що мені вдалося знайти:</b>\n";
        foreach($data as $d){
            if($check_user['status'] == '1'){
                $reply .= "<b>ID: ".$d['id']."</b>\n<b>Номер авто: </b><pre>".$d['number']."</pre>\n<b>Марка авто: </b><pre>".$d['brand']."</pre>\n<b>Коментар: </b><pre>".$d['comment']."</pre>\n---------------\n";
            }else{
                $reply .= "<b>Номер авто: </b><pre>".$d['number']."</pre>\n<b>Марка авто: </b><pre>".$d['brand']."</pre>\n<b>Коментар: </b><pre>".$d['comment']."</pre>\n---------------\n";
            }
            
        }
            
        $func = ['chat_id'=>$chat_id, 'parse_mode'=>'html', 'disable_web_page_preview'=>true, 'text'=>$reply];
        bot('sendmessage', $func);
    }
    
    
}


elseif(strpos($text, '/add') !== false){
    if($check_user['status'] == '1'){
        $add_data = substr($text, 5);
        $array_data = explode(",", $add_data);
        
        add_data($link, $array_data[0], $array_data[1], $array_data[2], $from_id);
        
        $reply = "Дані успішно збережено";
        $func = ['chat_id'=>$chat_id, 'parse_mode'=>'html', 'disable_web_page_preview'=>true, 'text'=>$reply];
        bot('sendmessage', $func);
    }
}


elseif(strpos($text, '/delete') !== false){
    if($check_user['status'] == '1'){
        $add_data = substr($text, 8);
        $array_data = explode(",", $add_data);
        
        update_data($link, $array_data[0], 1);
        $reply = "Дані успішно видалені";
        $func = ['chat_id'=>$chat_id, 'parse_mode'=>'html', 'disable_web_page_preview'=>true, 'text'=>$reply];
        bot('sendmessage', $func);
    }
}


elseif(strpos($text, '/restore') !== false){
    if($check_user['status'] == '1'){
        $add_data = substr($text, 9);
        $array_data = explode(",", $add_data);
        
        update_data($link, $array_data[0], 0);
        $reply = "Дані успішно видалені";
        $func = ['chat_id'=>$chat_id, 'parse_mode'=>'html', 'disable_web_page_preview'=>true, 'text'=>$reply];
        bot('sendmessage', $func);
    }
}


elseif(strpos($text, '/edit') !== false){
    if($check_user['status'] == '1'){
        $add_data = substr($text, 6);
        $array_data = explode(",", $add_data);
        
        edit_data($link, $array_data[0], $array_data[1], $array_data[2], $array_data[3], $from_id);
        
        $reply = "done";
        $func = ['chat_id'=>$chat_id, 'parse_mode'=>'html', 'disable_web_page_preview'=>true, 'text'=>$reply];
        bot('sendmessage', $func);
    }
}

bot_textlog($link, $from_id, $username, $message_id, $text, json_encode($update));
