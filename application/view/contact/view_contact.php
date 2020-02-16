<h1><?=$title?></h1> 
<?=$err?>
<?=$_SESSION['msg']?>
<?unset($_SESSION['msg'])?>

<form action="?c=contact&m=add&menu_id=<?=$menu_id?>" method="post">

<? if( count($this->langs) > 1 ):?>
    <div class="tab_menu">
        <ul class="tab_menu">
            <? foreach( $this->langs as $l):?>
                <li><?=stripslashes($l['content']);?></li>
            <? endforeach;?>
         </ul>
    </div>
<? endif;?> 


<div style="clear:both"></div>

<div id="tab_container"><!--CONTACTS-->
<? foreach( $this->langs as $l):?>
<div class="tab_content round4">
    <p>Текст български <span class="red">*</span></p>
    <textarea name="content_<?=$l['title']?>" id="content_<?=$l['title']?>" class="ckeditor" cols="110" rows="20"><?=stripslashes($edit['content_'.$l['title']]);?></textarea>
    
    
</div>
<? endforeach;?>
</div>



<input name="edit_id" type="hidden" value="<?=$edit_id?>" />
<input name="post_contact" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши" />
</form>




