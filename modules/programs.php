<?php

function programs_ini(){
	if(isAdmin()) {
		$table = array(
			'name' 		=> 'text',			
			'text' 		=> 'text',	
			'shorttext' => 'text',		
			'lang'		=> 'text',
			'url'		=> 'text',
			'public' 	=> 'int',
		);
		install('programs', $table);
		redirect(BASE_PATH.'programs/admin');
	}
}


function programs_new() {
	if(isAdmin()) {
		global $title;	
		$title = T('add new program');	
	} else {
		redirect(BASE_PATH);
	}
}

function programs_edit() {
	if(isAdmin()) {
		global $title, $id;	
		$sql = sprintf("SELECT * FROM programs WHERE id=%d", $id); //echo $sql;
		$ret = DBrow($sql);
		$title = T('edit programs') . " '". $ret['title'] . "'";
		return $ret;
	} else {
		redirect(BASE_PATH);
	}
}

function programs_save() {
	if(isAdmin()) {
		global $_POST, $_programs, $title, $_FILES;
		//inspect($_FILES); 
		$data = $_POST['data']; //inspect($_POST);
		$id = (int)(@$data['id']);
		if($data['url'] == '') $data['url'] = translit($data['name']);
		$sql = 	  	"`name` 	= '" . SQLstring($data['name']) . "',
					`shorttext`	= '" . SQLstring($data['shorttext']) . "',
					`text`		= '" . SQLstring($data['text']) . "',
					`url`		= '" . SQLstring($data['url']) . "',
					`lang`		= '" . SQLstring($data['lang']) . "',
					`public`	= '" . (int)(@$data['public'])  . "'
				";
		if($id > 0) {
			$sql = "UPDATE programs SET $sql WHERE `id` = $id";
		} else {
			$sql = "INSERT IGNORE INTO programs SET  $sql";
			$id = DBinsertId();
		}
		DBquery($sql);// or die(mysql_error() . $sql);	echo $sql; die();
		
		

		$filename = "up/programs/pic/$id.jpg"; 
		if(move_uploaded_file($_FILES['pic']['tmp_name'], $filename)) {
			createthumb($filename,$filename,220,220);	
			createthumb($filename,"up/programs/thumb/$id.jpg",150,150);	
		}
		//die();
		redirect(BASE_PATH.'programs/admin');
	} else {
		redirect(BASE_PATH);
	}
}

function programs_admin() {
	if(isAdmin()) {
		global $title;	
		$sql = "";
		$title = T('list of programs') . ' / <a href="' . BASE_PATH . 'programs/new">' . T('add new') . '</a>' ;
		$programs = DBall("SELECT * FROM programs ORDER BY id DESC");	
		return $programs;
	} else {
		redirect(BASE_PATH);
	}
}

function programs_del(){ 
	if(isAdmin()) {
		global $id;
		DBquery(sprintf("DELETE FROM programs WHERE id=%d",$id));
		redirect(BASE_PATH.'programs/admin');
	} else {
		redirect(BASE_PATH);
	}
}

function programs_default() { 
	global $_PATH, $tplfn;
	if(@$_PATH[1] != '') 
		return programs_view();
	else
		return programs_list();
}


function programs_list() {
	global $title, $id, $pages;
	$page 	= $id; 
	if($page > 0) $page--; 
	$perpage= 10;
	$title 	= T('programs');
	$ret 	= DBall(sprintf("SELECT * FROM programs WHERE lang='%s' AND public ORDER BY id DESC LIMIT ".$page*$perpage.",".$perpage,  get_lang()));
	$pages 	= DBfield(sprintf("SELECT CEILING(COUNT(id)/%d) FROM programs WHERE lang='%s' AND public", $perpage, get_lang()));
	return $ret;
}


function programs_view() {
	global $_PATH, $title, $action;
	$url   = $_PATH[1]; 
	$programs  = DBrow(sprintf("SELECT * FROM programs WHERE url='%s' AND lang='%s' AND public", $url, get_lang()));
	$title = $programs['name'];
	$action = 'view';
	return $programs;	
}