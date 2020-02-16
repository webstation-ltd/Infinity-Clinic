<h1><?=$title?></h1> 
<br /><a class="button" href="/admin/?c=textPages&m=viewPrices&menu_id=<?php echo $_GET['menu_id']; ?>">Върни се назад</a><br /><br />
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
     
       <p>Заглавие на услугата</p><br />
       <div class="sing_form">
       <input type="text" name="title_<?php echo $l['title']; ?>" value="<?php echo $titles[$l['title']]; ?>" />
       </div>
       
       <p>Специален текст</p><br />
       <div class="sing_form">
       <input type="text" name="special_text_<?php echo $l['special_text']; ?>" value="<?php echo $sp[$l['special_text']]; ?>" />
       </div>
   </div>
   
<? endforeach;?>
<br /><br />
<p>Цена на услугата (1 терапия)</p><br />
       <div class="sing_form">
       <input type="text" name="price" value="<?php echo $price; ?>" />
       </div>
<br />
<p>Цвят на полето (1 терапия) (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color" value="<?php echo $color; ?>" />
       </div>
<br />

<p>Цена за 2 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_2_procedures" value="<?php echo $price_2_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 2 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_2_procedures" value="<?php echo $color_2_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 2 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_2_procedures" value="<?php echo $percent_2_procedures; ?>" />
       </div>
<br />

<p>Цена за 3 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_3_procedures" value="<?php echo $price_3_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 3 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_3_procedures" value="<?php echo $color_3_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 3 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_3_procedures" value="<?php echo $percent_3_procedures; ?>" />
       </div>
<br />

<p>Цена за 4 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_4_procedures" value="<?php echo $price_4_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 4 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_4_procedures" value="<?php echo $color_4_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 4 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_4_procedures" value="<?php echo $percent_4_procedures; ?>" />
       </div>
<br />

<p>Цена за 5 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_5_procedures" value="<?php echo $price_5_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 5 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_5_procedures" value="<?php echo $color_5_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 5 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_5_procedures" value="<?php echo $percent_5_procedures; ?>" />
       </div>
<br />

<p>Цена за 6 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_6_procedures" value="<?php echo $price_6_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 6 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_6_procedures" value="<?php echo $color_6_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 6 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_6_procedures" value="<?php echo $percent_6_procedures; ?>" />
       </div>
<br />

<p>Цена за 7 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_7_procedures" value="<?php echo $price_7_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 7 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_7_procedures" value="<?php echo $color_7_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 7 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_7_procedures" value="<?php echo $percent_7_procedures; ?>" />
       </div>
<br />

<p>Цена за 8 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_8_procedures" value="<?php echo $price_8_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 8 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_8_procedures" value="<?php echo $color_8_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 8 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_8_procedures" value="<?php echo $percent_8_procedures; ?>" />
       </div>
<br />

<p>Цена за 9 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_9_procedures" value="<?php echo $price_9_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 9 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_9_procedures" value="<?php echo $color_9_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 9 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_9_procedures" value="<?php echo $percent_9_procedures; ?>" />
       </div>
<br />

<p>Цена за 10 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_10_procedures" value="<?php echo $price_10_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 10 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_10_procedures" value="<?php echo $color_10_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 10 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_10_procedures" value="<?php echo $percent_10_procedures; ?>" />
       </div>
<br />

<p>Цена за 11 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_11_procedures" value="<?php echo $price_11_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 11 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_11_procedures" value="<?php echo $color_11_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 11 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_11_procedures" value="<?php echo $percent_11_procedures; ?>" />
       </div>
<br />

<p>Цена за 12 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_12_procedures" value="<?php echo $price_12_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 12 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_12_procedures" value="<?php echo $color_12_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 12 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_12_procedures" value="<?php echo $percent_12_procedures; ?>" />
       </div>
<br />

<p>Цена за 13 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_13_procedures" value="<?php echo $price_13_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 13 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_13_procedures" value="<?php echo $color_13_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 13 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_13_procedures" value="<?php echo $percent_13_procedures; ?>" />
       </div>
<br />

<p>Цена за 14 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_14_procedures" value="<?php echo $price_14_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 14 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_14_procedures" value="<?php echo $color_14_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 14 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_14_procedures" value="<?php echo $percent_14_procedures; ?>" />
       </div>
<br />

<p>Цена за 15 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="price_15_procedures" value="<?php echo $price_15_procedures; ?>" />
       </div>
<br />
<p>Цвят на полето за 15 терапии (#b90000)</p><br />
       <div class="sing_form">
       <input type="text" name="color_15_procedures" value="<?php echo $color_15_procedures; ?>" />
       </div>
<br />
<p>Процент намаление за 15 терапии</p><br />
       <div class="sing_form">
       <input type="text" name="percent_15_procedures" value="<?php echo $percent_15_procedures; ?>" />
       </div>
<br />

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
