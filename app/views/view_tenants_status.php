<!-- Content -->
<?php $dp=0;?>
<div class="content" id="container">
    <div class="title"><h5>Tenants Bill Status:</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames">Tenants:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tenants' Name</th>
                    <th>Room</th>
                    <th>Outstanding</th>
                </tr>
            </thead>
            <tbody>

                <?php $c = 1;
                foreach ($y as $ten): ?>
                    <tr class="gradeA">
                        <td><?php echo $c; ?></td>
                         <td><div class="rowElem nobg"><a href="<?php echo base_url(); ?>bills/ten_statement/<?php echo $ten['id'] ?>" title="View Room's Fiancial statement"><span><?php echo $ten['f_name'] . " " . $ten['l_name'] ?></span></a></div></td>
                                              
                        <td><?php echo $ten['room_name'] ?></td>
                        <td><?php
                        if ($ten['bill'] < $ten['payed']) {
                            echo number_format(($ten['bill'] - $ten['payed']),$dp) . "   (Creditor)";
                        } elseif($ten['bill'] > $ten['payed']) {
                            echo number_format(($ten['bill'] - $ten['payed']),$dp)."   (Debtor)";
                        }else{echo "Nil Balance";}
                        ?></td>
    <?php $c++; endforeach ?>
            </tbody>
        </table>
    </div>



</div>