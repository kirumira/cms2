<div class="content" id="container">
<?php $ci = & get_instance();?>
    <div class="title"><h5>
            <?php
           if(isset($room[0]['room_name']))
                echo $ci->session->userdata('building_name').": ROOM ". $room[0]['room_name']. " > ";
            ?>
            Umeme Billing Statement</h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Umeme Bill Statement</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Meter Reading</th>
                    <th>Units Billed</th>
                    <th>Bill</th>
                </tr>
            </thead>
            <tbody>
<?php $count = 1;
foreach ($managers as $building):
    ?>
                    <tr class="gradeA">
                        <td><?php echo $count; ?></td>
                        <td><?php echo $building['d_receipt'] ?></td>
                        <td><?php echo $building['meter_r'] ?></td>
                        <td><?php echo $building['units'] ?></td>
                        <td class="center"><?php echo $building['bill_amount'] ?></td>
                    </tr>
    <?php $count = $count + 1;
endforeach
?>
            </tbody>
        </table>
    </div>



</div>
