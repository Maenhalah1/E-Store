<div class="login-box">
    <div class="login-header">
        <h3><?=$text_header_login?></h3>
        <hr>
    </div>
    <div class="img-box">
         <img src="/imgs/business.png" alt="login"> 
    </div>
    <form action="" method="post">
    <div class="inputs-box">
        <div class="input-field">
            <input type="text" name="username" placeholder="<?=$text_username_placeholder?>" class="text">
        </div>
        <div class="input-field">
            <input type="password" name="password" placeholder="<?=$text_password_placeholder?>" class="text">
        </div>   
        <div class="input-field">
            <input type="submit" name="login" value="<?=$text_button_login?>" class="button">
        </div>    
    </div>
    </form>  
</div>