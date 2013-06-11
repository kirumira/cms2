<!-- Content -->
<div class="content" id="container">
    <?php
    $ci = & get_instance();
    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> > Landlords:</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames">Landlords List:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>No. Buildings</th>
                    <!--<th>Revenue</th>-->
                    <th style="width:40%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($landlords as $landlord): ?>
                    <tr class="gradeA">
                        <td class="center"><a href="<?php echo base_url(); ?>landlords/view_landlord/<?php echo $landlord['id'] ?>" title=""><span><?php echo $landlord['l_name_first'] . " " . $landlord['l_name_last'] ?></span></a></td>
                        <td class="center"><?php echo $landlord['b_num'] ?></td>
                        <!--<td class="center"><a href="<?php echo base_url(); ?>landlords/view/<?php echo $landlord['id'] ?>" title=""><img alt="" src="<?php echo base_url();?>images/icons/dark/list.png"/></a></td>-->
                        <td>                            
                            <a class="btn14 topDir mr5 lreport" original-title="Landlord Revenue" href="<?php echo base_url(); ?>landlords/view/<?php echo $landlord['id'] ?>"><img alt="" src="<?php echo base_url();?>images/icons/dark/money3.png"/></a>
                            <a class="btn14 topDir mr5 ldinfo" original-title="More Info" id="<?php echo $landlord['id'];?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/cog3.png"/></a>
                            <a class="btn14 topDir mr5 ldedit" original-title="Edit" id="<?php echo $landlord['id'];?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/pencil.png"/></a>
                        </td>
                    </tr>    
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
    
</div>


<!--More Landlord info-->

<div id="tdialoginfo" title="More Landlord Information" style="display:none;">
    <div width="100%"><img id="l_pic" width="210px" height="180px" src='' /></div>
    <table style="line-height: 25px; width: 100%;" >
        <tr>
            <td ><span style="float:right; font-weight: 600; font-family: tahoma">Landlord Name:</span></td>
            <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="infolname"></span></td>
<!--            <td rowspan="2"><img id="t_pic" width="250px" height="250px" src='' /></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Email:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infolemail"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Telephone:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infoltel"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Group:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="group"></span></td>
<!--            <td></td>-->
        </tr>
        

    </table>
</div>

<div id="ldialogedit" title="Edit Landlords's Record">
   
    <input type="text" value="" id="landlord_id" style="display:none;" />
    <table style="width:100%">
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">First Name:</span></td>
            <td><input type="text" name="regular" id="editlfname" value=""/></td>
                      
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Last Name:</span></td>
            <td><input type="text" name="regular" id="editllname" value=""/></td>
                     
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Email:</span></td>
            <td><input type="text" name="regular" id="editlemail" value=""/></td>
            
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Telephone:</span></td>
            <td><input type="text" name="regular" id="editltel" value=""/></td>
             </tr>
        <tr>
            <th>Group:</th>
                        <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="group">
                            <option value="None">NONE</option><option value="New">New</option>
                            <?=$groups?>
                            </select>
                        </td>
       </tr>   
      
    </table>
</div>
<div id="ldialogdel" title="Delete Landlord" style="display:none;">
    <input type="text" value="" id="dten_id" style="display:none;" />
    <p>NOT NOW BOSS, It should be a long process </p>
</div>

<script>
    var domain = "<?php echo base_url(); ?>";
 $(document).on('click',"tr .lddel",function(){ 
        $('#ldialogdel').dialog('open');
        //        $('.selectElement').chosen();
    }); 
//landlord more info
    $(document).on('click',"tr .ldinfo",function(){
        
        var landlord_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"landlords/landlord_details",
            data:{
                landlord_id:landlord_id
            },
            success : function(response)
            {                
                if(response.status){
                    $('#infolname').html(response.data.l_name_first+' '+response.data.l_name_last);
                    $('#infolemail').html(response.data.l_email);
                    $('#infoltel').html(response.data.telephone);                  
                    $('#group').html(response.data.group);                    
                    $('#l_pic').attr('src', response.data.lpath);
                    
                    $('#tdialoginfo').dialog('open');
                }
            },
            dataType:'json'
        });
        return false;
    });
    
    //=============================edit landlord====================//
    $(document).on('click',"tr .ldedit",function(){
        var landlord_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"landlords/landlord_details",
            data:{
                landlord_id:landlord_id
            },
            success : function(response)
            {
                if(response.status){
                    $('#landlord_id').val(landlord_id);
                    $('#editlfname').val(response.data.l_name_first);
                    $('#editllname').val(response.data.l_name_last);
                    $('#editlemail').val(response.data.l_email);
                    $('#editltel').val(response.data.telephone);
                    $('#group').val(response.data.group);
                                       
                    $('.selectElement').chosen();
                    $('.selectElement').trigger("liszt:updated");
                    $('#ldialogedit').dialog('open');//tenantreg
                }
            },
            dataType:'json'
        });
        return false;
    });
    
    $( "#ldialogedit" ).dialog({
        autoOpen: false,
        width: 420,
        resizable: false,
        modal: true,            
        buttons: [
        {
            text: "Edit",
            "class": 'btnSavex',
            click: function() {
                var fname = $('#editlfname').val();
                var lname = $('#editllname').val();
                var telephone = $('#editltel').val();
                var email = $('#editlemail').val();
                var group = $('#group').val();
                var landlord_id = $('#landlord_id').val();
                
                if(landlord_id!='' && fname!='' && lname!='' && telephone!='' && email!='' && group!=''){
                    $.ajax({
                        type: 'POST',
                        url: domain+"landlords/edit",
                        data:{
                            landlord_id:landlord_id,
                            f_name:fname,
                            name_last:lname,
                            telephone:telephone,
                            email:email,
                            group:group                            
                        },
                        success : function(response)
                        {
                            if(response.status){      
                                 jAlert("Landlords details changed successfully!","SUCCESS!");
                                $( "#ldialogedit" ).dialog("close");                               
                                window.location = domain+"landlords";
                            }                                        
                        },
                        dataType: 'json'
                    });
                }else{
                    jAlert("Fill all required fields!","ERROR!");
                }
            }
        },
        {
            text: "Close",
            "class": 'btnCancelx',
            click: function() {
                $( "#ldialogedit" ).dialog( "close" );
            }
        }
        ]
    });
    $(document).on('click',"tr .lreport",function(){
    var landlord_id = $(this).attr('id');
    window.location = domain+"reports/print_report/"+landlord_id;
//        $.ajax({
//            type: "POST",
//            url: domain+"reports/print_report",
//            data:{
//                landlord_id:landlord_id
//            },
//            success : function(response){},
//            dataType:'json'
//        });
    });
    
</script>