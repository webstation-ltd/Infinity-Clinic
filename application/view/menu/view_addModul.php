<h1><?=$title?></h1> 
<?=$err?>

<h2>Добавяне на тип към страница: <span class="red"><?=$menuName?></span></h2>

<form action="?c=menu&m=addMenuType" method="post">
<select name="menu_type">
	<option value="0">Избери тип на страницата</option>
    <? foreach($options as $o):?>
    	<option value="<?=$o['id']?>"><?=$o['title']?></option>
    <? endforeach;?>
</select>

<input name="menu_id" type="hidden" value="<?=$menu_id?>" />
<input name="" type="submit" value="Запиши" />

</form>