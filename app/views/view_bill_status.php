<div class="content" id="container">

    <div class="title"><h5><?php echo $this->session->userdata('building_name');?></h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Bills Details</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Receipt Number</th>
                    <th>Room Name</th>
                    <th>Receipt Date</th>
                    <th>Bill Particulars</th>
                    <th>Bill Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                <tr class="gradeA">

                    <td class="center"><?php echo $room['receit_no']; ?></td>
                    <td class="center"><?php echo $room['room_name']; ?></td>
                    <td class="center"><?php echo date('Y-m-d', strtotime($room['d_receipt'])); ?></td>
                    <td class="center"><?php echo $room['particulars']; ?></td>
                    <td class="center"><?php echo $room['bill_amount'];?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>



</div>

