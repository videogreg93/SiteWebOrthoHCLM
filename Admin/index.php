<?php
session_start();

if(isset($_GET['logout'])){
	session_destroy();
	header('Location: index.php');
	exit();
}

if(!isset($_SESSION['authorized'])){

if(isset($_POST['submit'])){
	if($_POST['username'] =='jeandaniel' && $_POST['password'] == 'ilmarchedanslarue'){
		$_SESSION['authorized'] = true;
		header('Location: index.php');
		exit();
	}
	
	if($_POST['username'] =='clinique' && $_POST['password'] == 'ortho'){
		$_SESSION['authorized'] = true;
		header('Location: index.php');
		exit();
	}
}

?>

<form action='' method='post' autocomplete='off' style = "text-align: center;">
<h1>Centre Administrateur</h1>
<p>Username: <input type="text" name="username" value=""></p>
<p>Password: <input type="password" name="password" value=""></p>
<p><input type="submit" name="submit" value="Login"></p>	
</form>

<?php } else { ?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>File Manager</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="js/i18n/elfinder.ru.js"></script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
    	// Helper function to get parameters from the query string.
	    function getUrlParam(paramName) {
	        var reParam = new RegExp('(?:[?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
	        var match = window.location.search.match(reParam) ;
	        
	        return (match && match.length > 1) ? match[1] : '' ;
	    }

	    $().ready(function() {
	        var funcNum = getUrlParam('CKEditorFuncNum');

	        var elf = $('#elfinder').elfinder({
	            url : 'php/connector.php',
	            getFileCallback : function(file) {
	                window.opener.CKEDITOR.tools.callFunction(funcNum, file);
	                window.close();
	            },
	            resizable: false
	        }).elfinder('instance');
	    });
	</script>
	</head>
	<body>

		<p><a href='?logout'>Logout</a></p>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>

<?php } ?>