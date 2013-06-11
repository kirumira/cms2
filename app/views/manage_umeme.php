<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5> Manage UMEME Rates Here</h5></div>
    <a href="<?php echo base_url(); ?>bills/edit_umeme" title="">
        <input type="button" value="Edit UMEME Rates" class="greenBtn right" />
    </a>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Current UMEME Rates</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Quantity</th>
                    <th>Rate (Ushs)</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($curr as $cur): ?>
                    <tr class="gradeA">
                        <td class="center"><?php echo $cur['quantity'] ?></td>
                        <td class="center"><?php echo $cur['rate'] ?></td>
                    </tr>
                <?php  endforeach ?>
            </tbody>
        </table>
    </div>
    

</div>