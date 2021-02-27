      <div class="page-slt">
          <div class="sublinks">
            <a class="link-box" href="/usersgroups">
            <?=$text_links_groups?>
            </a>
            <a class="link-box" href="/privileges">
                <?=$text_links_privileges?>
            </a>
          </div>
          <?php $massege = $this->masseges->getMassege("userAction");?>
            <?php if($massege !== null):?>
                <p class="Massege t<?=$massege[1]?>"><?=$massege[0]?><p>
            <?php endif;?>
          <a href="/users/create" class="add-btn"><?=$text_adduser?></a>
            <table class="table-show-emp-info">
                <tr>
                    <td>#<?=$text_table_userid?></td>
                    <td><?=$text_table_username?></td>
                    <td><?=$text_table_email?></td>
                    <td><?=$text_table_phonenumber?></td>
                    <td><?=$text_table_SubDate?></td>
                    <td><?=$text_table_lastlogin?></td>
                    <td><?=$text_table_usergroup?></td>
                    <td><?=$text_table_control?></td>
                </tr>
        <?php if(isset($users) && !empty($users)):?>
                <?php foreach ($users as $user): ?>
                
                    <tr>
                        <td><?=$user->get_primary_key()?></td>
                        <td><?=$user->username?></td>
                        <td><?=$user->email?></td>
                        <td><?=$user->phonenumber?></td>
                        <td><?=$user->SubscriptionDate?></td>
                        <td><?=$user->LastLogin?></td>
                        <td><?=$user->GroupName?></td>
                        <td>
                            <a href="/users/edit/<?=$user->get_primary_key()?>">Edit</a>
                            <a href="/users/delete/<?=$user->get_primary_key()?>" onclick="if(!confirm('<?=$text_table_delete_confirm?>')) return false">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
        <?php endif;?>
            </table>
        </div>