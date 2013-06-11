
<div class="content" id="container">

    <div class="title"><h5>Active Buildings</h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Building List</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Tenant</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $schedule): ?>
                <tr class="gradeA">                    
                    <td class="center"><?php echo $schedule['f_name']." ".$schedule['l_name']?></td>
                    <td class="center"><?php echo $schedule['room_name'];?></td>
                    <td class="center"><?php echo $schedule['s_date']?></td>                    
                    <td class="center"><?php echo $schedule['s_amount']?></td>
                    <td class="center"><?php echo $schedule['s_paid']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>



</div>

