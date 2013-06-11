<!-- Content -->
<?php $dp = 0; ?>
<div class="content" id="container">
    <div class="title" style="width: 60%;"><h5>Landloard Details:</h5></div>

    <div class="table" style="width: 60%;">
        <div class="head"><h5 class="iFrames">Landlord Details > <?php echo $landlords[0]['l_name_first'] . " " . $landlords[0]['l_name_last'] ?></h5></div>


        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr class="gradeA">
                    <th>Building</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buildings as $row): ?>
                    <tr class="gradeA">
                        <td><?= $row['b_name'] ?></td>
                        <td><div class="rowElem nobg"><a href="<?php echo base_url(); ?>buildings/view_revenue_summary/<?php echo $row['b_id'] ?>" title="View Revenue Details">
                                    <?php
                                    if ($row['revenue'] != 0) {
//                    echo number_format($row['revenue'],$dp).'('.$row['currency'].')';
                                        echo $row['currency'] . '. ' . number_format($row['revenue'], $dp);
                                    } else {
                                        echo 0;
                                    }
                                    ?></a></div></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
    </div>



</div>