<?php $dp = 2;?>
<div class="content" id="container">
    <div class="title"><h5><?php echo $this->session->userdata('building_name'); ?> : UMEME Room Summary</h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload"><?php echo $rm_name; ?> : Umeme Statement</h5></div>

        <div class="table">
            <div class='head'></div>
            <table cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead><tr>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Receipt Number</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr></thead>
                <tbody>
                    <?php
                    foreach ($details as $row) { ?>
                        
                         <tr class='gradeA'>
                         <td><?php echo date('d-m-Y', strtotime($row['d_payment'])); ?></a></td>
                         <td><?php echo $row['particulars'];?></td>
                         <td><?php echo number_format($row['bill_amount'],$dp);?></td>
                         <td><?php echo number_format($row['pay_amount'],$dp); ?></td>
                         <td><?php echo $row['rec_num']; ?></td>
                         <td><?php echo number_format($row['re_bal'],$dp); ?></td>
                         <?php if(($row['rec_num']=='')||( preg_match("/RC/", $row['rec_num']))){?>
                            <td></td>
                        <?php }else{?>
                        <td class='text-align: center;'><a class='btn14 topDir mr5 tinv' original-title='Print invoice' href='<?php echo base_url()."reports/umeme_invoice/".$row['rec_num']; ?>'><img alt='' src='<?php echo base_url()."/images/icons/dark/pdfDoc2.png"; ?>'/></a></td>
                        <?php }?>
                        </tr>
                        
                    <?php }?>                    
                </tbody>
            </table>
        </div>
    </div>
</div>
