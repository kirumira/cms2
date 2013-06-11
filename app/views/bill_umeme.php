<div class="content" id="container">
    <?php $ci = & get_instance(); ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> Electricity</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <?php
                $num_floors = $ci->session->userdata('floors');

                for ($i = 1; $i <= $num_floors; $i++) {

                    echo "<div class='table'>
                        <div class='head'><h5 class='iFrames'>Floor " . $i . ":</h5></div>" . "
                            <table cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead><tr>" .
                    "<th>Room</th>" .
                    "<th>Meter Reading</th>" .
                    "</tr></thead>";
                    echo "<tbody>";
                    $floor_i = $floor[$i];
                    foreach ($floor_i as $row) {
                        echo "<tr class='gradeA'>
                            <td>" . $row['room_name'] . "</td>
                            <td><div class='formRight'><input type='text' name='current_".$row['room_name']."'class='validate[required]'/></div></td>
                       </tr>
                      ";
                        if (form_error('current_'.$row['room_name'])) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('current_'.$row['room_name']) . '</p>
                                            </div>
                                        ';
                            }
                    }
                    echo "</tbody></table></div>";
                }
                ?>

                <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>

</div>