<?php
session_start();
$db =  db::getInstance(); 
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=strip_tags($title)?></title>
<meta name="description" content="<?=strip_tags($content)?>" />

<link href="<?=ADMIN?>/html/css/css.css" rel="stylesheet" type="text/css" />
<script src="<?=ADMIN?>/html/js/jquery.1.4.1.min.js" type="text/javascript"></script>
<script>
var _BASE_URL = '<?php echo _BASE_URL; ?>';
var current_group_id = 1;
</script>
<script type="text/javascript" src="<?=ADMIN?>/html/js/interface-1.2.js"></script>
<script type="text/javascript" src="<?=ADMIN?>/html/js/javascript.js"></script>
<script type="text/javascript" src="<?=ADMIN?>/html/js/inestedsortable.js"></script>
<script type="text/javascript" src="<?=ADMIN?>/html/js/menu.js"></script>
<script type="text/javascript" src="<?=ADMIN?>/html/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script type="text/javascript" src="<?=ADMIN?>/html/ckeditor/ckeditor.js"></script>

</head>
<body>
<div id="header">
	<ul>
   		<li class="menu_box"><a href="<?=ADMIN?>">За нас</a></li>
        <li class="menu_box"><a href="?c=menu">Страници</a></li>
        <li class="menu_box right"><a href="?c=login&m=logout">Изход</a></li>
    </ul>
</div>

<div id="content">



