<?=$err?>

<form action="?c=gallery&menu_id=<?=$menu_id?>" method="post" enctype="multipart/form-data">

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
        <div class="form_input">
            <p>Заглавие на галерията<span class="red">*</span></p>
            <div class="sing_form">
                <input name="title_<?=$l['title']?>" type="text" value="<?=$info['title_'.$l['title']]?>" />
            </div>
        </div>
        <p>Описание на галерията</p>
        <textarea name="content_<?=$l['title']?>"  cols="80" rows="8"><?=stripslashes($info['content_'.$l['title']]);?></textarea>
        <br /><br />
		</div>
     <? endforeach;?> 
     
     </div>

<br />

<div class="form_input">
	<p>Урл адрес (не е задължително)</p>
    <div class="sing_form">
    	<input name="site_url" type="text" value="<?=$info['site_url']?>" />
    </div>
</div>


<br />

<p><input name="active" type="checkbox" value="1" checked="checked" /> Активна</p>


<input name="edit_id" type="hidden" value="<?=$info['id']?>" />
<input name="post_gallery" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши" />
</form>



<!-- ПОПЪЛНИНИТЕ ПРОДУКТИ ДО МОМЕНТА-->
<? if( !empty($items)):?>
<div id="sortableOneLevel">
<form method="post" id="form-items" action="?c=gallery&menu_id=<?=$menu_id?>&m=catPosition"> 
    <ul>
    <? foreach($items as $m):?>
    <li id="recordsArray_<?=$m['id']?>"  class="sortable">
    <div class="ns-row">
        <div class="ns-title"><?=$m['title_bg']?></div>


		<div class="ns-url">
       	 <a href="<?=ADMIN?>?c=gallery&m=addImages&v=<?=$m['id']?>&menu_id=<?=$menu_id?>">Добавяне на снимки</a>
		</div>

		
        <div class="ns-actions">
           
        <a href="?c=gallery&m=deleteCat&v=<?=$m['cat_id']?>&id=<?=$m['id']?>&menu_id=<?=$menu_id?>" class="confirm">
       	 <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
        </a>
        
         <a href="?c=gallery&m=editCat&v=<?=$m['cat_id']?>&editId=<?=$m['id']?>&menu_id=<?=$menu_id?>">
            <img src="<?=ADMIN?>/html/img/edit.png" alt="Edit">
        </a>
        <input type="hidden" name="menu_id" value="<?=$m['id']?>">
        </div>
    </div>
    <? endforeach;?>
    </ul>
    
    <div id="ns-footer">
      <button type="submit" class="button green small" id="btn-save-items">Запази промените</button>
    </div>
    </form>
    <div id="contentRight"></div>
</div>
<? endif;?>

