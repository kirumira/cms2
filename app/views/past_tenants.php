<!-- Content -->

<div class="content" id="container">
    <?php
    $ci = & get_instance();
    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> > Past Tenants' List</h5></div>
    <div class="table">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <div class='head'><h5 class='iFrames'>Past Tenants</h5></div>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Date of Eviction</th>
                    <th>Evicted By</th>
                    <th>Report</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenants as $tenant): ?>
                    <tr class="gradeA">
                        <td><?php echo $tenant['f_name'] . " " . $tenant['l_name'] ?></td>
                        <td><?php echo $tenant['room_name']?></td>
                        <td><?php echo $tenant['telephone'] ?></td>
                        <td><?php echo $tenant['email'] ?></td>
                        <td><?php echo $tenant['ev_date'] ?></td>
                        <td><?php echo $tenant['name_first'] . ' '. $tenant['name_last']?></td>
                        <td><a class="btn14 topDir mr5 Rinfo" original-title="Tenant Report" id="<?php echo $tenant['ev_ten_id']; ?>" href="<?php echo base_url().'reports/tenants_report/'.$tenant['ev_ten_id'].'/2013-02-01/'.date('Y-m-d');?>"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
    </div>



</div>

