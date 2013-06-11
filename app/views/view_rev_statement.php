<!-- Content -->
<?php $dp = 0; ?>
<div class="content" id="container">
    <div class="title"><h5><?php echo $this->session->userdata('building_name') . ' >'; ?> <?php if (isset($x[0]['room_name'])) {
    echo $x[0]['room_name'];
} ?> : Room Revenue Statement:</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames"><?php if (isset($x[0]['room_name'])) {
    echo $x[0]['room_name'];
} ?> Room Revenue Statement:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Details/Particulars</th>
                    <th>Receipt/Invoice</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>

<?php $c = 1;
foreach ($x as $ten):
    ?>
                    <tr class="gradeA">
                        <td><?php echo $c ?></td>
                        <td><?php echo date('d-m-Y', strtotime($ten['d_receipt'])); ?></td>
                        <td><?php echo date('H:i:s', strtotime($ten['d_receipt'])); ?></td>
                        <td><?php echo $ten['particulars'] ?></td>
                        <td><?php echo $ten['rec_num'] ?></td>
                        <td><?php echo number_format($ten['pay_amount'], $dp); ?></td>
    <?php $c++;
endforeach
?>
                        <tr>
                    <td>TOTAL</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="button" value=" <?php
                if ($total) {
                    echo $total;
                } else {
                    echo"0.00";
                }
                ?>" class="greenBtn" /></td>
                   </tr>

            </tbody>
        </table>
    </div>
</div>