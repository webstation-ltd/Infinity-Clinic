<h1><?=$title?></h1> 
<a href="?c=newsletter" class="button">Изпращане на бюлетин</a>
<a href="?c=newsletter&m=emailList" class="button">Списък с Email адреси</a>
<br />
<br /><br />


<form action="?c=newsletter" method="post" enctype="multipart/form-data">

<div class="form_input">
	<p>Заглавие на пощата<span class="red">*</span></p>
    <div class="sing_form">
    	<input name="title" type="text" value="<?=$title_en?>" />
    </div>
</div>


<p>Текст към новината български <span class="red">*</span></p>
<textarea name="content" id="content" class="ckeditor" cols="110" rows="20"><?=$content_bg?></textarea>


<br />


<input name="post_newsletter" type="hidden" value="1" />
<input name="" type="submit" class="button" value="изпрати бюлетина" />


</form>
