<!-- Content -->

<div class="content" id="container">
    <?php $ci = & get_instance(); ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> > Tenants</h5></div>
    
    <div class="table" id="tenantstable">
        <div class="head"><h5 class="iFrames">Tenant Details:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="dynptable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Floor</th>
                    <th>Room</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th style="width:127px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenants as $tenant): ?>
                    <tr class="gradeA" id="ten_<?php echo $tenant['id'];?>">
                        <td><?php echo $tenant['f_name'] . " " . $tenant['l_name'] ?></td>

                        
                        <td><?php echo $tenant['flr_name'] ?></td>
                        <td id="t_rm_<?php echo $tenant['id'];?>"><?php echo $tenant['room_name'] ?></td>
                        <td><?php echo $tenant['telephone'] ?></td>
                        <td><?php echo $tenant['status'] ?></td>
                        <td width="20%">
                            <a class="btn14 topDir mr5 tinfo" original-title="More Info" id="<?php echo $tenant['id']; ?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/cog3.png"/></a>

                           <?php if($ci->session->userdata('user_type')!='landlord'){?>
                            <a class="btn14 topDir mr5 tnotes" original-title="Tenant's Notes" id="<?php echo $tenant['id']; ?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/paperclip.png"/></a>
                            <a class="btn14 topDir mr5 tedit" original-title="Edit" id="<?php echo $tenant['id']; ?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/pencil.png"/></a>
                            <a class="btn14 topDir mr5 tdel" original-title="Delete" id="<?php echo $tenant['id']; ?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/trash.png"/></a>
                       <?php } ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div id="tenantnotestable" style="display:none;">
            <input type="text" value="" id="ntenant_id" style="display:none;" />
            <a class="btnIconLeft mr10" id="backclicker" title="" href="#" style="border-radius: 0 17px 0 17px;  margin-left: 0; margin-top: 9px; position: relative"><img class="icon" alt="" src="images/icons/dark/arrowLeft.png"/><span>Back</span></a>
            <div class="widget searchers" style="margin-top: 9px;">
                <div class="head"><h5 class="iSearch">Search (by date)</h5></div>
                <div class="body alignleft">
                    <label style="margin-left: 4%;">From Date: &nbsp;</label>
                    <input type="text" class="datepicker datee" id="tnotes_frdate" style="margin-right: 1%; width: 19% !important;"/>
                    <label>To Date: &nbsp;</label>
                    <input type="text" class="datepicker datee" id="tnotes_todate" style="width: 19% !important;"/>
                    <a class="btnIconLeft mr10" id="notes_searcher" title="" href="#" style="border-radius: 17px 17px 17px 17px;  margin-left: 1%; margin-bottom: -13px; position: static"><img class="icon" alt="" src="images/icons/toolbar_find.png"/><span>Search</span></a>
                    <a class="btnIconLeft mr10" id="adminprinter" title="" href="#" style="border-radius: 17px 17px 17px 17px;  margin-left: 0%; margin-bottom: -13px; position: static"><img class="icon" alt="" src="images/icons/dark/printer.png"/><span>Print &nbsp;</span></a>
                </div>
            </div>

        <!-- Dynamic table -->
            <div class="table"  style="margin-top: -1px;">
                <div class="head"><h5 class="iFrames" id="tenhead">Tenant Notes [ this week ]</h5></div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="dynten_notes">
                        <thead>
                            <tr>
                                <td width="15%">Date</td>
                                <td>Subject</td>                        
                                <td>Added by</td>
                                <td>Note </td>
                            </tr>
                        </thead>
                        <tbody id="tennotes_body">
                            
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    <div class="fix"></div>


</div>
<div id="tdialoginfo" title="More Tenant Information" style="display:none;">
    <div width="100%"><img id="t_pic" width="210px" height="180px" src='' /></div>
    <table style="line-height: 25px; width: 100%;" >
        <tr>
            <td ><span style="float:right; font-weight: 600; font-family: tahoma">Tenant Name:</span></td>
            <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotname"></span></td>
