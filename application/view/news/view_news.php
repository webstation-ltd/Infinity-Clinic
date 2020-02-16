<h1><?=$title?></h1>
<?=$err?>

<br />
	<a href="?c=news&menu_id=<?=$menu_id?>"> <?=$title?>  </a>

    <? if($this->uri['method'] == 'edit'){
    	echo ' > '.$edit['title_bg'];
	}?>
<br /><br />





<div style="clear:both"></div>

        <form action="?c=news&m=addNews&menu_id=<?=$menu_id?>" method="post" enctype="multipart/form-data">
        <!--tabmenu-->
		<? if( count($this->langs) > 1 ):?>
            <div class="tab_menu">
                <ul class="tab_menu">
                    <? foreach( $this->langs as $l):?>
                        <li><?=stripcslashes($l['content'])?></li>
                    <? endforeach;?>
                 </ul>
            </div>
        <? endif;?>


        <div style="clear:both"></div>
        <div id="tab_container"><!--NEWS-->
			<? foreach( $this->langs as $l):?>
            <div class="tab_content round4">
            <div class="form_input">
                <p>Заглавие на новината <span class="red">*</span></p>
                <div class="sing_form">
                    <input name="<?='title_'.$l['title']?>" type="text" value="<?=$edit['title_'.$l['title']]?>" />
                </div>
            </div>

            <p>Текст към новината <span class="red">*</span></p>
            <textarea name="content_<?=$l['title']?>" id="content_<?=$l['title']?>" class="ckeditor" cols="110" rows="20"><?=stripcslashes($edit['content_'.$l['title']]);?></textarea>

            </div>
            <? endforeach;?>
		</div>

        <p><input name="active" type="checkbox" value="1" checked /> Активна</p>

        <p>Снимка:</p>
        <p><input name="pictures[]" type="file" /></p>

        <br />

        <div class="form_input">
            <p>Връзка с YouTube</p>
            <img src="<?=PATH?>/html/img/youtube.gif" width="445" height="22" alt=" " />
            <div class="sing_form">
                <input name="youtube" type="text" value="<?=$edit['youtube']?>" />
            </div>
        </div>
    	<br />


        <input name="edit_id" type="hidden" value="<?=$edit['id']?>" />
        <input name="post_news" type="hidden" value="1" />
        <input name="" type="submit" class="button" value="запиши новината" />
        </form>


	<? if( $this->uri['method'] == 'edit'):?>
    <br />
    <h2>Галерия към новината</h2>
    <form action="?c=news&m=addImages&v=<?=$edit['id']?>&menu_id=<?=$menu_id?>" method="post" enctype="multipart/form-data">
    <input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><br />
    <input name="pictures[]" type="file" /><input name="pictures[]" type="file" /><input name="pictures[]" type="file" />
    <br />
    <input name="add_img" type="hidden" value="1" />
    <input name="" type="submit" class="button" value="запиши снимките" />
    </form>
    <? endif;?>





<!-- ПОПЪЛНИНИТЕ СНИМКИ ДО МОМЕНТА-->
<? if( !empty($images)):?>
<br />

<div id="sortableOneLevel">
<form method="post" id="form-items" action="?c=news&m=imgPosition&v=<?=$edit['id']?>&menu_id=<?=$menu_id?>">
    <ul>

    <? foreach($images as $m):?>
    <li id="recordsArray_<?=$m['id']?>"  class="ui-state-default">
    	<div class="ns-row-img">
        <img src="<?=PATH?>/html/img/news/<?=$edit['id']?>/crop_<?=$m['img']?>"  />
        <input type="hidden" name="menu_id" value="<?=$m['id']?>">
            <div class="ns-actions-img">
                <a href="?c=news&m=deleteGalImg&v=<?=$m['id']?>&menu_id=<?=$menu_id?>" class="confirm">
                 <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
                </a>
            </div>
        </div>
    </li>

    <? endforeach;?>
    </ul>

    <div style="clear:both"></div>

    <div id="ns-footer">
      <button type="submit" class="button green small" id="btn-save-items">Запази промените</button>
    </div>
    </form>
    <div id="contentRight"></div>
</div>
<? endif;?>




  <hr />

    <!-- ПОПЪЛНИНИТЕ НОВИНИ ДО МОМЕНТА-->
<? if( !empty($getNews)):?>
    <div id="sortableOneLevel">
    <form method="post" id="form-items" action="?c=news&menu_id=<?=$menu_id?>&m=newsPosition">
        <ul>
        <? foreach($getNews as $m):?>
        <li id="recordsArray_<?=$m['id']?>"  class="sortable">
        <div class="ns-row">
            <div class="ns-title"><?=$m['title_bg']?></div>


            <div class="ns-actions">

            <a href="?c=news&m=delete&v=<?=$m['id']?>&menu_id=<?=$menu_id?>" class="confirm">
             <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
            </a>

             <a href="?c=news&m=edit&v=<?=$m['id']?>&menu_id=<?=$menu_id?>">
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





</div>