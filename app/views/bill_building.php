<div class="content" id="container">

    <div class="title"><h5><?php echo $this->session->userdata('building_name'); ?></h5></div>
     <!--<a href="<?php echo base_url(); ?>bills/bill" title="">-->
    <a href="#" tittle="" id ="bill">
        <input type="button" value="Bill For Rent" class="greenBtn right" />
    </a>

    <a href="<?php echo base_url(); ?>bills/umeme" title="">
        <input type="button" value="Bill For UMEME" class="greenBtn right" />
    </a>
    <a href="<?php echo base_url(); ?>bills/umeme_statement" title="">
        <input type="button" value="UMEME BILL STATEMENT" class="greenBtn right" />
    </a>
    <a href="<?php echo base_url(); ?>bills/floors/<?php echo $this->session->userdata('building_id'); ?>" title="">
        <input type="button" value="Bill Per Floor" class="greenBtn right" />
    </a>
    <a href="<?php echo base_url(); ?>bills/rooms/<?php echo $this->session->userdata('building_id'); ?>" title="">
        <input type="button" value="Bill Per Room" class="greenBtn right" />
    </a>
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

                        <td class="center"><?php echo $building['l_name_first'] . " " . $building['l_name_last'] ?></td>
                        <td class="center"><?php echo $building['b_num_floors'] ?></td>
                        <td class="center"><?php echo "P.O. Box " . $building['p_o_box'] . ", " . $building['b_town'] . ", " . $building['b_district'] ?></td>
                        <td class="center"><?php echo $building['name_first'] . " " . $building['name_last'] ?></td>
                        <td class="center"><?php echo $building['b_type'] ?></td>
                        <td class="center"><?php echo $building['currency'] ?></td>
                        <td class="center"><?php echo $building['street'] ?></td>
                        <td class="center"><?php echo $building['plot'] ?></td>
                        <td class="center"><?php echo $building['block'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>



</div>
<div id="billdialog" title="Building Billing Dialogue" style="display:none;">
<p align ="center"><h4>You are about to bill the entire building. </h4></p></br>
<p align ="center"><h4>Would You like to continue? </h4></p></br>
</div>
<script>
    
    $(function() {

    var domain = "http://localhost/cms/";
    //===========Building Billing dialog=======================//
    $(document).on('click',"#bill",function(){       
        $('#billdialog').dialog('open');
    }); 
     ///=========tenant delete===================//
    $("#billdialog").dialog({
        autoOpen: false,
        width: 400,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Yes",
            "class": "btnSavex",
            click: function(){
                var tenant_id = $('#dten_id').val();
                $.ajax({
                    type: "GET",
                    url: domain+"bills/bill",
                    success : function(response)
                    {          
                        if(response.status){   
                            window.location = domain+response.page;
                        }  
                    },
                    dataType:'json'
                });
                return false;
            }
        },
        {
            text: "No",
            "class": "btnCancelx",
            click: function(){
                $("#billdialog").dialog("close");
            }
        }
        ]
    });
    });

</script>