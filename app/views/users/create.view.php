<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <div class="wrraper">
        <div class="page-slt form-container">
                <form action="" method="post" class="form-emp-info">
                    <fieldset>
                        <legend><?=$text_form_lagend?></legend>
                        <div class="form-field">
                            <label for="username"><?=$text_form_username?></label>
                            <input type="text" name="username"  class="checkUsernameAjax" autocomplete value="<?=$this->InputValue("username")?>">
                            <?php $error = $this->masseges->getMassege("form_filed_error_username");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>
                        <div class="form-field">
                            <label for="firstname"><?=$text_form_firstname?></label>
                            <input type="text" name="firstname"   autocomplete value="<?=$this->InputValue("firstname")?>">
                            <?php $error = $this->masseges->getMassege("form_filed_error_firstname");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>
                        <div class="form-field">
                            <label for="lastname"><?=$text_form_lastname?></label>
                            <input type="text" name="lastname"   autocomplete value="<?=$this->InputValue("lastname")?>">
                            <?php $error = $this->masseges->getMassege("form_filed_error_lastname");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>
                        <div class="form-field">
                            <label for="email"><?=$text_form_email?></label>
                            <input type="text" name="email" autocomplete value="<?=$this->InputValue("email")?>">
                            <?php $error = $this->masseges->getMassege("form_filed_error_email");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>

                        </div>
                        <div class="form-field">
                            <label for="newpassword"><?=$text_form_newpassword?></label>
                            <input type="text" name="newpassword" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_newpassword");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>

                        </div>
                        <div class="form-field">
                            <label for="c_newpassword"><?=$text_form_confirm_newpassword?></label>
                            <input type="text" name="c_newpassword" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_confirm_newpassword");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>

                        </div>
                        <div class="form-field">
                            <label for="phonenumber"><?=$text_form_phonenumber?></label>
                            <input type="text" name="phonenumber" class="p50"  minlength="10" maxlength="10" value="<?=$this->InputValue("phonenumber")?>" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_phonenumber");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>
                        <div class="form-field">
                        <div class="select-box">
                            <select name="usergroup">
                                <option value=""><?=$text_form_usergroup?></option>
                            <?php foreach($groups as $group):?>
                                <option value="<?=$group->get_primary_key()?>" <?=$this->InputValue("usergroup") == $group->get_primary_key() ? "selected" : ""?>><?=$group->groupname?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                            <?php $error = $this->masseges->getMassege("form_filed_error_usergroup");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>
                        
                        <div class="form-field">
                            <input type="submit" name="create" value="<?=$text_form_submit?>">
                        <div>
                        
                    </fieldset>
                </form>
            </div>
    </div>

</body>
</html>