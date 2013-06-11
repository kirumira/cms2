<!-- Content -->
<?php $dp = 2;?>
<div class="content" id="container">
    <div class="title"><h5>Rooms Bill Status:</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames">Rooms:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Floor</th>
                    <th>Room</th>
                    <th>Outstanding</th>
                </tr>
            </thead>
            <tbody>

                <?php $x = 1;foreach ($y as $ten): ?>
                    <tr class="gradeA">
                        <?php
                        echo "<td>" . $x . "</td>";
                        ?>
                        <td><?php echo $ten['flr_name'] ?></td>
                        <td><div class="rowElem nobg"><a href="<?php echo base_url(); ?>bills/statement/<?php echo $ten['rm_id'] ?>" title="View Room's Fiancial statement"><span><?php echo $ten['room_name'] ?></span></a></div></td>
                         <td><?php
                    if ($ten['debit'] < $ten['credit']) {
                        echo number_format(($ten['debit'] - $ten['credit']),$dp) . " (Creditor)";
                    } elseif($ten['debit'] > $ten['credit']) {
                        echo number_format(($ten['debit'] - $ten['credit']),$dp). "  (Debtor)";
                    }else{echo "Nil Balance";}
                        ?></td>
                    <?php $x++; endforeach ?>
            </tbody>
        </table>
    </div>



</div>