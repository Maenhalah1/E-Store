      <div class="page-slt">
          <a href="/employee/add" class="add-btn"><?=$text_addgroup?></a>
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
                            <!-- <a href="/employee/edit/<?=$group->get_primary_key()?>">Edit</a>
                            <a href="/employee/delete/<?=$group->get_primary_key()?>">Delete</a> -->
                        </td>
                    </tr>
                <?php endforeach;?>
        <?php endif;?>
            </table>
        </div>