<div class="content" id="container">

    <div class="title"><h5>
            <?php if (isset($state)) {
                echo $state." > ";
            } ?>
            Expenses</h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Expenses List</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Expense Description</th>
                    <th>Amount</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>Room</th>
                    <th>Particulars</th>
                </tr>
            </thead>
            <tbody>
<?php $count = 1;
foreach ($managers as $building): ?>
                    <tr class="gradeA">
                        <td><?php echo $count; ?></td>
                        <td><?php echo $building['description'] ?></td>
                        <td><?php echo $building['e_amount'] ?></td>
                        <td><?php echo $building['b_name'] ?></td>
                        <?php
                        if (($building['e_floor'] == 1) || ($building['e_floor'] == 21) || ($building['e_floor'] == 31) || ($building['e_floor'] == 41)) {
                            echo '<td class="center">' . $building['e_floor'] . 'st Floor' . '</td>';
                        } elseif (($building['e_floor'] == 2) || ($building['e_floor'] == 22) || ($building['e_floor'] == 32) || ($building['e_floor'] == 42)) {
                            echo '<td class="center">' . $building['e_floor'] . 'nd Floor' . '</td>';
                        } elseif (($building['e_floor'] == 3) || ($building['e_floor'] == 23) || ($building['e_floor'] == 33) || ($building['e_floor'] == 43)) {
                            echo '<td class="center">' . $building['e_floor'] . 'rd Floor' . '</td>';
                        } elseif($building['e_floor']==0){
                            echo '<td class="center">' . ' ' . '</td>';
                        }else {
                            echo '<td class="center">' . $building['e_floor'] . 'th Floor' . '</td>';
                        }
                        ?>
                        <td class="center"><?php echo $building['e_room'] ?></td>
                        <td class="center"><?php echo $building['particulars'] ?></td>
                    </tr>
    <?php $count = $count + 1;
endforeach ?>
            </tbody>
        </table>
    </div>



</div>
