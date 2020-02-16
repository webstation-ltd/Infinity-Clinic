<h1><?=$title?></h1> 
<a href="?c=newsletter" class="button">Изпращане на бюлетин</a>
<a href="?c=newsletter&m=emailList" class="button">Списък с Email адреси</a>
<br />
<br /><br />

<? if( !empty($emails) ):?>
	<? foreach($emails as $e):?>
        <div class="ns-row">
            <div class="ns-title_non"><?=$e['email']?></div>
             <div class="ns-actions">
                <a href="?c=newsletter&m=delete&id=<?=$e['id']?>" class="confirm"><img src="<?=ADMIN?>/html/img/cross.png" alt="Delete"></a>
            </div>
         </div>
    
    <? endforeach;?>
<? endif;?>