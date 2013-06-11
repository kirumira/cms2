<!-- Content -->

<div class="content" id="container">
    <?php
    $ci = & get_instance();
    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> > Tenants' List</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames">Tenants List:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Building</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenants as $tenant): ?>
                    <tr class="gradeA">
                        <td><a href="<?php echo base_url(); ?>tenants/view/<?php echo $tenant['id']; ?>" title="View Tenant's details"><?php echo $tenant['f_name'] . " " . $tenant['l_name'] ?></a></td>
                        
                        <td><?php echo $tenant['b_name'] ?></td>
                        <td><?php echo $tenant['status'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>



</div>
