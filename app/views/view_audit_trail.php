<!-- Content -->

    <div class="content" id="container">
        <div class="title"><h5>Audit Trail:</h5></div>
    	<div class="table">
            <div class="head"><h5 class="iFrames">Audit Trail:</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($audit_data as $data): ?>
                    <tr class="gradeA">
                        <td><?php echo $data['audit_date']?></td>
                        <td><?php echo $data['audit_username']?></td>
                        <td><?php echo $data['audit_action']?></td>
                  <?php endforeach ?>
                </tbody>
            </table>
        </div>



    </div>
