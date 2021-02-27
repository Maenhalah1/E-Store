      <div class="page-slt">
    
          <?php $massege = $this->masseges->getMassege("suppliersAction");?>
            <?php if($massege !== null):?>
                <p class="Massege t<?=$massege[1]?>"><?=$massege[0]?><p>
            <?php endif;?>
          <a href="/suppliers/create" class="add-btn"><?=$text_adduser?></a>
            <table class="table-show-emp-info">
                <tr>
                    <td>#<?=$text_table_id?></td>
                    <td><?=$text_table_name?></td>
                    <td><?=$text_table_email?></td>
                    <td><?=$text_table_phonenumber?></td>
                    <td><?=$text_table_control?></td>
                </tr>
        <?php if(isset($suppliers) && !empty($suppliers)):?>
                <?php foreach ($suppliers as $supplier): ?>
                
                    <tr>
                        <td><?=$supplier->get_primary_key()?></td>
                        <td><?=$supplier->name?></td>
                        <td><?=$supplier->email?></td>
                        <td><?=$supplier->phonenumber?></td>
                        <td>
                            <a href="/suppliers/edit/<?=$supplier->get_primary_key()?>">Edit</a>
                            <a href="/suppliers/delete/<?=$supplier->get_primary_key()?>" onclick="if(!confirm('<?=$text_table_delete_confirm?>')) return false">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
        <?php endif;?>
            </table>
        </div>