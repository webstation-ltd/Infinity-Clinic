<?=$err?>

<script type="text/javascript">
$(document).ready(function() {
   $('#header').hide();
   $('#content').css({'min-height':'200px', 'width':'700px', 'margin-top':'150px'});
 });
</script>

<div class="admin_login">
<form action="?c=login&m=enter" method="post">
<!------USER PASS---->


<p><strong><?=$title?></strong></p>
    <div class="login_half">
        <p>Потребителско име<span class="red">*</span></p>
        
        <div class="sing_form">
            <input name="user" type="text" />
        </div>
    </div>
    
    <div class="login_half">
        <p>Парола<span class="red">*</span></p>
        
        <div class="sing_form">
            <input name="pass" type="password" />
        </div>
    </div>
    
    <div style="clear:both"></div>
    
    <br />
    
    <input name="singup" type="hidden" value="1" />
    <input name="" type="submit" value="вход" class="button"/>
    </form>
</div>

