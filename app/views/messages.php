<!-- Content -->

<div class="content" id="container">
    <?php
    $ci = & get_instance();
    ?>
    <div class="title"><h5>Messages</h5></div>

    

    <div class="table">
        <div class="head"><h5 class="iFrames">Messages:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>Room</th>
                    <th>Message</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($messages as $row):?>
                <tr class="gradeA">
                    <td><?=$row['b_name']?></td>
                    <td><?=$row['m_fid']?></td>
                    <td><?=$row['room_name']?></td>
                    <td><?=$row['m_msg']?></td>
                    <td><?=$row['m_time']?></td>

                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>



</div>
