<!-- Content -->

<div class="content" id="container">
    <div class="title"><h5>Landloard Details:</h5></div>
    
    <div class="table">
        <div class="head"><h5 class="iFrames">Room Revenue Details > <?php echo $revenue[0]['room_name']; ?></h5></div>


        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr class="gradeA">
                    <th>Date</th>
                    <th>Details</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($revenue as $row): ?>
                    <tr class="gradeA">
                        <td><?= $row['b_name'] ?></td>
                        <td><div class="rowElem nobg"><a href="<?php echo base_url(); ?>bills/statement/<?php echo $row['b_id'] ?>" title="View Revenue Details">
                            <?php
                if ($row['revenue'] != 0) {
                    echo $row['revenue'];
                } else {
                    echo 0;
                }
                ?></a></div></td>

                    </tr>

<?php endforeach ?>



            </tbody>
        </table>
        <input type="button" value="Revenue Total = <?php
if ($total) {
    echo $total;
} else {
    echo"0.00";
}
?>" class="greenBtn" />
    </div>



</div>