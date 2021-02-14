      <div class="page-slt">
        
          <a href="/usersgroups/create" class="add-btn"><?=$text_addgroup?></a>
            <table class="table-show-emp-info">
                <tr>
                    <td>#<?=$text_table_groupid?></td>
                    <td><?=$text_table_groupname?></td>
                    <td><?=$text_table_control?></td>
                </tr>
        <?php if(isset($groups) && !empty($groups)):?>
                <?php foreach ($groups as $group):?>
                    <tr>
                        <td><?=$group->get_primary_key()?></td>
                        <td><?=$group->groupname?></td>
                        <td>                            
                            <a href="/usersgroups/edit/<?=$group->get_primary_key()?>">Edit</a>
                            <a href="/usersgroups/delete/<?=$group->get_primary_key()?>" onclick="if(!confirm('<?=$text_table_delete_confirm?>')) return false">Delete</a>

                        </td>
                    </tr>
                <?php endforeach;?>
        <?php endif;?>
            </table>
        </div>