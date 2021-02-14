 <div class="page-slt">
    <form action="" method="post" class="form-emp-info">
        <fieldset>
            <legend><?=$text_form_lagend?></legend>
            <div class="form-field">
                <label for="name"><?=$text_form_Group_Name?></label>
                <input type="text" name="groupname"  autocomplete>
            </div>
            <div class="form-field">
                <label><?=$text_form_privileges?></label>
                <div class="choose-section">
                <?php if(isset($privileges) && $privileges !== false):?>
                    <?php foreach($privileges as $privilege):?>
                    <div class="checking-box">
                        <input type="checkbox" name="privileges[]" value="<?=$privilege->get_primary_key()?>">
                        <label for="privileges"><?=$privilege->privilegetitle?></label>
                    </div>
                    <?php endforeach;?>
                <?php endif;?>
                </div>
            </div>
            <div class="form-field">
                <input type="submit" name="create" value="<?=$text_form_save?>">
            <div>
        </fieldset>
    </form>
</div>
