<!-- Content -->
<?php $dp=0;?>
<div class="content" id="container">
    <?php
    $ci = & get_instance();
    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> > Credit Adjustmments</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames">List:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th><b>No.</b></th>
                    <th><b>Receipt Number</b></th>
                    <th><b>Initial Amount</b></th>
                    <th><b>New Amount</b></th>
                    <th><b>Date Adjusted</b></th>
                     <th><b>Adjusted By</b></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cr as $i=>$chq): ?>
                    <tr class="gradeA">
                        <td class="center"><?php echo $i+1;?></td> 
                        <td class="center"><?php echo $chq['a_receipt'];?></td> 
                        <td class="center"><?php echo number_format($chq['i_pay_amount'],$dp);?></td>
                        <td class="center"><?php echo number_format($chq['f_pay_amount'],$dp);?></td>
                        <td class="center"><?php echo $chq['date_adjusted'];?></td>    
                        <td class="center"><?php echo $chq['adjusted_by'];?></td>                 
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>



</div>
