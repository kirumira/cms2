<!-- Content -->

<div class="content" id="container">  
    
    <div class="title"><h5>Room Status:</h5></div>
     <a href="<?php echo base_url(); ?>floors/evict_tenant/<?php echo $ten[0]['rm_id']; ?>" title="">
            <input type="button" value="Evict Tenant" class="greenBtn right" />
        </a>

        <a href="<?php echo base_url(); ?>floors/delete_room/<?php echo $ten[0]['rm_id'] ; ?>" title="">
            <input type="button" value="Delete Room" class="greenBtn right" />
        </a>
        <a href="<?php echo base_url(); ?>floors/edit_room/<?php echo $ten[0]['rm_id'] ; ?>" title="">
            <input type="button" value="Edit Room" class="greenBtn right" />
        </a>
    <div class="table">
        <div class="head"><h5 class="iFrames">Room <?php echo $ten[0]['room_name'] ?> Details:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<thead>
<th></th><th></th>
</thead>      <tbody>

                <tr class="gradeA">
                    <td>Floor</td><?php
                                if (($ten[0]['floor'] == 1) || ($ten[0]['floor'] == 21) || ($ten[0]['floor'] == 31) || ($ten[0]['floor'] == 41)) {
                                    echo "<td>" . $ten[0]['floor'] . "st Floor</td>";
                                } elseif (($ten[0]['floor'] == 2) || ($ten[0]['floor'] == 22) || ($ten[0]['floor'] == 32) || ($ten[0]['floor'] == 42)) {
                                    echo "<td>" . $ten[0]['floor'] . "nd Floor</td>";
                                } elseif (($ten[0]['floor'] == 3) || ($ten[0]['floor'] == 23) || ($ten[0]['floor'] == 33) || ($ten[0]['floor'] == 43)) {
                                    echo "<td>" . $ten[0]['floor'] . "rd Floor</td>";
                                } else {
                                    echo "<td>" . $ten[0]['floor'] . "th Floor</td>";
                                }
                                ?>  
                </tr>
                <tr class="gradeA">
                    <td>Description</td>
                    <td><?php echo $ten[0]['description'] ?></td>  
                </tr>
                <tr class="gradeA">
                    <td>Status</td>
                    <td><?php echo $ten[0]['rm_status'] ?></td>  
                </tr>
                <tr class="gradeA">
                    <td>Tenant</td>
                    <td><?php echo $ten[0]['f_name'] . " " . $ten[0]['l_name'] ?></td>  
                </tr>
                <tr class="gradeA">
                    <td>Rent Amount</td>
                    <td><?php echo $ten[0]['rm_cost'] ?></td>  
                </tr>
            </tbody>
        </table>
    </div>



</div>