<h1><?=$title?></h1> 

<table>
    <tr class="thead">
		<td>№</td> 
        <td>Дата</td>
        <td>Метод на плащане</td>
        <td>Стаус</td>
        <td>Преглед</td>
        <td>Изтриване</td>
    </tr>
    
<? 
	if($orders):
		foreach($orders as $k=>$o):?>
		<tr>
			<td><?=$o['invoice']?></td> 
			<td><?=$o['date']?></td>
			<td><?=$o['payment_method']?></td>
			<td class="<?=$o['paid_class']?>"><?=$o['paid']?></td>
			<td><a href="<?=ADMIN?>/?c=orders&m=view_order&id=<?=$k?>">Преглед</a></td>
			<td><a href="<?=ADMIN?>/?c=orders&m=deleteOrder&id=<?=$k?>" class="confirm">Изтриване</a></td>
		</tr>
	<? endforeach;
	endif;?>
</table>

<?=$pagination?>