<h1><?=$title?></h1>
<br />
<a class="button" href="/admin/?c=textPages&m=editPrices&menu_id=<?php echo $_GET['menu_id']; ?>">Добави нова терапия</a>
<a class="button" href="/admin/?c=textPages&menu_id=<?php echo $_GET['menu_id']; ?>">Върни се към главната страница на услугата</a>
<br /><br />
<ul id="easymm">
<?php if(sizeof($services) > 0) {
    foreach($services AS $service) { ?>
<li id="11" style="cursor: default">
<div class="ns-row" style="cursor: default; position: relative;">
    <div class="ns-title" style="cursor: text"><?php echo stripcslashes($service['title_bg']); ?></div>
    <div class="ns-url">
            <a href="/admin/?c=textPages&m=editPrices&id=<?php echo $service['id']; ?>&menu_id=<?php echo $_GET['menu_id']; ?>"><span class="green">Редактирай страницата</span></a> 
    </div>
    <div style="position: absolute; right: 10px;">
    <a href="/admin/?c=textPages&m=deletePrice&id=<?php echo $service['id']; ?>&menu_id=<?php echo $_GET['menu_id']; ?>"><img src="<?php echo ADMIN; ?>/html/img/cross.png" alt="Delete"></a>
    </div>
</div>
    <?php } ?>
<?php } ?>
    

</li>