<!--            <td rowspan="2"><img id="t_pic" width="250px" height="250px" src='' /></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Email:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotemail"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Telephone 1:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infottel1"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Telephone 2:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infottel2"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Telephone 3:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infottel3"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Contact Person</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotcontp"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Telephone:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotcontptel"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Starting Date:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotstart"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Hand over Date:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotend"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Down Payment:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotdpay"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Status:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotstatus"></span></td>
<!--            <td></td>-->
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Purpose:</span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infotpurpose"></span></td>
<!--            <td></td>-->
        </tr>

    </table>
</div>



<div id="tdialogedit" title="Edit Tenant's Record">
    <input type="text" value="" id="tenant_id" style="display:none;" />
    <input type="text" value="" id="flr_name" style="display:none;" />
    <table style="width:100%">
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">First Name:</span></td>
            <td><input type="text" name="regular" id="edittfname" value=""/></td>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Contact Person</span></td>
            <td><input type="text" name="regular" id="edittcontp" value=""/></td>            
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Last Name:</span></td>
            <td><input type="text" name="regular" id="edittlname" value=""/></td>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Telephone:</span></td>
            <td><input type="text" name="regular" id="edittcontptel" value=""/></td>            
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Email:</span></td>
            <td><input type="text" name="regular" id="edittemail" value=""/></td>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Starting Date:</span></td>
            <td><input type="text" name="regular" id="edittstart" value="" class="datepicker"/></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Telephone 1:</span></td>
            <td><input type="text" name="regular" id="editttel1" value=""/></td>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Hand over Date:</span></td>
            <td><input type="text" name="regular" id="edittend" value="" class="datepicker"/></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Telephone 2:</span></td>
            <td><input type="text" name="regular" id="editttel2" value=""/></td>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Down Payment:</span></td>
            <td><input type="text" name="regular" id="edittdpay" value=""/></td>            
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Telephone 3:</span></td>
            <td><input type="text" name="regular" id="editttel3" value=""/></td> 
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Status:</span></td>
            <td><select style="width:264px; max-height: 140px;" class="selectElement" name="select" id="edittstatus" tabindex="2">
                    <option></option>
                    <option value="POTENTIAL">POTENTIAL</option>
                    <option value="CURRENT">CURRENT</option>
                    <option value="EVICTED">EVICTED</option>
                    <option value="PAST">PAST</option>
                </select></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Purpose:</span></td>
            <td><input type="text" name="regular" id="edittpurpose" value=""/></td>
            <td></td>
            <td></td>
        </tr>

    </table>
</div>
<div id="tdialogdel" title="Delete Tenant">
    <input type="text" value="" id="dten_id" style="display:none;" />
    <p>Are you sure you want to delete the tenant: <b><span id="deltname"></span></b>?</p>
</div>


<script>
    var dynamic = dynamic || {};
     dynamic.dynptable=$('#dynptable').dataTable({
                        "bJQueryUI": true,
                        "sPaginationType": "full_numbers",
                        "sDom": '<""f>t<"F"lp>'
    });
</script>
<script>
    //=============Tenant notes====================//
    

    $(document).on('click',"tr .tnotes",function(){
        var t_id = $(this).attr('id');
         $('#ntenant_id').val(t_id);
         $('#tenantstable').hide("slide", { direction: "left" }, 700);
         setTimeout(function(){
             $('#tenantnotestable').show("slide", { direction: "right" }, 800);
         },700);
         $('#ntenant_id').val(t_id);
         $('#tennotes_body').load("<?php echo base_url()?>tenants/get_week_notes/"+t_id);
         
    });
    $(document).on('click'," #backclicker",function(){
            $('#tenantnotestable').hide("slide", { direction: "right" }, 700);
         setTimeout(function(){
            $('#tenantstable').show("slide", { direction: "left" }, 1000);
         },700);
        return false;
    });
    $(document).on('click','#notes_searcher',function(){
        var frdate = $('#tnotes_frdate').val();
        var todate = $('#tnotes_todate').val();
        var ten_id = $('#ntenant_id').val();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url()?>tenants/get_notes/"+ten_id+'/'+frdate+'/'+todate,
            success: function(response){
                if(response.status){
                    $('#tennotes_body').html(response.data);
                    $('#tnotes_frdate').val('');
                    $('#tnotes_todate').val('');
                }else{
                    jAlert('\'From Date\' must be less than \'To Date\'','ERROR');
                }
            },
            dataType: 'json'
        });
    });
</script>>