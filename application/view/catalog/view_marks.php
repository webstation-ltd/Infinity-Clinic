<h1><?=$title?></h1> 
<?=$err?>
<?=$_SESSION['msg']?>
<?unset($_SESSION['msg'])?>
<br />
<a href="?c=catalog&amp;m=addCategory" class="button">Добавяне на категории</a>
<a href="?c=catalog&amp;m=marks" class="button">Марки</a>


<div style="clear:both"></div><br />



<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">


<div class="form_input">
	<p>Заглавие на марката български <span class="red">*</span></p>
    <div class="sing_form">
    	<input name="mark_title_bg" type="text" value="<?=$info['title_bg']?>" />
    </div>
</div>

<? if(EN=='true'):?>
<div class="form_input">
	<p>Заглавие на марката английски <span class="red">*</span></p>
    <div class="sing_form">
    	<input name="mark_title_en" type="text" value="<?=$info['title_en']?>" />
    </div>
</div>
<? endif;?>
<br />

<strong>Лого на марката:</strong><br />
<input name="pictures[]" type="file" />

<br />

<input name="edit_mark_id" type="hidden" value="<?=$info['id']?>" />
<input name="add_marks" type="hidden" value="1" />
<input name="" value="запиши" type="submit" class="button" />

</form>



<? if($items):?>
<br />
<br />

<div id="sortableOneLeveljj">
    <ul>
    <? foreach($items as $m):?>
    <li id="recordsArray_<?=$m['id']?>"  class="sortable">
    <div class="ns-row">
        <div class="ns-title"><?=$m['title_bg']?></div>
        <div class="ns-actions">
        <a href="?c=catalog&m=marks&mode=delete&edit_mark_id=<?=$m['id']?>" class="confirm">
       	 <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
        </a>
        
         <a href="?c=catalog&m=marks&mode=edit&edit_mark_id=<?=$m['id']?>">
            <img src="<?=ADMIN?>/html/img/edit.png" alt="Edit">
        </a>
        </div>
    </div>
    <? endforeach;?>
    </ul>
    
    <div id="ns-footer">
    </div>
    </form>
    <div id="contentRight"></div>
</div>
<? endif?>