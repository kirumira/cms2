	<!-- Content -->

    <div class="content" id="container">
        <div class="title"><h5><?php echo $this->session->userdata('building_name')?> > Building Details</h5></div>   	
       
        <a href="<?php echo base_url(); ?>bills" title="">
            <input type="button" value="Bill For Rent" class="greenBtn right" />
        </a>

        <a href="<?php echo base_url(); ?>bills/umeme/<?php echo $this->session->userdata('building_id') ; ?>" title="">
            <input type="button" value="Bill For UMEME" class="greenBtn right" />
        </a>
        <a href="<?php echo base_url(); ?>bills/umeme_statement" title="">
            <input type="button" value="UMEME BILL STATEMENT" class="greenBtn right" />
        </a>
        
        <div class="table">
            <div class="head"><h5 class="iFrames">Tenant Summary:</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Tenant</th>
                        <th>Room</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tenants as $tenant): ?>
                    <tr class="gradeA">
                        <td><a href="<?php echo base_url()."/tenants/view_tenant/".$tenant['id']?>"><?php echo $tenant['f_name']." ".$tenant['l_name']?></a></td>
                        <td><?php echo $tenant['room_name']?></td>
                        <td><?php echo $tenant['status']?></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
