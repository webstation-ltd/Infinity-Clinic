<h1><?=$title?></h1> 
<?=$err?>

<?=$_SESSION['msg']?>
<?unset($_SESSION['msg'])?>

<br />
<a href="?c=catalog&amp;m=addCategory" class="button">Добавяне на категории</a>
<a href="?c=catalog&amp;m=marks" class="button">Марки</a>

<br /><br />




<form action="?c=catalog&amp;m=addCategory" method="post" enctype="multipart/form-data">

<div class="form_input">
	<p>Заглавие на категорията български <span class="red">*</span></p>
</div>
<select class="select" name="category_id" >
	<option value="0">Главна категория</option>
	<?
	if(!empty($menu)){
		foreach($menu as $key => $cat){
			if($c->data['edit']['id']!=$key){
				echo '<option value="'.$key.'"';
				if ($info['parent_id'] == "$key") {
					echo 'selected=\"selected\"';
				}
				echo '>'.$cat[0].'</option>';
			}
		}
	}
	?>
</select>


<div style="clear:both"></div>
<br />


<!--tabmenu-->
<div class="tab_menu">
    <ul class="tab_menu">
        <? foreach( $this->langs as $l):?>
            <li><?=$l['content']?></li>
        <? endforeach;?>
     </ul>
</div>

<div style="clear:both"></div>
    <div id="tab_container"><!--NEWS-->
   	<? foreach( $this->langs as $l):?>
        <div class="tab_content round4">
        <!-- ИМЕ НА КАТЕГОРИЯТА/БУТОН БЪЛГАРСКИ -->
        <div class="form_input left">
            <p>Заглавие на категорията<span class="red">*</span></p>
            <div class="sing_form">
                <input name="title_<?=$l['title']?>" type="text" value="<?=$info['title_'.$l['title']]?>" />
            </div>
        </div>
        
        
        <!-- ТАЙТЪЛ БЪЛГАРСКИ-->
        <div class="form_input left">
            <p>Тайтъл</p>
            <div class="sing_form">
                <input name="custom_title_<?=$l['title']?>" type="text" value="<?=$info['custom_title_'.$l['title']]?>" />
            </div>
        </div>
        
        <!-- СЕО ДЕСКРИПШЪН БЪЛГАРСКИ-->
        <div class="form_input left">
            <p>Скрито описани<span class="red">*</span></p>
            <div class="sing_form">
                <textarea name="description_<?=$l['title']?>"  cols="50" rows="8"><?=$info['description_'.$l['title']]?></textarea>
            </div>
        </div>
        
        
        <div style="clear:both"></div>
        
        <textarea name="content_<?=$l['title']?>" class="ckeditor"  cols="50" rows="8"><?=$info['content_'.$l['title']]?></textarea>
                
        </div>
	<? endforeach;?>
</div>

<div style="clear:both"></div>
<br />

        
<!-- URL АДРЕС-->
<div class="form_input">
	<p>URL адрес на категорията (позволени са само букви и цифри)</p>
    <div class="sing_form">
   		 <input name="site_url" type="text" value="<?=$info['site_url']?>" />	
    </div>
</div>


<!--СНИМКИ-->
<p>Снимка:</p>
<input name="pictures[]" type="file" />
<div style="clear:both"></div>
<br />


<input name="edit_cat_id" type="hidden" value="<?=$info['id']?>" />
<input name="add_cat" type="hidden" value="1" />
<input name="" value="запиши" type="submit" class="button" />
</form>

<br />
<hr />
        

<? /////////////////////////MENU/////////////////////////////?>
<form method="post" id="form-menu" action="?c=catalog&m=save_position">

    <?=$sortable_menu?>
    <div id="ns-footer">
        <button type="submit" class="button green small" id="btn-save-menu">Запази промените</button>
    </div>
</form>
        
<div id="#contentRight"></div>

