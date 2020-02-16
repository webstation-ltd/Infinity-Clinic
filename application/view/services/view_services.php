<h1><?=$title?></h1> 
<?=$err?>
<?=$_SESSION['msg']?>
<?unset($_SESSION['msg'])?>

<form action="?c=services&m=update" method="post">

<p>Текст български <span class="red">*</span></p>
<textarea name="content_bg" id="content_bg" class="ckeditor" cols="110" rows="20"><?=$content_bg?></textarea>

<br />

<input name="edit_id" type="hidden" value="<?=$edit_id?>" />
<input name="post_news" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши" />
</form>


