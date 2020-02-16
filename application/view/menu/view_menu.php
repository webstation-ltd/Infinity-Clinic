<h1><?=$title?></h1>
<?=$err?>

<br />
	<a href="?c=menu"> Менюта  </a>

    <? if($this->uri['method'] == 'editItem'){
    	echo ' > '.$info['title_bg'];
	}?>
<br /><br />


<? if(ADD_PAGES == 'true'):?>
<div id="category_menu">
	<? if($category_menu):?>
    <ul>
    <? foreach($category_menu as $cat):?>
    	<li class="button"><a href="?c=menu&amp;cat_id=<?=$cat['id']?>"><?=$cat['title']?></a></li>
    <? endforeach;?>
    </ul>
    <? endif?>
</div>

<div style="clear:both"></div>
<br />
<h2>Добавяне на съдържание към страниците: <?=$catMenuName['title']?></h2>


<form action="?c=menu&amp;m=addItems" method="post">
	 <!--tabmenu-->

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
                <p>Заглавие на бутона <span class="red">*</span></p>
                <div class="sing_form">
                    <input name="<?='title_'.$l['title']?>" type="text" value="<?=$info['title_'.$l['title']]?>" />
                </div>
            </div>

            <br />
            <div class="form_input">
                <p>Тайтъл на страницата</p>
                <div class="sing_form">
                    <input name="<?='custom_title_'.$l['title']?>" type="text" value="<?=$info['custom_title_'.$l['title']]?>" />
                </div>
            </div>

            <br />
            <p>Скрито описание за търсещите машини</p>
            <div class="sing_form">
            	<textarea name="<?='description_'.$l['title']?>" cols="" rows=""><?=$info['description_'.$l['title']]?></textarea>
            </div>

            </div>
			<? endforeach;?>
        </div>





    <br />

    <div class="form_input">
        Избор на parent страница:<br />
        <select name="parent_id">
        <option value="0"<?php if($info['d_parent_id'] == "0") { ?> selected="selected"<?php } ?>>Без parent страница</option>
        <option value="99"<?php if($info['d_parent_id'] == "99") { ?> selected="selected"<?php } ?>>Да не се показва в меню-то</option>
        <?php
        if(sizeof($menus) > 0) {
            foreach($menus AS $menu) {
                $selected = ($menu['id'] == $info['d_parent_id']) ? 'selected="selected"' : "";
                echo '<option value="'.$menu['id'].'" '.$selected.'>'.$menu['title_bg'].'</option>';
            }
        }
        ?>
        </select>
    </div>

    <br />

    <div class="form_input">
        <p>URL адрес  (позволени са само букви и цифри)</p>

        <div class="sing_form">
            <input name="site_url" type="text" value="<?=$info['site_url']?>" />
        </div>
    </div>
<input name="post_items" type="hidden" value="1" />
<input name="edit_id" type="hidden" value="<?=$info['id']?>" />
<input name="cat_id" type="hidden" value="<?=$catMenuName['id']?>" />
<input name="" type="submit" class="button" value="Запиши" />
</form>
<? endif;?>

<br />
<br />
<form method="post" id="form-menu" action="?c=menu&amp;m=save_position">
<?=$menu_items?>

<div id="ns-footer">
        <button type="submit" class="button green small" id="btn-save-menu">Запази промените</button>
    </div>
</form>