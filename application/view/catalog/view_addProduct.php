<h1>'Добавяне на продукти в категория: <?=$title?></h1> 
<?=$err?>
<?=$_SESSION['msg']?>
<?unset($_SESSION['msg'])?>
<br />
<a href="?c=catalog&m=addCategory" class="button">Добавяне на категории</a>


<select class="select" id="jumpMenu" name="category_id"  onchange="MM_jumpMenu('parent',this,0)">
	<option value="0">Отиди в  друга категория</option>
	<?
	if(!empty($menu)){
		foreach($menu as $key => $cat){
			if($c->data['edit']['id']!=$key){
				echo '<option value="?c=catalog&m=addItems&v='.$key.'">'.htmlspecialchars($cat[0]).'</option>';
			}
		}
	}
	?>
</select>


<hr />

<?if($_GET['editId']):?>
	<a href="?c=catalog&m=addItems&v=<?=$current_id?>" class="button">Нов продукт</a>
<?endif;?>

<div style="clear:both"></div><br />

<? if( !empty($images)):?>
	<h2>Снимки към продукта:</h2>
	<? foreach($images as $i):?>
    <div class="edit_img">
    	<div class="edit_img_img">
			<img src="<?=PATH?>/html/img/product/<?=$i['item_id']?>/crop_<?=$i['img']?>"  alt="" />
        </div>
        <div class="img_nav">
        	<p class="left"><a href="?c=catalog&m=defaultImg&v=<?=$info['id']?>&imgId=<?=$i['id']?>" class="button">Снимка по подразбиране</a></p>
            <p class="right"><a href="?c=catalog&m=deleteImg&v=<?=$info['id']?>&imgId=<?=$i['id']?>" class="confirm"><img src="<?=ADMIN?>/html/img/cross.png" alt="Delete"></a></p>
        </div>
    </div>
    <? endforeach;?>
    <div style="clear:both"></div>
    <hr />
<? endif;?>

<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">


<!--КАТЕГОРИИ-->
<div class="form_input">
	<p>Категория<span class="red">*</span></p>
</div>
<select class="select" name="category_id" >
	<option value="0">Избери категория</option>
	<?
	if(!empty($menu)){
		foreach($menu as $key => $cat){
			if($c->data['edit']['id']!=$key){
				echo '<option value="'.$key.'"';
				if ($current_id == $key) {
					echo 'selected=\"selected\"';
				}
				echo '>'.htmlspecialchars($cat[0]).'</option>';
			}
		}
	}
	?>
</select>





<!-- MARKI
<? if(C_MARKS == 'true'):?>
<div class="form_input">
	<p>Марка</p>
</div>
<select class="select" name="mark_id" >
	<option value="0">Избери марка</option>
	<?
	if(!empty($marks)){
		foreach($marks as $mark){
				echo '<option value="'.$mark['id'].'" ';
				if ($mark['id'] == $info['mark_id']) {
					echo 'selected="selected"';
				}
				echo ' >'.htmlspecialchars($mark['title_bg']).'</option>'."\n";
		}
	}
	?>
</select>
<br /><br />
<? endif?>
-->
<br />
<br />

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
        
            <!--ЗАГЛАВИЕ НА БЛЪГАРСКИ-->
            <div class="form_input">
                <p>Заглавие на български <span class="red">*</span></p>
                <div class="sing_form">
                    <input name="product_title_<?=$l['title']?>" type="text" value="<?=htmlspecialchars($info['title_'.$l['title']])?>" />
                </div>
            </div>
            
            <!--ТЕКСТ БЪЛГАРСКИ-->
            <p>Текст български <span class="red">*</span></p>
            <textarea name="product_content_<?=$l['title']?>" id="content_<?=$l['title']?>" class="ckeditor" cols="110" rows="20"><?=$info['content_'.$l['title']]?></textarea>
            
            
            <br />

            <div class="form_input">
                <p>Тайтъл</p>
                <div class="sing_form">
                    <input name="custom_title_<?=$l['title']?>" type="text" value="<?=htmlspecialchars($info['custom_title_'.$l['title']])?>" />
                </div>
        	</div>
            
            <div class="form_input">
                <p>Скрито описаниe</p>
                <div class="sing_form">
                    <textarea name="description_<?=$l['title']?>"  cols="50" rows="8"><?=htmlspecialchars($info['description_'.$l['title']])?></textarea>
                </div>
        	</div>
        
		</div>
     <? endforeach;?> 
     </div>


