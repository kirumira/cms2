<div class="content" id="container">

    <div class="title"><h5><?php echo $this->session->userdata('building_name');?></h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Buildings Details</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Landlord</th>
                    <th>Number of Floors</th>
                    <th>Location</th>
                    <th>Manager</th>
                    <th>Type</th>
                    <th>Currency</th>
                    <th>Street</th>
                    <th>Plot</th>                    
                    <th>Block</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buildings as $building): ?>
                <tr class="gradeA">
                    
                    <td class="center"><?php echo $building['l_name_first']. " ". $building['l_name_last']?></td>
                    <td class="center"><?php echo $building['b_num_floors']?></td>
                    <td class="center"><?php echo "P.O. Box ".$building['p_o_box'].", ".$building['b_town'].", ".$building['b_district']?></td>
                    <td class="center"><?php echo $building['name_first']." ".$building['name_last']?></td>
                    <td class="center"><?php echo $building['b_type']?></td>
                    <td class="center"><?php echo $building['currency']?></td>
                    <td class="center"><?php echo $building['street']?></td>
                    <td class="center"><?php echo $building['plot']?></td>
                     <td class="center"><?php echo $building['block']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>



</div>
