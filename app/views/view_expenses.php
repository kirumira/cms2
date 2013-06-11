<div class="content" id="container">

    <div class="title"><h5>Expenses</h5></div>
    <a href="<?php echo base_url(); ?>expenses/add_new" title="">
            <input type="button" value="Add New Expense" class="greenBtn right" />
        </a>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Expense Codes</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Expense Code</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php $x = 1;
                foreach ($managers as $building): ?>
                    <tr class="gradeA">
                        <td class="center"><?php echo $x; ?></td>
                        <td><div class="rowElem nobg"><a href="<?php echo base_url(); ?>expenses/edit/<?php echo $building['e_code'] ?>" title="Edit Expense code and /or description."><span><?php echo $building['e_code'] ?></span></a></div></td>
                        <td class="center"><?php echo $building['description'] ?></td>
                    </tr>
    <?php $x++;
endforeach ?>
            </tbody>
        </table>
    </div>



</div>
