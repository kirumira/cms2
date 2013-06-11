<!-- Content -->
<?php $dp = 0;?>
<div class="content" id="container">
    <div class="title"><h5><?php echo $this->session->userdata('building_name');?> <?php if(isset($rm)){ echo">  Room ".$rm;}else{echo "Tenant: ". $name[0]['l_name']." ".$name[0]['f_name'];} ?> : Bill Statement:</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames"><?php if(isset($rm)){ echo"  Room ".$rm;}else{echo "Tenant: ". $name[0]['l_name']." ".$name[0]['f_name'];} ?> > Bill Statement:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Details/Particulars</th>
                    <th>Receipt/Invoice</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php $c = 1;
                foreach ($x as $ten): ?>
                    <tr class="gradeA">
                        <td><?php echo $c ?></td>
                        <td><?php echo date('d-m-Y', strtotime($ten['d_payment'])); ?></td>
                        <td><?php echo $ten['particulars'] ?></td>
                        <td><?php echo $ten['rec_num'] ?></td>
                        <td><?php echo number_format($ten['bill_amount'],$dp); ?></td>
                        <td><a class="btn14 topDir mr5 tinv" original-title="Print invoice" href="<?php echo base_url()?>reports/rent_invoice/<?php echo $ten['rec_num'];?>"><img alt='' src="<?php echo base_url();?>/images/icons/dark/pdfDoc2.png"/></a></td>
    <?php $c++;
endforeach ?>
            </tbody>
        </table>
    </div>



</div>
