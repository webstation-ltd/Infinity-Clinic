<h1><?=$title?></h1>
<br />
<a class="button" href="/admin/?c=textPages&m=editFaq&menu_id=<?php echo $_GET['menu_id']; ?>">Добави нов въпрос</a>
<a class="button" href="/admin/?c=textPages&menu_id=<?php echo $_GET['menu_id']; ?>">Върни се към главната страница на услугата</a>
<br /><br />
<ul id="easymm">
<?php if(sizeof($faq) > 0) {
    foreach($faq AS $fq) { ?>
<li id="11" style="cursor: default">
<div class="ns-row" style="cursor: default">
    <div class="ns-title" style="cursor: text"><?php echo stripcslashes($fq['question_bg']); ?></div>
    <div class="ns-url">
        <a href="/admin/?c=textPages&m=editFaq&id=<?php echo $fq['id']; ?>&menu_id=<?php echo $_GET['menu_id']; ?>"><span class="green">Редактирай FAQ</span></a> 
    </div>
</div>
    <?php } ?>
<?php } ?>
    

</li>
