 <div class="page-slt">
    <form action="" method="post" class="form-emp-info">
        <fieldset>
            <legend><?=$text_form_lagend?></legend>
            <div class="form-field">
                <label for="privilegetitle"><?=$text_form_privilegeTitle?></label>
                <input type="text" name="privilegetitle"  value="<?=$privilege->privilegetitle?>" autocomplete>
            </div>
            <div class="form-field">
                <label for="privilegeurl"><?=$text_form_privilegeUrl?></label>
                <input type="text" name="privilegeurl"  value="<?=$privilege->privilege?>" autocomplete>
                (ex: privilege/actionprivilege)
            </div>
            <div class="form-field">
                <input type="submit" name="edit" value="<?=$text_form_save?>">
            <div>
        </fieldset>
    </form>
</div>
