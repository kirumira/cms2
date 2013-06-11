<!-- Content -->
<?php $dp = 0;?>
<div class="content" id="container">
    <div class="title"><h5><?php echo $this->session->userdata('building_name');?> <?php if(isset($rm)){ echo"  Room ".$rm;}else{echo "Tenant: ". $name[0]['l_name']." ".$name[0]['f_name'];} ?> : Financial Statement:</h5></div>

    <!-- Statistics -->
        <div class="stats">
        	<ul>
            	<li><a href="#" class="count grey" title=""><?php echo number_format($deb,0,'',','); ?></a><span>Debit (<?php echo $this->session->userdata('currency');?>)</span></li>


                <li><a href="#" class="count grey" title="" id="first"><?php echo number_format($cred,0,'',','); ?></a><span>Credit (<?php echo $this->session->userdata('currency');?>)</span></li>
                <li><a href="#" class="count grey" title=""><?php echo number_format($deb-$cred,0,'',','); ?></a><span>Balance (<?php echo $this->session->userdata('currency');?>)</span></li>
            </ul>
            <div class="fix"></div>
        </div>


    <div class="table">
        <div class="head"><h5 class="iFrames"><?php if(isset($rm)){ echo"  Room ".$rm;}else{echo "Tenant: ". $name[0]['l_name']." ".$name[0]['f_name'];} ?> Financial Statement:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Details/Particulars</th>
                    <th>Receipt/Invoice</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Vat</th>
                    <?php if($this->session->userdata('currency')=='USD'){echo "<th>Eq Amount(UGX)</th>
                    <th>Ex Rate</th>";}?>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php $c = 1;
                foreach ($x as $ten): ?>
                    <tr class="gradeA">
                        <td><?php echo $c ?></td>
                        <td><?php echo date('d-m-Y', strtotime($ten['d_receipt'])); ?></td>
                        <td><?php echo date('H:i:s', strtotime($ten['d_receipt']));?></td>
                        <td><?php echo $ten['particulars'] ?></td>
                        <td><?php echo $ten['rec_num'] ?></td>
                        <td><?php echo number_format($ten['bill_amount'],$dp); ?></td>
                        <td><?php if($this->session->userdata('currency')=='USD'){echo number_format($ten['pay_amount'],2); }else{echo number_format($ten['pay_amount'],$dp);}?></td>
                        <td><?php echo $ten['vat'] ?></td>
                        <?php if($this->session->userdata('currency')=='USD'){
                            if($ten['x_rate']!=0){
                                echo "<td style='width: 60px;'>".number_format($ten['pay_amount_shs'],'0','',',')."</td>";
                                echo "<td>".$ten['x_rate']."</td>";
                            }else{echo "<td style='width: 60px;'></td><td></td>";}
                            }?>
                        <td><?php echo number_format($ten['re_bal'],$dp); ?></td>
                        <?php if(($ten['rec_num']=='')||( preg_match("/RC/", $ten['rec_num']))){?>
                            <td></td>
                        <?php }else{?>
                        <td><a class="btn14 topDir mr5 tinv" original-title="Print invoice" href="<?php echo base_url()?>reports/rent_invoice/<?php echo $ten['rec_num'];?>"><img alt='' src="<?php echo base_url();?>/images/icons/dark/pdfDoc2.png"/></a></td>
                        <?php }?>
    <?php $c++;
endforeach ?>
            </tbody>
        </table>
    </div>



</div>
