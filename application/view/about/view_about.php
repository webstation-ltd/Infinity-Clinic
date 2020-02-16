<h1><?=$title?></h1> 
<form action="?c=about&m=update" method="post">

<p>Текст български <span class="red">*</span></p>
<textarea name="content_bg" id="content_bg" class="ckeditor" cols="110" rows="20"><?=$content_bg?></textarea>

<input name="edit_id" type="hidden" value="<?=$edit_id?>" />
<input name="post_news" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши" />
</form>

<hr />

<?if(!empty($getNews)):?>
	<table>
    <tr>
    	<td>Новина</td>
        <td>Редакция</td>
        <td>Изтриване</td>
        <td>Сортиране</td>
    </tr>
	<?foreach($getNews as $news):?>
     <tr>
    	<td><?=$news['title_bg']?></td>
        <td><a href="?c=news&m=edit&v=<?=$news['id']?>">Редакция</a></td>
        <td><a href="?c=news&m=delete&v=<?=$news['id']?>">Изтриване</a></td>
        <td><? helper::arrows($news['myorder'], $min, $max, 'news') ?></td>
    </tr>
    <?endforeach;?>
    </table>
<?endif;?>
