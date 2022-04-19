<?php
/**
 * The Posts object is responsible for receiveing data from the database
 * then filtering it per the request args
 */

class Posts{
	private $db;
	private $table = 'posts';
	public function __construct($db){
		$this->db = $db;
		return;
	}

	public function getPosts($args = NULL){
		//Create Query string and request posts from the database
		$query = 'SELECT * FROM ' . $this->table;
		$posts = $this->db->getPosts($query);

		//filter the returned posts
		if($args != NULL){
			foreach($args as $key=>$val){
				$posts = array_filter($posts, function($elem)use($key, $val){
					return $elem[$key] == $val;
				});
			}
		}
		$response = [
			'numPosts' => count($posts),
			'dateAccessed' => date(DATE_RSS),
			'data' => $posts
		];
		return $response;
	}
}


