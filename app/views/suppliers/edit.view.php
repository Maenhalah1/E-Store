
                <form action="" method="post" class="form-emp-info">
                    <fieldset>
                        <legend><?=$text_form_lagend?></legend>
                        <div class="form-field">
                            <label for="name"><?=$text_form_name?></label>
                            <input type="text" name="name"  autocomplete value="<?=$this->InputValue("name",$supplier)?>">
                            <?php $error = $this->masseges->getMassege("form_filed_error_name");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>
                      
                    
                        <div class="form-field">
                            <label for="email"><?=$text_form_email?></label>
                            <input type="text" name="email" autocomplete value="<?=$this->InputValue("email",$supplier)?>">
                            <?php $error = $this->masseges->getMassege("form_filed_error_email");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>

                        <div class="form-field">
                            <label for="address"><?=$text_form_address?></label>
                            <input type="text" name="address" autocomplete value="<?=$this->InputValue("address",$supplier)?>">
                            <?php $error = $this->masseges->getMassege("form_filed_error_address");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>

                        </div>
                       
                        <div class="form-field">
                            <label for="phonenumber"><?=$text_form_phonenumber?></label>
                            <input type="text" name="phonenumber" class="p50"  minlength="10" maxlength="10" value="<?=$this->InputValue("phonenumber",$supplier)?>" autocomplete>
                            <?php $error = $this->masseges->getMassege("form_filed_error_phonenumber");?>
                            <?php if(!empty($error)):?>
                                <div class="msg-field-forms t<?=$error[1]?>"><?= $error[0]?></div>
                            <?php endif;?>
                        </div>
                        
                        
                        <div class="form-field">
                            <input type="submit" name="edit" value="<?=$text_form_submit?>">
                        <div>
                        
                    </fieldset>
                </form>
   