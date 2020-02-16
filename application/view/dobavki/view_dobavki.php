<h1><?=$title?></h1> 
<?=$err?>



<h2>Добавяне на съдържание към страниците: <?=$catMenuName['title']?></h2>


<form action="?c=dobavki" method="post">
    <div class="form_input left">
        <p>Заглавие на бутона български <span class="red">*</span></p>
        
        <div class="sing_form">
            <input name="title_bg" type="text" value="<?=$info['title_bg']?>" />
        </div>
    </div>
    
    <? if(EN == 'true'): ?>
    <div class="form_input right">
        <p>Заглавие на бутона английски <span class="red">*</span></p>
        
        <div class="sing_form">
            <input name="title_en" type="text" value="<?=$info['title_en']?>" />
        </div>
    </div>
    <? endif;?>
    
    
    <div class="form_input">
        <p>Цена:</p>
        
        <div class="sing_form">
            <input name="price" type="text" value="<?=$info['price']?>" />
        </div>
    </div>
<input name="post_dobavki" type="hidden" value="1" />
<input name="edit_id" type="hidden" value="<?=$info['id']?>" />
<input name="" type="submit" class="button" value="Запиши" />
</form>


<br />
<? if( !empty($dobavki)):?>
<div id="sortableOneLevel">
<form method="post" id="form-items" action="?c=dobavki&m=itemsPosition"> 
    <ul>
    <? foreach($dobavki as $m):?>
    <li id="recordsArray_<?=$m['id']?>"  class="sortable">
    <div class="ns-row">
        <div class="ns-title"><?=$m['title_bg']?></div>

     
       
        
        <div class="ns-actions">
        <a href="?c=dobavki&m=deleteItems&v=<?=$m['cat_id']?>&id=<?=$m['id']?>" class="confirm">
       	 <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
        </a>
        
         <a href="?c=dobavki&m=editItems&v=<?=$m['cat_id']?>&editId=<?=$m['id']?>">
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