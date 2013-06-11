<div class="content" id="container">
    <?php $ci = & get_instance();?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> Floors Summary</h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Building Summary</h5></div>

        <?php
        $num_floors = $ci->session->userdata('floors');
        
        for($i=1;$i<=$num_floors;$i++){
            
            echo "<div class='table'>
                        <div class='head'><h5 class='iFrames'>Floor ".$i.":</h5></div>"."
                            <table cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead><tr>".
                            "<th>Room</th>".
                            "<th>Tenant</th>".
                            "<th>Status</th>".
                            "<th>Rent Amount</th>".
                            "</tr></thead>";
                            echo "<tbody>";
             foreach($floor[$i] as $row){
                 echo "<tr class='gradeA'>
                            <td>".$row['room_name']."</td>
                            <td>".$row['f_name']." ".$row['l_name']."</td>
                            <td>".$row['rm_status']."</td>
                            <td>".$row['rm_cost']."</td>
                        </tr>
                      ";
             }
             echo "</tbody></table></div>";
        }
        ?>

        

</div>