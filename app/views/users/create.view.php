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
                            <label for="name"><?=$text_form_username?></label>
                            <input type="text" name="username"  autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_username");?>
                            <?php if(!empty($error)):?>
                                <?= $error[0]?>
                            <?php endif;?>
                        </div>
                        <div class="form-field">
                            <label for="salary"><?=$text_form_email?></label>
                            <input type="text" name="email" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_email");?>
                            <?php if(!empty($error)):?>
                                <?= $error[0]?>
                            <?php endif;?>

                        </div>
                        <div class="form-field">
                            <label for="tax"><?=$text_form_newpassword?></label>
                            <input type="text" name="newpassword" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_newpassword");?>
                            <?php if(!empty($error)):?>
                                <?= $error[0]?>
                            <?php endif;?>

                        </div>
                        <div class="form-field">
                            <label for="tax"><?=$text_form_confirm_newpassword?></label>
                            <input type="text" name="c_newpassword" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_confirm_newpassword");?>
                            <?php if(!empty($error)):?>
                                <?= $error[0]?>
                            <?php endif;?>

                        </div>
                        <div class="form-field">
                            <label for="phone"><?=$text_form_phonenumber?></label>
                            <input type="text" name="phonenumber" class="p50"  minlength="10" maxlength="10" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_phonenumber");?>
                            <?php if(!empty($error)):?>
                                <?= $error[0]?>
                            <?php endif;?>

                        </div>
                        <div class="form-field">
                            <select name="usersgroups">
                                <option value=""><?=$text_form_usersgroups?></option>
                            <?php foreach($groups as $group):?>
                                <option value="<?=$group->get_primary_key()?>"><?=$group->groupname?></option>
                            <?php endforeach;?>
                            </select>
                            <?php $error = $this->masseges->getMassege("form_filed_error_usersgroups");?>
                            <?php if(!empty($error)):?>
                                <?= $error[0]?>
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