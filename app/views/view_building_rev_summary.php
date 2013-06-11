<?php $dp=0;?>
<div class="content" id="container">
    <?php $ci = & get_instance();?>
    <div class="title"><h5><?php echo $b_name; ?>:  Floors Revenue Summary</h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Building Revenue Summary</h5></div>
        <?php
        $num_floors = $x;        
        for($i=1;$i<=$num_floors;$i++){            
            echo "<div class='table'>
                        <div class='head'><h5 class='iFrames'>".$this->floor->get_fl_name($i).":</h5></div>"."
                            <table cellpadding='0' cellspacing='0' border='0' class='display' id='example".$i."'><thead><tr>".
                            "<th>Room</th>".
                            "<th>Amount</th>".
                            "</tr></thead>";
                            echo "<tbody>";
             $total = 0;?>
             <script type="text/javascript">
                oTable = $("#example<?php echo $i;?>").dataTable({
                  "bJQueryUI": true,
                  "sPaginationType": "full_numbers",
                  "sDom": '<""f>t<"F"lp>'
                });
             </script>
             <?php
             foreach($floor[$i] as $row){
                 
                 if(isset($row['rev'])){
                 echo "<tr class='gradeA'>                       
                            <td>".$row['room_name']."</td>
                                <td><a href='".base_url()."bills/revenue/".$row['rm_id']."'>".number_format($row['rev'],$dp)."</a></td>
                          
                        </tr>
                      ";
                    $total += $row['rev'];
                      }
             } ?>
            <tr><td>TOTAL</td><td>  <input type="button" value="<?php if(isset($total)){echo number_format($total,$dp); }?>" class="greenBtn" ></td></tr>
                    </tbody></table></div>
                    <?php
        }
        ?>

        

</div>