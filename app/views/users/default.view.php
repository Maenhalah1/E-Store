      <div class="page-slt">
          <a href="/employee/add" class="add-btn"><?=$text_adduser?></a>
            <table class="table-show-emp-info">
                <tr>
                    <td>#<?=$text_table_userid?></td>
                    <td><?=$text_table_username?></td>
                    <td><?=$text_table_email?></td>
                    <td><?=$text_table_phonenumber?></td>
                    <td><?=$text_table_SubDate?></td>
                    <td><?=$text_table_lastlogin?></td>
                    <td><?=$text_table_usergroup?></td>
                    <td>Control</td>
                </tr>
        <?php if(isset($users) && !empty($users)):?>
                <?php foreach ($users as $users):?>
                    <tr>
                        <td><?=$users->get_primary_key()?></td>
                        <td><?=$users->username?></td>
                        <td>$<?=$users->email?></td>
                        <td><?=$users->Phonenumber?></td>
                        <td><?=$users->SubscriptionDate?></td>
                        <td><?=$users->LastLogin?></td>
                        <td><?=$users->Groupid?></td>
                        <td>
                            <!-- <a href="/employee/edit/<?=$users->get_primary_key()?>">Edit</a>
                            <a href="/employee/delete/<?=$users->get_primary_key()?>">Delete</a> -->
                        </td>
                    </tr>
                <?php endforeach;?>
        <?php endif;?>
            </table>
        </div>