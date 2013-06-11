<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5>  Landlord: <?php echo " ". $x[0]['l_name_first']." ".$x[0]['l_name_last'] ?></h5></div>
    <a href="<?php echo base_url(); ?>landlords/edit_landlord/<?php echo $x[0]['id'] ?>" title="">
        <input type="button" value="Edit landlord" class="greenBtn right" />
    </a>
    <a href="<?php echo base_url(); ?>landlords/delete_landlord/<?php echo $x[0]['id'] ?>" title="">
        <input type="button" value="Delete landlord" class="greenBtn right" />
    </a>
    <div class="table">
        <div class="head"><h5 class="iFrames">Landlord Details:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Number Of Buildings</th>
                    <th>Telephone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                    <tr class="gradeA">
                        <td class="center"><?php echo $landlords[0]['b_num'] ?></td>
                        <td class="center"><?php echo $x[0]['telephone'] ?></td>
                        <td class="center"><?php echo $x[0]['l_email'] ?></td>
            </tbody>
        </table>
    </div>

</div>