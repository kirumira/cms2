<!-- Content -->
<?php $dp=0;?>
<div class="content" id="container">

    <div class="title"><h5> Umeme Report</h5></div>
   
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Umeme Changing Report</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Rate (Ushs)</th>
                    <th>Edited By</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $x = 1;
                foreach ($reports as $report):
                    ?>
                    <tr class="gradeA">
                        <td class="center"><?php echo date('d-m-Y',strtotime($report['u_edit_date'])) ?></td>
                        <td class="center"><?php echo number_format($report['u_edit_rate'],$dp) ?></td>
                        <td class="center"><?php echo $report['u_edit_by'] ?></td>
                        
                    </tr>
                    <?php
                    $x++;
                endforeach
                ?>
            </tbody>
        </table>
    </div>
   
</div>