<br />

<!--URL-->
<div class="form_input">
	<p>URL адрес (позволени са само букви и цифри - не е задължително)</p>
    <div class="sing_form">
    	<input name="site_url" type="text" value="<?=htmlspecialchars($info['site_url'])?>" />
    </div>
</div>

<br />
<br />



<br />
<? if(C_PRICE == 'true'):?>
    <div class="form_input left" style="width:150px">
        <p>Цена лв<span class="red">*</span></p>
        <div class="sing_form form_input_small">
            <input name="price" type="text" width="5" value="<?=format_price($info['price'])?>" /> 
        </div>
    </div>
<? endif;?>


<? if(C_PRICE == 'true'):?>
    <div class="form_input left" style="width:150px">
        <p>Промо цена<span class="red">*</span></p>
        <div class="sing_form form_input_small">
            <input name="second_price" type="text" width="5" value="<?=format_price($info['second_price'])?>" /> 
        </div>
    </div>
<? endif;?>



<div style="clear:both"></div>


<? if(C_PROMOTION == 'true'):?>
    <br />
    Промоция: <input name="promotion" type="checkbox" value="1" 
    <? if($info['promotion'] == 1):?>
     checked="checked"
    <? endif;?>
     />  
<? endif;?>




<? if(C_PROMOTION == 'true'):?>
     | Изчерпано количество: <input name="sold" type="checkbox" value="1" 
    <? if($info['sold'] == 1):?>
     checked="checked"
    <? endif;?>
     /> 
<? endif;?>
<br /><br />



<!--СНИМКИ-->
<p>Снимка:</p>
<input name="pictures[]" type="file" /> 

<!--<input name="pictures[]" type="file" /> <input name="pictures[]" type="file" />
<br />
<input name="pictures[]" type="file" /> <input name="pictures[]" type="file" /> <input name="pictures[]" type="file" />-->
<br /><br />


<!--КЛИПЧЕ В TOUTUBE
<? if(C_YOUTUBE == 'true'):?>
    <div class="form_input">
        <p>Връзка с YouTube</p>
        <img src="<?=PATH?>/html/img/youtube.gif" width="445" height="22" alt=" " />
        <div class="sing_form">
            <input name="youtube" type="text" value="<?=$info['youtube']?>" />
        </div>
    </div>
    <br />
<? endif;?>-->

<input name="edit_product_id" type="hidden" value="<?=$info['id']?>" />
<input name="add_product" type="hidden" value="1" />
<input name="" value="запиши" type="submit" class="button" />

</form>







<div style="clear:both"></div>
<!-- ПОПЪЛНИНИТЕ ПРОДУКТИ ДО МОМЕНТА-->
<hr />
<h2>Добавени продукти в категория: <?=$title?></h2>
<? if( !empty($items)):?>
<div id="sortableOneLevel">
<form method="post" id="form-items" action="?c=catalog&m=itemsPosition&v=12"> 
    <ul>
    <? foreach($items as $m):?>
    <li id="recordsArray_<?=$m['id']?>"  class="sortable">
    <div class="ns-row">
        <div class="ns-title"><?=$m['title_bg']?></div>

		<!--<div class="ns-url">
			<a href="<?=ADMIN?>/?c=catalog&m=addCatOption&v=<?=$m['id']?>">Добави опции</a>
        </div>-->
        
        <div class="ns-price">
			<a href="<?=ADMIN?>/?c=catalog&m=addPrice&v=<?=$this->uri['var']?>&item_id=<?=$m['id']?>">Цени</a>
        </div>
        
        
        <div class="ns-actions">
        <a href="?c=catalog&m=deleteItems&v=<?=$m['cat_id']?>&id=<?=$m['id']?>" class="confirm">
       	 <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
        </a>
        
         <a href="?c=catalog&m=addItems&v=<?=$m['cat_id']?>&editId=<?=$m['id']?>">
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