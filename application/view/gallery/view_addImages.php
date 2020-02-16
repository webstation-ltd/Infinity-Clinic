<h2>Добавяне на снимки в галерия:  <?=$catName?></h2>
<?=$err?>
<a href="<?=ADMIN?>/?c=gallery&menu_id=<?=$menu_id?>" class="button">Списък с галерии</a>
<br /><br />


<form action="?c=gallery&m=addImages&v=<?=$gal_id?>&menu_id=<?=$menu_id?>" method="post" enctype="multipart/form-data">

<input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><br />
<input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><input name="pictures[]" type="file" />
<br />

<input name="add_img" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши снимките" />
</form>


	
	
<!-- ПОПЪЛНИНИТЕ ПРОДУКТИ ДО МОМЕНТА-->
<? if( !empty($items)):?>
<br />

<div id="sortableOneLevel">
<form method="post" id="form-items" action="?c=gallery&m=imgPosition&menu_id=<?=$menu_id?>"> 
    <ul>
    
    <? foreach($items as $m):?>
    <li id="recordsArray_<?=$m['id']?>"  class="ui-state-default">
    	<div class="ns-row-img">
        <img src="<?=PATH?>/html/img/gallery/<?=$gal_id?>/crop_<?=$m['img']?>"  />
        <input type="hidden" name="menu_id" value="<?=$m['id']?>">
            <div class="ns-actions-img">
                <a href="?c=gallery&m=deleteImages&v=<?=$m['id']?>&menu_id=<?=$menu_id?>" class="confirm">
                 <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
                </a>
            </div>
        </div>
    </li>
    
    <? endforeach;?>
    </ul>
    
    <div style="clear:both"></div>
    <br />

    <div id="ns-footer">
      <button type="submit" class="button green small" id="btn-save-items">Запази промените</button>
    </div>
    </form>
    <div id="contentRight"></div>
</div>
<? endif;?>
