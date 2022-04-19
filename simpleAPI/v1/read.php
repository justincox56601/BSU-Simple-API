<?php
/**
 * The read file is responsible for filtering web intput and making a request to the Posts object
 */
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../config/Database.php';
require_once 'models/Post.php';

$db = Database::getInstance();
$post = new Posts($db);

if(! empty($_GET)){
	$params = ['title', 'author', 'content'];
	$args = [];
	foreach($params as $key){
		if(isset($_GET[$key])){
			$args[$key] = $_GET[$key];
		}
	}
	
}else{
	$args=NULL;
}

$message = $post->getPosts($args);

echo json_encode($message);
die();

