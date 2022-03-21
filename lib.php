<?php

function get_user($link, $chat_id)  {

    $query = "SELECT * FROM `users` WHERE chat_id = ".mysqli_real_escape_string($link, $chat_id);
    $result = mysqli_query($link, $query);

    if (!$result)
      die(mysqli_error($link));
    $get_user = mysqli_fetch_assoc($result);

    return $get_user;
}

function update_user($link, $username, $chat_id, $name){
    $username = trim($username);
    $chat_id = trim($chat_id);
    $name = trim($name);
    
	$sql = "UPDATE users SET username='%s', name='%s' WHERE chat_id='%d'";
	
	$query = sprintf($sql, mysqli_real_escape_string($link, $name),
							mysqli_real_escape_string($link, $username),
							$chat_id);
	$result = mysqli_query($link, $query);
	if(!$result)
		die(mysqli_error($link));
	return mysqli_affected_rows($link);
}

function add_user($link, $username, $chat_id, $name){
    $username = trim($username);
    $chat_id = trim($chat_id);
    $name = trim($name);
    
    $t = "INSERT INTO users (chat_id, username, name) VALUES ('%s', '%s', '%s')";
    
    $query = sprintf($t, mysqli_real_escape_string($link, $chat_id),
                                                  mysqli_real_escape_string($link, $username),
                                                mysqli_real_escape_string($link, $name));
    
    $result = mysqli_query($link, $query);
    
    if (!$result)
      die(mysqli_error($link));
    return true;
}

function check_user($link, $chat_id){
	$query = sprintf("SELECT * FROM users WHERE chat_id=%d", (int)$chat_id);
	$result = mysqli_query($link, $query);
	if (!$result)
		die(mysqli_error($link));
	$check_user = mysqli_fetch_assoc($result);
	return $check_user;
}



function bot_textlog($link, $chat_id, $username, $message_id, $text, $full_data){
   
    if ($chat_id == '')
        return false;
    
    $t = "INSERT INTO bot_history (chat_id, username, message_id, text, full_data) VALUES ('%s', '%s', '%s', '%s', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($link, $chat_id),
                                                  mysqli_real_escape_string($link, $username),
                                                  mysqli_real_escape_string($link, $message_id),
                                                  mysqli_real_escape_string($link, $text),
                                                  mysqli_real_escape_string($link, $full_data));

    
    $result = mysqli_query($link, $query);

    if (!$result)
        die(mysqli_error($link));
    return true;
}

function get_data($link, $data)  {

    $query = "SELECT * FROM `car_db` WHERE number like '%".mysqli_real_escape_string($link, $data)."%' and status = 0";
    
	$result = mysqli_query($link, $query);
	if (!$result)
		die(mysqli_error($link));
	$n = mysqli_num_rows($result);
	$get_data = array();
	for ($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$get_data[] = $row;
	}
	return $get_data;
} 

function add_data($link, $number, $brand, $comment, $chat_id){
    $number = trim($number);
    $brand = trim($brand);
    $comment = trim($comment);
    $chat_id = trim($chat_id);
    
    $t = "INSERT INTO car_db (number, brand, comment, user) VALUES ('%s', '%s', '%s', '%s')";
    
    $query = sprintf($t, mysqli_real_escape_string($link, $number),
                                                  mysqli_real_escape_string($link, $brand),
                                                mysqli_real_escape_string($link, $comment),
                                                mysqli_real_escape_string($link, $chat_id));
    
    $result = mysqli_query($link, $query);
    
    if (!$result)
      die(mysqli_error($link));
    return true;
}

function update_data($link, $id, $status){
    
    $id = trim($id);
    $status = trim($status);
    
	$sql = "UPDATE car_db SET status=".mysqli_real_escape_string($link, $status)." WHERE id=".mysqli_real_escape_string($link, $id);
	
	$result = mysqli_query($link, $sql);
	if(!$result)
		die(mysqli_error($link));
	return mysqli_affected_rows($link);
}

function edit_data($link, $id, $number, $brand, $comment, $chat_id){
    $id = (int)$id;
    $number = trim($number);
    $brand = trim($brand);
    $comment = trim($comment);
    $chat_id = trim($chat_id);
    
	$sql = "UPDATE car_db SET number='%s', brand='%s', comment='%s', user ='%s' WHERE id='%d'";
	
	$query = sprintf($sql, mysqli_real_escape_string($link, $number),
                           mysqli_real_escape_string($link, $brand),
                           mysqli_real_escape_string($link, $comment),
                           mysqli_real_escape_string($link, $chat_id),
							$id);
	$result = mysqli_query($link, $query);
	if(!$result)
		die(mysqli_error($link));
	return mysqli_affected_rows($link);
}
