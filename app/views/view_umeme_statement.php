<?php $dp = 2;?>
<div class="content" id="container">
    <div class="title"><h5><?php echo $this->session->userdata('building_name'); ?> UMEME Room Summary</h5></div>
    
    <!-- Statistics -->
        <div class="stats">
        	<ul>
            	<li><a href="#" class="count grey" title=""><?php echo number_format($deb,0,'',','); ?></a><span>Debit (UGX)</span></li>


                <li><a href="#" class="count grey" title="" id="first"><?php echo number_format($cred,0,'',','); ?></a><span>Credit (UGX)</span></li>
                <li><a href="#" class="count grey" title=""><?php echo number_format($deb-$cred,0,'',','); ?></a><span>Balance (UGX)</span></li>
            </ul>
            <div class="fix"></div>
        </div>

    <div class="widget first">
        
        <div class="table">
            <div class='head'></div>
            <table cellpadding='0' cellspacing='0' border='0' class='display' id='example'><thead><tr>
                        <th>Room</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                    </tr></thead>
                <tbody>
                    <?php
                    foreach ($rooms as $row) {
                        echo"
                             <tr class='gradeA'>
                         <td style='text-align:center;'><a href='".base_url()."umeme/umeme_statement_details/".$row['rm_id']."'>".$row['room_name']."</a></td>
                         <td>".number_format($row['debit'],$dp)."</td>
                        <td>".number_format($row['credit'],$dp)."</td>
                         <td>".number_format(($row['debit']-$row['credit']),$dp)."</td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

