<div class="content" id="container">
    <?php $ci = & get_instance(); ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> Floors Summary</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">
                <div class="head"><h5 class="iUpload">Building Summary</h5></div>

                <?php
                if(isset($fl )){
                    echo "<div class='table'>
                        <div class='head'><h5 class='iFrames'>Floor " . $fl . ":</h5></div>" . "
                            <table cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead><tr>" .
                    "<th>Room</th>" .
                    "<th>Meter Reading</th>" .
                    "</tr></thead>";}  else {
                        echo "<div class='table'>
                        <div class='head'><h5 class='iFrames'>Room " . $floor[0]['room_name'] . ":</h5></div>" . "
                            <table cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead><tr>" .
                    "<th>Room</th>" .
                    "<th>Meter Reading</th>" .
                    "</tr></thead>";
    
}
                    echo "<tbody>";
                    $floor_i = $floor;
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
                
                ?>

                <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>

</div>