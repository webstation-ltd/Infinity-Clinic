<h1>Добавяне на опции към: <?=$item_title?></h1> 
<?=$err?>
<?=$_SESSION['msg']?>
<?unset($_SESSION['msg'])?>
<br />
<a href="?c=catalog&amp;m=addCategory" class="button">Добавяне на категории</a>
<a href="?c=catalog&amp;m=marks" class="button">Марки</a>

<div style="clear:both"></div><br />

<!--CATEGORY-FORM-->
<form action="<?=$_SERVER['REQUEST_URI'];?>" method="post">
    <div class="form_input">
        <p>Име на опцията<span class="red">*</span></p>
        <div class="sing_form">
            <input name="OptionCat_title_bg" type="text" value="<?=$ditOptions['title_bg']?>" />
        </div>
    </div>
    
    <? if(EN=='true'):?>
    <div class="form_input">
        <p>Име на опцията<span class="red">*</span></p>
        <div class="sing_form">
            <input name="OptionCat_title_en" type="text" value="<?=$editCatInfo['title_en']?>" />
        </div>
    </div>
    <? endif;?>
    
    <input name="edit_CatOption_id" type="hidden" value="<?=$editCatInfo['id']?>" />
    <input name="add_optionCat" type="hidden" value="1" />
    <input name="" value="запиши" type="submit" class="button" />
</form>



<!--ДОБАВЯНЕ НА ОПЦИИ-->
<? if( !empty($optionCat) ):?>
	<hr  />
	
   <h3> Добавяне на опции:</h3>
	Избери Категория:
    <form action="<?=$_SERVER['REQUEST_URI'];?>" method="post">
        <select name="options" id="options">
            <option value="0">Избери категория</option>
            <?foreach($optionCat as $cat):?>
            <option value="<?=$cat['id']?>" 
			<?=$selected = $editOptions['cat_id'] == $cat['id'] ? 'selected="selected"' : '' ?>><?=$cat['title_bg']?></option> 	
            <?endforeach?>
        </select>
        
        <div class="form_input">
            <p>Име на опцията<span class="red">*</span></p>
            <div class="sing_form">
                <input name="option_title_bg" type="text" value="<?=$editOptions['title_bg']?>" />
            </div>
        </div>
        
        <? if(EN=='true'):?>
        <div class="form_input">
            <p>Име на опцията<span class="red">*</span></p>
            <div class="sing_form">
                <input name="option_title_en" type="text" value="<?=$editOptions['title_en']?>" />
            </div>
        </div>
        <? endif;?>
    
        <input name="edit_option_id" type="hidden" value="<?=$editOptions['id']?>" />
        <input name="add_option" type="hidden" value="1" />
        <input name="" value="запиши" type="submit" class="button" />
    </form>
<? endif;?>



<? foreach($options as $o):?>
	<div class="ns-row"><strong><?=$o['cat']?></strong>
        <div class="ns-actions"><!--CATEGORIES-->
            <a href="?c=catalog&m=deleteOptionCat&v=<?=$o['id']?>" class="confirm">
            <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
            </a>
            
            <a href="?c=catalog&m=addCatOption&v=<?=$item_id?>&editId=<?=$o['id']?>&mode=editCat">
            <img src="<?=ADMIN?>/html/img/edit.png" alt="Edit">
            </a>
        </div>
    </div>
    
    
        <?foreach($o['cat_items'] as $i):?><!--CATEGORIES-->
            <div class="ns-row">
            - <?=$i['title_bg']?>
            
            <div class="ns-actions"><!--CATEGORIES-->
            
                <a href="?c=catalog&m=deleteOption&v=<?=$i['id']?>" class="confirm">
               		<img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
                </a>
                
                <a href="?c=catalog&m=addCatOption&v=<?=$item_id?>&editId=<?=$i['id']?>&mode=editOption">
                	<img src="<?=ADMIN?>/html/img/edit.png" alt="Edit">
                </a>
                
            </div>
            </div>
        <?endforeach;?>
    
<? endforeach; ?>