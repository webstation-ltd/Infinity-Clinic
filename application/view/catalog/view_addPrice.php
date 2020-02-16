<h1>Добавяне на цени към: <?=$title?> </h1> 

<a href="?c=catalog&m=addItems&v=<?=$this->uri['var']?>">обратно</a>
<br />


<?=$_SESSION['msg']?>
<?unset($_SESSION['msg'])?>
<br />
<a href="?c=catalog&amp;m=addCategory" class="button">Добавяне на категории</a>

<div style="clear:both"></div><br />
<!--CATEGORY-FORM-->
<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post">


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
        <p>Име на ценовия пакет<span class="red">*</span></p>
        <div class="sing_form">
            <input name="price_name_<?=$l['title']?>" type="text" value="<?=$info['title_'.$l['title']]?>" />
        </div>
    </div>
 </div>
<? endforeach;?> 
<div style="clear:both"></div>
</div>
    
    
    
    
    
    <div class="form_input left" style="width:150px">
        <p>Цена<span class="red">*</span></p>
        <div class="sing_form form_input_small">
            <input name="price" type="text" width="5" value="<?=format_price($info['price'])?>" /> 
        </div>
    </div>
    
    <div style="clear:both"></div>
    
    <input name="edit_price_id" type="hidden" value="<?=$info['id']?>" />
    <input name="add_price" type="hidden" value="1" />
    <input name="" value="запиши" type="submit" class="button" />
</form>



<!--ДОБАВЯНЕ НА ОПЦИИ-->

<? if( !empty($prices)):?>
<div id="sortableOneLevel">
<form method="post" id="form-items" action="?c=catalog&m=pricePosition&v=12"> 
    <ul>
    <? foreach($prices as $m):?>
    <li id="recordsArray_<?=$m['id']?>"  class="sortable">
    <div class="ns-row">
        <div class="ns-title"><?=$m['title_bg']?> | <?=format_price($m['price'])?></div>

		       
        
        <div class="ns-actions">
        <a href="?c=catalog&m=addPrice&mode=delete&v=<?=$this->uri['var']?>&item_id=<?=$item_id?>&editId=<?=$m['id']?>" class="confirm">
       	 <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
        </a>
        
         <a href="?c=catalog&m=addPrice&mode=edit&v=<?=$this->uri['var']?>&item_id=<?=$item_id?>&editId=<?=$m['id']?>">
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