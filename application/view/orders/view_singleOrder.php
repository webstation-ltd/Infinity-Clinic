<h1><?=$title?></h1> 

<p><strong>Име:</strong> <?=$info['name'].' - '.$info['family']?></p>
<p><strong>Телефон:</strong> <?=$info['phone']?></p>
<p><strong>Адрес:</strong> <?=$info['address']?></p>
<p><strong>Email:</strong> <?=$info['email']?></p>
<br />

<a href="<?=ADMIN?>/?c=orders&m=updateOrder&id=<?=$info['id']?>" class="button <?=$class?>">Отбележи като <?=$isPaid?></a>
<br /><br />

<input name="" type="button" class="button" onclick="printSelection(document.getElementById('print'));return false" value="Разпечатай поръчката" />
<br />
<br />
<div id="print">
	<?=$info['orders']?>
</div>
<br /><br />

<p><strong>Сума: </strong> <?=round( ($info['price']), 2)?></p> 


