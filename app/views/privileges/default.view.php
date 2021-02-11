      <div class="page-slt">
          <a href="/privileges/create" class="add-btn"><?=$text_addprivilege?></a>
            <table class="table-show-emp-info">
                <tr>
                    <td><?=$text_table_privilege?></td>
                    <td><?=$text_table_control?></td>
                </tr>
        <?php if(isset($privileges) && !empty($privileges)):?>
                <?php foreach ($privileges as $privilege):?>
                    <tr>
                        <td><?=$privilege->privilegetitle?></td>
                        <td>
                            <a href="/privileges/edit/<?=$privilege->get_primary_key()?>">Edit</a>
                            <a href="/privileges/delete/<?=$privilege->get_primary_key()?>" onclick="if(confirm('<?=$text_table_delete_confirm?>')) return true">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
        <?php endif;?>
            </table>
        </div>