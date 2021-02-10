      <div class="page-slt">
          <a href="/employee/add" class="add-btn">Add new Employee</a>
            <table class="table-show-emp-info">
                <tr>
                    <td>#ID</td>
                    <td>Name</td>
                    <td>Salary</td>
                    <td>Tax</td>
                    <td>Number Phone</td>
                    <td>Control</td>
                </tr>
        <?php if(isset($employess) && !empty($employess)):?>
                <?php foreach ($employess as $employee):?>
                    <tr>
                        <td><?=$employee->get_primary_key()?></td>
                        <td><?=$employee->name?></td>
                        <td>$<?=$employee->salary?></td>
                        <td><?=$employee->tax?>%</td>
                        <td><?=$employee->number_phone?></td>
                        <td>
                            <a href="/employee/edit/<?=$employee->get_primary_key()?>">Edit</a>
                            <a href="/employee/delete/<?=$employee->get_primary_key()?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
        <?php endif;?>
            </table>
        </div>