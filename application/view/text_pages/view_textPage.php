<h1><?=$title?></h1> 

<form action="?c=textPages&m=add&menu_id=<?=$menu_id?>" method="post">

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


</div>

<? foreach( $this->langs as $l):?>
    <div class="tab_content round4">
    
    <p>Текст (над таблицата)<span class="red">*</span></p>
    <textarea name="content_<?=$l['title']?>" id="content_<?=$l['title']?>" class="ckeditor" cols="110" rows="20">
	<?=stripslashes($edit['content_'.$l['title']]);?>
    </textarea>
    <br /><br />
    <p>Текст (под таблицата)<span class="red">*</span></p>
    <textarea name="content_foot_<?=$l['title']?>" id="content_foot_<?=$l['title']?>" class="ckeditor" cols="110" rows="20">
    <?=stripslashes($edit['content_foot_'.$l['title']]);?>
    </textarea>
   <br /><br />
   <p>Свързани продукти<span class="red">*</span></p>
    <textarea name="related_products_<?=$l['title']?>" id="related_products_<?=$l['title']?>" class="ckeditor" cols="110" rows="20">
    <?=stripslashes($edit['related_products_'.$l['title']]);?>
    </textarea>
   <br /><br />
   <p>Видео<span class="red">*</span></p>
    <textarea name="video_<?=$l['title']?>" id="video_<?=$l['title']?>" class="ckeditor" cols="110" rows="20">
    <?=stripslashes($edit['video_'.$l['title']]);?>
    </textarea>
   <br /><br />
   <?php
       if($menu_id == "17") {
   ?>
   <textarea name="own_table_<?php echo $l['title']; ?>" id="own_table_<?php echo $l['title']; ?>" class="ckeditor" cols="110" rows="20">
    <?=stripslashes($edit['own_table_'.$l['title']]);?>
    </textarea>
   <br /><br />
   <?php
       }
   ?>
   <p>Специален H1 текст</p>
   
   <div class="sing_form">
   <input type="text" name="special_h1_<?php echo $l['title']; ?>" value="<?php echo $edit['special_h1_'.$l['title']]; ?>" />
   </div>
   <br /><br />
   <p>Специален текст(под H1)</p>
   <div class="sing_form">
   <input type="text" name="special_text_<?php echo $l['title']; ?>" value="<?php echo $edit['special_text_'.$l['title']]; ?>" />
   </div>
   <br /><br />
   <div class="round4" style="border: 1px solid #CCCCCC; padding: 10px;">
   <p>Най-добри оферти №1</p><br /><p>Заглавие</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_1_text" value="<?php echo $edit['best_offer_'.$l['title'].'_1_text']; ?>" />
   </div>
   <p>Цена</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_1_price" value="<?php echo $edit['best_offer_'.$l['title'].'_1_price']; ?>" />
   </div>
   </div><br />
   <div class="round4" style="border: 1px solid #CCCCCC; padding: 10px;">
   <p>Най-добри оферти №2</p><br /><p>Заглавие</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_2_text" value="<?php echo $edit['best_offer_'.$l['title'].'_2_text']; ?>" />
   </div>
   <p>Цена</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_2_price" value="<?php echo $edit['best_offer_'.$l['title'].'_2_price']; ?>" />
   </div>
   </div><br />
   <div class="round4" style="border: 1px solid #CCCCCC; padding: 10px;">
   <p>Най-добри оферти №3</p><br /><p>Заглавие</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_3_text" value="<?php echo $edit['best_offer_'.$l['title'].'_3_text']; ?>" />
   </div>
   <p>Цена</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_3_price" value="<?php echo $edit['best_offer_'.$l['title'].'_3_price']; ?>" />
   </div>
   </div><br />
   <div class="round4" style="border: 1px solid #CCCCCC; padding: 10px;">
   <p>Най-добри оферти №4</p><br /><p>Заглавие</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_4_text" value="<?php echo $edit['best_offer_'.$l['title'].'_4_text']; ?>" />
   </div>
   <p>Цена</p>
   <div class="sing_form">
   <input type="text" name="best_offer_<?php echo $l['title']; ?>_4_price" value="<?php echo $edit['best_offer_'.$l['title'].'_4_price']; ?>" />
   </div>
   </div><br />
   
   </div>
   
<? endforeach;?>

<br />

<div class="form_input">
    <p>Връзка с YouTube</p>
    <img src="<?=PATH?>/html/img/youtube.gif" width="445" height="22" alt=" " />
    <div class="sing_form">
        <input name="youtube" type="text" value="<?=$edit['youtube']?>" />
    </div>
</div>
        
        
<input name="edit_id" type="hidden" value="<?=$edit['id']?>" />
<input name="post_page" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши" />
&nbsp;&nbsp;&nbsp;&nbsp;<a class="button" href="/admin/?c=textPages&m=viewPrices&menu_id=<?php echo $menu_id; ?>">Управление цени</a>
<a class="button" href="/admin/?c=textPages&m=viewFaq&menu_id=<?php echo $menu_id; ?>">Управление FAQ</a>
</form>


    <br />
<!--    <h2>Галерия</h2>
    <form action="?c=textPages&m=add&menu_id=<?=$menu_id?>" method="post">
    <input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><br />
    <input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><input name="pictures[]" type="file" />
    <br />
    <input name="add_img" type="hidden" value="1" />
    <input name="" type="submit" class="button" value="запиши снимките" />
    </form>-->
