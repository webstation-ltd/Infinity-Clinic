<h1><?=$title?></h1> 


<form action="?c=langs&m=add" method="post">


<div class="form_input">
    <p>Абривиятура на езика (bg, en, fr) <span class="red">*</span></p>
    <div class="sing_form">
        <input name="title" type="text" value="<?=$edit['title']?>" />
    </div>
</div>

<div class="form_input">
    <p>Изписване на езика (български, английски, френски)<span class="red">*</span></p>
    <div class="sing_form">
        <input name="content" type="text" value="<?=$edit['title']?>" />
    </div>
</div>


<input name="edit_id" type="hidden" value="<?=$edit_id?>" />
<input name="post_news" type="hidden" value="1" />
<input name="" type="submit" class="button" value="запиши" />
</form>
<br />

<hr />
<div id="sortableOneLevel">
<form method="post" id="form-items" action="?c=langs&m=itemsPosition"> 
<ul>
	<? foreach($langs as $l):?>
    <li id="recordsArray_<?=$l['id']?>"  class="sortable">
    
    <div class="ns-row"><?=$l['title']?>
        <div class="ns-actions">
            <a href="?c=ads&m=regions&v=<?=$l['id']?>&mode=delete" class="confirm">
             <img src="<?=ADMIN?>/html/img/cross.png" alt="Delete">
            </a>
            
             <a href="?c=ads&m=regions&v=<?=$l['id']?>&mode=edit">
                <img src="<?=ADMIN?>/html/img/edit.png" alt="Edit">
            </a>
        </div>
    </div>
    </li>
    <? endforeach?>
</ul>
 <button type="submit" class="button green small" id="btn-save-items">Запази промените</button>
  </form>
</div>

<br />

<a href="?c=langs&m=updateTables" class="button">Генериране на таблиците</a>