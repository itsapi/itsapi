<?
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include('include/conf.php');
	include($fileNames['mysql']);
	include($fileNames['funcs']);
	include($fileNames['login']);
	include($fileNames['search']);
	$topProfileToggle = $viewPostsButtonTxt;
?>