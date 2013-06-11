<!-- Content -->


    <div class="content" id="container">
        <div class="title"><h5>Managers:</h5></div>
    	<div class="table">
            <div class="head"><h5 class="iFrames">Managers List:</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
<!--                        <th>Manager Type</th>-->
                        <th style="width:90px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $manager): ?>
                    <tr class="gradeA">
                        <td><?php echo $manager['name_first']." ". $manager['name_last'] ?></td>
                        <td><?php echo $manager['name_user']?></td>
<!--                        <td><?php echo $manager['type']?></td>-->
                        <td>
                            <a class="btn14 topDir mr5 mndit" original-title="Edit" id="<?php echo $manager['name_id'];?>" href="#"><img alt="" src="images/icons/dark/pencil.png"/></a>
                            <a class="btn14 topDir mr5 mndel" original-title="Delete" id="<?php echo $manager['name_id'];?>" href="#"><img alt="" src="images/icons/dark/trash.png"/></a>
                        </td>
                  <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
