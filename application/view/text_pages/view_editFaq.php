<h1><?=$title?></h1> 
<br /><a class="button" href="/admin/?c=textPages&m=viewFaq&menu_id=<?php echo $_GET['menu_id']; ?>">Върни се назад</a><br /><br />
<form action="" method="post">

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
     
       <p>Въпрос</p><br />
       <div class="sing_form">
       <input type="text" name="question_<?php echo $l['title']; ?>" value="<?php echo $questions[$l['title']]; ?>" />
       </div>
       
       <p>Отговор<span class="red">*</span></p>
        <textarea name="answer_<?=$l['title']?>" id="answer_<?=$l['title']?>" class="ckeditor" cols="110" rows="20">
        <?=stripslashes($answers[$l['title']]);?>
        </textarea>
        <br /><br />
       
   </div>
   
<? endforeach;?>


<input name="submit" type="submit" class="button" value="запиши" />
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
