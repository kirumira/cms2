<!-- Content -->
<?php $dp=0;?>
<div class="content" id="container">
    <div class="title"><h5><?php echo $this->session->userdata('building_name') ?> > Building Payments</h5></div>
    <!-- Statistics -->
    <div class="stats">
            <ul>
            <li><a style="font-size: large;" href="#" class="count grey" title="Total Payments"><?php echo number_format(($tpay + $tvat),$dp); ?></a><span>Total Payments (<?php echo $this->session->userdata('currency');?>)</span></li>
            <li><a style="font-size: large;" href="#" class="count grey" title="Total Revenue" ><?php
                if ($tpay) {
                    echo number_format($tpay,$dp);
                } else {
                    echo"0.00";
                }
                ?></a><span>Total Revenue (<?php echo $this->session->userdata('currency');?>)</span></li>
            <li><a style="font-size: large;" href="#" class="count grey" title="Total VAT"><?php
                        if ($tvat) {
                            echo number_format($tvat,$dp);
                        } else {
                            echo"0.00";
                        }
                ?></a><span>Total VAT (<?php echo $this->session->userdata('currency');?>)</span></li>
            <li><a style="font-size: large;" href="#" class="count grey" title="UMEME Total"><?php echo number_format(($tumeme),$dp); ?></a><span>UMEME Total (UGX) </span></li>
        </ul>
        <div class="fix"></div>
    </div>

    <div class="table">
        <div class="head"><h5 class="iFrames">Payment Summary:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Receipt Number</th>
                    <th width="15%">Date</th>
                    <th>Particulars</th>
                    <th>Tenant</th>
                    <th>Room</th>                        
                    <th>Amount</th>
                    <th>Revenue</th>                        
                    <th>Vat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr class="gradeA">
                        <td><?php echo $payment['rec_num'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($payment['d_receipt'])) ?></td>
                        <td><?php echo $payment['particulars'] ?></td>
                        <td><?php echo $payment['f_name'] . " " . $payment['l_name'] ?></td>
                        <td><?php echo $payment['room_name'] ?></td>
                        <td><?php echo number_format($payment['pay_amount'] + $payment['vat'],2) ?></td>
                        <td><?php echo number_format($payment['pay_amount'],2); ?></td>
                        <td><?php echo number_format($payment['vat'],2);?></td>
                    </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
    </div>
</div>

