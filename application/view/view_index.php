<h1><?=$title?></h1> 

<form action="?c=index&m=add&menu_id=<?=$menu_id?>" method="post">


<? if( count($this->langs) > 1 ):?>
    <div class="tab_menu">
        <ul class="tab_menu">
            <? foreach( $this->langs as $l):?>
                <li><?=$l['content']?></li>
            <? endforeach;?>
         </ul>
    </div>
<? endif;?>


<div style="clear:both"></div>
<div id="tab_container"><!--NEWS-->
<? foreach( $this->langs as $l):?>
<div class="tab_content round4">
    <p>Текст<span class="red">*</span></p>
    <textarea name="content_<?=$l['title']?>" id="content_<?=$l['title']?>" class="ckeditor" cols="110" rows="20"><?=$edit['content_'.$l['title']]?></textarea>
    
    
    <p>Лява кутийка</p>
    <div class="sing_form">
    <textarea name="box_left_<?=$l['title']?>"  class="ckeditor" cols="115" rows="8"><?=stripslashes($edit['box_left_'.$l['title']]);?></textarea>
    </div>
    
    <p>Дясна кутийка</p>
    <div class="sing_form">
    <textarea name="box_right_<?=$l['title']?>" class="ckeditor" cols="115" rows="8"><?=stripslashes($edit['box_right_'.$l['title']]);?></textarea>
    </div>
    
    <p>Нова</p>
    <div class="sing_form">
    <textarea name="box_new_<?=$l['title']?>" class="ckeditor" cols="115" rows="8"><?=stripslashes($edit['box_new_'.$l['title']]);?></textarea>
    </div>
    
    
    <br />
    <p>Скрито описание за търсещи машини</p>
    <div class="sing_form">
    <textarea name="description_<?=$l['title']?>" cols="115" rows="8"><?=stripslashes($edit['description_'.$l['title']]);?></textarea>
    </div>
    
    <br />

     <div class="form_input">
        <p>Тайтъл <span class="red">*</span></p>
        <div class="sing_form">
            <input name="title_<?=$l['title']?>" type="text" value="<?=$edit['title_'.$l['title']]?>" />
        </div>
    </div>
    
    
</div>
<? endforeach;?>
</div>



<input name="edit_id" type="hidden" value="<?=$edit['id']?>" />
<input name="post_page" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши" />
</form>