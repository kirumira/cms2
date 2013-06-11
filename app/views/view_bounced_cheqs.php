<!-- Content -->
<?php $dp=0;?>
<div class="content" id="container">
    <?php
    $ci = & get_instance();
    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> > Bounced Cheques</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames">List:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th><b>No.</b></th>
                    <th><b>Date</b></th>
                    <th><b>Room</b></th>
                    <th><b>Tenant</b></th>
                    <th><b>Cheque No.</b></th>
                    <th><b>Amount</b></th>
                    <th><b>Penalty</b></th>
                    <th><b>Details</b></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cheques as $i=>$chq): ?>
                    <tr class="gradeA">
                        <td class="center"><?php echo $i+1;?></td> 
                        <td class="center"><?php echo $chq['date_time'];?></td> 
                        <td class="center"><?php echo $chq['room'];?></td>
                        <td class="center"><?php echo $chq['tenant'];?></td>
                        <td class="center"><?php echo $chq['cheque'];?></td>
                        <td class="center"><?php echo number_format($chq['amount'],$dp);?></td>
                        <td class="center"><?php echo number_format($chq['penalty'],$dp);?></td>
                        <td class="center"><?php echo $chq['details'];?></td>    
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>



</div>
