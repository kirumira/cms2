<!-- Left navigation -->

<?php $dp = 2;?>
<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>css/jquery.validity.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.validity.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom_silo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom_Aziz.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.numeric.js"></script>

<?php //print_r($this->x['floor_names']);?>

<div class="leftNav">
    <?php $ci = & get_instance();?>
    <ul id="menu">

        <li class="b_menu"><a href="<?php echo base_url(); ?>projects" title="" class="active" ><span>Buildings

            <?php
                if($active == 'BD'){
                    echo '<img style="border-radius:20px;float:right;margin-right:5%;background-color:white;" src="'.base_url().'images/updateDone.png"/></span></a>';
                }else{
                    echo '</span></a>';
                }
            ?>

            <ul class="sub">

                <li><a href="<?php echo base_url();?>buildings/xx" title="">View Buildings</a></li>
               
            </ul>
        </li>

        <?php

        if ($ci->session->userdata('building_id') != null) {
            $building_name = $ci->session->userdata('building_name');
            $floors = $ci->session->userdata('floors');   ?>

        <?php
        echo '<li class="x_menu"><a href="'. base_url() .'buildings" title="" class="active"><span>'. $building_name.' ('.$this->session->userdata('currency').')' ;
                if($active == 'XB'){
                    echo '<img style="border-radius:20px;float:right;margin-right:5%;background-color:white;" src="'.base_url().'images/updateDone.png"/></span></a>';
                }else{
                    echo '</span></a>';
                }
            echo "
                <ul class='sub'>
                    <li>
                        <a href='" . base_url() . "buildings/floor_plan" . "' title=''>
                            Floor Plan
                        </a>
                    </li>
                    
                    <li>
                        <a href='" . base_url() . "buildings/viewfiles/" . $ci->session->userdata('building_id') . "' title=''>
                            View Building Documents
                        </a>
                    </li>
                    
                </ul>
            </li>";

         echo "<li class='r_menu'><a href='" . base_url() . "buildings' title='' class='active'><span>Reports";
            if($active == 'RP'){
                echo '<img style="border-radius:20px;float:right;margin-right:5%;background-color:white;" src="'.base_url().'images/updateDone.png"/></span></a>';
            }else{
                echo '</span></a>';
            }
            echo "
            <ul class='sub'>

                <li>
                    <a id='build_report' href='#' title=''>
                        Building Report
                    </a>
                </li>";
                if($ci->session->userdata('name_group')!=2){
                    echo "
                <li>
                    <a id='land_report' href='#' title=''>
                        Landlords Report
                    </a>
                </li>
                <li>
                    <a id='land_report2' href='#' title=''>
                        Landlords Detailed Report
                    </a>
                </li>";
                }
                echo "

                <li>
                    <a id= 'ten_report' href='#' title=''>
                        Tenant Report
                    </a>
                </li>

                <li>
                    <a id='rm_report' href='#' title=''>
                        Room Report
                    </a>
                </li>

                <li>
                    <a id='dr_report' href='#' title=''>
                        Debtors Report
                    </a>
                </li>

                <li>
                    <a id='umem_report' href='#' title=''>
                        Umeme Report
                    </a>
                </li>

                <li>
                    <a id='dai_report' href='#' title=''>
                        Daily Report
                    </a>
                </li>";
                if($ci->session->userdata('name_group')!=2){
                    echo "
                <li>
                    <a id='dai_gen_report' href='#' title=''>
                        Daily General Report
                    </a>
                </li>";
                }
                echo "

                <li>
                    <a id='bounced_report' href='#' title=''>
                        Bounced Cheques Report
                    </a>
                </li>
            </ul>
        </li>";

   

        echo "
        <li class='t_menu'><a href='" . base_url() . "buildings' title='' class='active'><span>Tenants";
            if($active == 'TN'){
                echo '<img style="border-radius:20px;float:right;margin-right:5%;background-color:white;" src="'.base_url().'images/updateDone.png"/></span></a>';
            }else{
                echo '</span></a>';
            }
            echo "
            <ul class='sub'>
                <li>
                    <a href='" . base_url() . "tenants' title=''>
                        View Tenants
                    </a>
                </li>
           
            </ul>
        </li>";}
        ?>
  

    </ul>

</div>

<!--  Add Building  form  -->

<div id="buildingreg" title="Add New Building" style="display:none;">
    <form>
    <table style="width:100%;">
        <tr>
            <th>Building Name: </th>
            <td ><input type="text" name="regular" id="regbname" value="" title="Name"/></td>
            <th>P.O.BOX: </th>
            <td ><input type="text" name="regular" title="address" id="regaddress" value=""/></td>
        </tr>
        <tr>
            <th>Town: </th>
            <td ><input type="text" name="regular" title="town" id="regtown" value=""/></td>
            <th>District: </th>
            <td ><input type="text" name="regular" id="regdistrict" value="" title="district"/></td>
        </tr>
        <tr>
            <th>Number of floors: </th>
            <td ><input type="text" name="regular" id="regfloors" value="" title="floors"/></td>
            <th>Manager:</th>
            <td><div><select title="manager" style="width:260px;font-family: Arial,Helvetica,sans-serif; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regmanager" tabindex="2">
                    <option value="Select Option" style="margin-top:5px;">Select Option</option>
                    <?php if (isset($managers)) { ?>
                        <?php foreach ($managers as $v): ?>
                            <?php echo '<option value="' . $v['id'] . '">' . $v['name'] . '</option>'; ?>
                        <?php endforeach;
                    }
                    ?>
                </select></div>
            </td>
        </tr>
        <tr>
            <th>Landlord:</th>
            <td><select title="landlord" style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="reglandlord" tabindex="2">
                    <option value="Select Option">Select Option</option>
                    <?php if (isset($landlords)) { ?>
                        <?php foreach ($landlords as $v): ?>
                            <?php echo '<option value="' . $v['id'] . '">' . $v['name'] . '</option>'; ?>
                        <?php endforeach;
                    }
                    ?>
                </select>
            </td>
            <th>Type:</th>
            <td><select title="type" style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regtype" tabindex="2">
                    <option>Select Option</option>
                    <option>COMMERCIAL</option>
                    <option>RESIDENTIAL</option>
                    <option>WAREHOUSE</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Currency:</th>
            <td><select title="currency" style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regcurrency" tabindex="2">
                    <option>UGX</option>
                    <option>USD</option>
                </select>
            </td>
            <th>Plot Number: </th>
            <td ><input title="plot" type="text" name="regular" id="regplotno" value=""/></td>
        </tr>
        <tr>
            <th>Property Number: </th>
            <td ><input title="property" type="text" name="regular" id="regpropno" value=""/></td>
            <th>Block Number: </th>
            <td ><input title="block" type="text" name="regular" id="regblockno" value=""/></td>
        </tr>
        <tr>
            <th>Street Name: </th>
            <td ><input title="street" type="text" name="regular" id="regstreetname" value=""/></td>

        </tr>
    </table>
    </form>
<!--    <button id="bb" style="display:none;">test!</button>-->

<!--    <div style="margin-left: 62px;"><img id="adminregloader" style=" display:none;" class="p12" alt="" src="images/loaders/loader7.gif" /></div>-->
</div>

<!--  Add Tenant  form  -->

<div id="tenantreg" title="Add New Tenant" style="display:none;">
    <form id="ten_reg_form">
    <table style="width:100%;">
        <tr>
            <th id="nm_hd"></th>
            <td ><input title="first name" type="text" name="regular" id="regtfname" value=""/></td>
<!--            <th>Last Name: </th>
            <td ><input title="last name" type="text" name="regular" id="regtlname" value=""/></td>-->
            <th>Type: </th>
            <td style="vertical-align: middle;"><select id="regttype" style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement">
                    <option value="individual">individual</option>
                    <option value="company">company</option>
                </select></td>
        </tr>
        <tr>
            <th>Last Name: </th>
            <td ><input title="last name" type="text" name="regular" id="regtlname" value=""/></td>
            <th>Room:</th>
            <td style="vertical-align: middle;"><select title="room" style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regtroom" tabindex="2">
                </select>
            </td>
        </tr>
        <tr>
            <th>Email: </th>
            <td ><input title="email" type="text" name="regular" id="regtemail" value=""/></td>
            <th>Contact Person: </th>
            <td ><input title="contact person" type="text" name="regular" id="regtcontactp" value=""/></td>


        </tr>
        <tr>
<!--            <th>Telephone 2:</th>
            <td ><input title="telephone 2" type="text" name="regular" class="phonenumeric" id="regttel2" value=""/></td>-->
            <th>Telephone 1: </th>
            <td ><input title="telephone 1" type="text" name="regular" id="regttel1" class="phonenumeric" value=""/></td>
            <th>Contact Person Telephone: </th>
            <td ><input title="telephone" type="text" name="regular" id="regtconttel" class="phonenumeric" value=""/></td>
        </tr>
        <tr>
<!--            <th>Telephone 3:</th>
            <td ><input title="telephone 3" class="phonenumeric" type="text" name="regular" id="regttel3" value=""/></td>-->
            <th>Telephone 2:</th>
            <td ><input title="telephone 2" type="text" name="regular" class="phonenumeric" id="regttel2" value=""/></td>
            <th>Starting Date: </th>
            <td ><input title="starting date" type="text" name="regular" id="regtstart" value="" class="datepicker"/></td>
        </tr>
        <tr>
            <th>Down Payment: </th>
            <td ><input title="down payment" type="text" name="regular" id="regtdownp" value="" class="positivenumeric"/></td>
            <th>Hand over Date: </th>
            <td ><input title="hand over date" type="text" name="regular" id="regtend" value="" class="datepicker"/></td>
        </tr>
        <tr>
            <th>Security Deposit: </th>
            <td ><input title="security deposit" type="text" name="regular" id="regtsecdep" value="" class="positivenumeric"/></td>
            <th>Purpose: </th>
            <td ><input title="purpose" type="text" name="regular" id="regtpurpose" value=""/></td>
        </tr>
    </table>
    </form>
</div>

<!--Upload Tenant Picture Form-->
<div id="tpicupload" title="Upload Tenant Picture" style="display:none;">
    <table width="100%">
        <tr>
            <td for="txtURL">Tenant Name: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="all_tenants" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr><td></td><td><br></td></tr>
        <tr>
            <td for="txtURL">Tenant Picture: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <span><input type="file" name="txtURL" id="txtURL" width="126px" value=""/></span
            </td>
        </tr>
    </table>
</div>
<!--Upload Tenant Document Form-->
<div id="tdocupload" title="Upload Tenant Document" style="display:none;">
    <div class="field">
        <table>
            <tr>
                <th class="w15 left" for="txtURL15" >Tenant Name: </th>
                <td style="vertical-align: middle;padding-left: 10px;">
                    <select style="width:294px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="all_tens_xr" tabindex="2">
                        <option value="Select Option">Select Option</option>
                    </select>
                    <br><br>
                </td>
            </tr>
            <tr>
                <th class="w15 left" for="txtURL15">Tenant Document: </th>
                <td style="padding-left: 10px;">
                    <input class="w60" type="file" name="txtURL15" id="txtURL15" width="200px" value=""/><br><br>
                </td>
            </tr>
        </table>
    </div>
</div>

<!--Upload Tenant Document Form-->
<div id="tdocupload" title="Upload Tenant Document" style="display:none;">
    <div class="field">
        <table>
            <tr>
                <th class="w15 left" for="txtURL15" >Tenant Name: </th>
                <td style="vertical-align: middle;padding-left: 10px;">
                    <select style="width:294px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="all_tens" tabindex="2">
                        <option value="Select Option">Select Option</option>
                    </select>
                    <br><br>
                </td>
            </tr>
            <tr>
                <th class="w15 left" for="txtURL15">Tenant Document: </th>
                <td style="padding-left: 10px;">
                    <input class="w60" type="file" name="txtURL15" id="txtURL15" width="200px" value=""/><br><br>
                </td>
            </tr>
        </table>
    </div>
</div>

<!--Upload Tenant Dialog Tenant Form-->
<div id="show_ten_doc" title="Tenant Documents" style="display:none;">
    <div class="field">
        <table>
            <tr>
                <th class="w15 left" for="txtURL1" >Tenant Name: </th>
                <td style="vertical-align: middle;padding-left: 10px;">
                    <select style="width:294px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="all_tens_dx" tabindex="2">
                        <option value="Select Option">Select Option</option>
                    </select>
                    <br><br>
                </td>
            </tr>
        </table>
    </div>
</div>

<!--Upload System User Picture Form-->
<div id="upicupload" title="Upload System User Picture" style="display:none;">
    <table width="100%">
        <tr>
            <td for="txtURL">System User's Name: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="all_users" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr><td></td><td><br></td></tr>
        <tr>
            <td for="txtURL">System User Picture: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <span><input type="file" name="txtURL2" id="txtURL2" width="126px" value=""/></span
            </td>
        </tr>
    </table>
</div>
<!--currency registration form-->
<div id="curreg" title="Add New Currency" style="display:none;">
    <table style="width:300px;">

        <tr>
            <th>Currency: </th>
            <td ><input type="text" name="regular" id="cur" value=""/></td>
        </tr>
        <tr>
            <th>Rate(Ushs): </th>
            <td ><input type="text" name="regular" id="rate" value=""/></td>
        </tr>

    </table>
</div>
<div id="previewx" title="Preview" style="display:none;">
    <img id="logoPreview" width="100%" height="250px" src='' />
</div>
<div id="landlordregform" title="Add New Landlord" style="display:none;"></div>
<div id="adminregform" title="Add New System User" style="display:none;"></div>

<div id="paymentform" title="Enter Payments" style="display:none;">
    <table>
        <tr>
            <th>Room : </th>
            <td style="vertical-align: middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="payroom" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select><br><br>
            </td>
        </tr>
        <tr>
            <th>Date :</th>
            <td ><input type="text" name="regular" id="paydate" value="" class="datepicker"/></td>
        </tr>
        <tr>
            <th>Particulars :</th>
            <td style="vertical-align: middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="payparticulars" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select><br><br>
            </td>
        </tr>
        <tr>
            <th>Mode of Payment :</th>
            <td style="vertical-align: middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="paymode" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select><br><br>
            </td>
        </tr>
        <tr>
            <th>Currency :</th>
            <td style="vertical-align: middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="paycurrency" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select><br><br>
            </td>
        </tr>
        <tr>
            <th>Amount :</th>
            <td ><input type="text" name="regular" id="payamount" value=""/></td>
        </tr>
        <tr>
            <th>Received From :</th>
            <td ><input type="text" name="regular" id="payfrom" value=""/></td>
        </tr>
        <tr>
            <th>Check No :</th>
            <td ><input type="text" name="regular" id="paycheck" value=""/></td>
        </tr>
        <tr>
            <th>Bank slip No :</th>
            <td ><input type="text" name="regular" id="payslip" value=""/></td>
        </tr>
    </table>
</div>
<!--Add Tenants Notes Form -->
<div id="tenantNotesForm" title="Add Tenant's Notes" style="display:none;">
    <table style="width: 90%;">

        <tr>
            <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma"> Tenant :</span></td>
            <td style="vertical-align: middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="tenant" tabindex="2">
                    <option value="Select Option">Select Option</option>
                    <?php if (isset($tenants)) { ?>
                        <?php foreach ($tenants as $v): ?>
        <?php echo '<option value="' . $v['id'] . '">' . $v['t_name'] . '</option>'; ?>
    <?php endforeach;
}
?>
                </select>
            </td>  </tr>
        <tr>
            <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Details :</span></td>
            <td style="vertical-align: middle; padding-left: 20px;" ><textarea id="tenantNotes" name="textarea" cols="1" rows="2"></textarea></span></td>
        </tr>
        <tr>
        </tr>

    </table>
</div>
<!--more floors registration form-->
<div id="floorreg" title="Add More floors" style="display:none;">
    <table style="width:300px;">

        <tr>
            <th>Number of floors: </th>
            <td ><input type="text" name="regular" id="flrs" value=""/></td>
        </tr>
    </table>
</div>

<div id="addnotedialog" title="Add Note" style="display:none;">
    <table width="93%">
        <tr>
            <th style="vertical-align:top;">Type: </th>
            <td style="width:60%;">
                <select class="selectEl" style="width:200%;" id="xtype">
                    <option>Select Type</option>
                    <option value="Tenant">Tenant</option>
                    <option value="Room">Room</option>
                    <option value="Floor">Floor</option>
                    <option value="Building">Building</option>
                </select><br>
            </td>
        </tr>
        <tr>
            <th style="vertical-align:top;">Name: </th>
            <td style="width:60%;">
                <select class="selectEl" style="width:200%;" id="xnames"></select><br>
            </td>
        </tr>
        <tr>
            <th style="vertical-align:top;">Subject: </th>
            <td style="width:60%;">
                <input type="text" name="regular" id="xsubject" value=""/><br><br>
            </td>
        </tr>
        <tr>
            <th style="vertical-align:top;">Text:</th>
            <td style="width:60%;">
                <textarea id="xnote" name="textarea" cols="1" rows="5"></textarea>
            </td>
        </tr>

    </table>
</div>

<!--Building Report Form-->
<div id="b_report" title="Building Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Building: </td>
            <td><?php echo $building_name;?></td>
        </tr>
        <tr>
            <td>From: </td>
            <td><input id="r_start" type="text" class="datepicker"/></td>
        </tr>
        <tr>
            <td>To: </td>
            <td><input id="r_end" type="text" class="datepicker"/></td>
        </tr>
        <tr><td><input id="B_report_val" value="<?php echo $this->session->userdata('building_id'); ?>" style="display:none;" /></td></tr>
    </table>
</div>
<!--Landlord Report Form-->
<div id="l_report" title="Landlord Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Landlord: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="report_l" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>From: </td>
            <td><input id="r_start_l" type="text" class="datepicker"/></td>
        </tr>
        <tr>
            <td>To: </td>
            <td><input id="r_end_l" type="text" class="datepicker"/></td>
        </tr>
    </table>
</div>
<!--Tenant Report Form-->
<div id="t_report" title="Tenant Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Tenant: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="report_t" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>From: </td>
            <td><input id="r_start_t" type="text" class="datepicker"/></td>
        </tr>
        <tr>
            <td>To: </td>
            <td><input id="r_end_t" type="text" class="datepicker"/></td>
        </tr>
    </table>
</div>
<!--Room Report Form-->
<div id="r_report" title="Room Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Room: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="report_r" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>From: </td>
            <td><input id="r_start_r" type="text" class="datepicker"/></td>
        </tr>
        <tr>
            <td>To: </td>
            <td><input id="r_end_r" type="text" class="datepicker"/></td>
        </tr>
    </table>
</div>
<!--Umeme Report Form-->
<div id="um_report" title="Umeme Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Room: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="report_um" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>From: </td>
            <td><input id="um_start_r" type="text" class="datepicker"/></td>
        </tr>
        <tr>
            <td>To: </td>
            <td><input id="um_end_r" type="text" class="datepicker"/></td>
        </tr>
    </table>
</div>
<!--Debtors Report Form-->
<div id="d_report" title="Debtors Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Building: </td>
            <td><?php echo $building_name;?></td>
        </tr>
        <tr><td><input id="D_report_val" value="<?php echo $ci->session->userdata('building_id'); ?>" style="display:none;" /></td></tr>
    </table>
</div>
<!--Daily Report Form-->
<div id="dy_report" title="Daily Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Building: </td>
            <td><?php echo $building_name;?></td>
        </tr>
        <tr>
            <td>Date: </td>
            <td><input id="dy_date" type="text" class="datepicker" /></td>
        </tr>
    </table>
</div>
<!--General Daily Report Form-->
<div id="xxx" title="General Daily Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Date: </td>
            <td><input id="xxx_date" type="text" class="datepicker"/></td>
        </tr>
    </table>
</div>
<!--Landlord Report 2 Form-->
<div id="xl_report2" title="Landlord Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Landlord: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="report_l2" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>From: </td>
            <td><input id="r_start_l2" type="text" class="datepicker"/></td>
        </tr>
        <tr>
            <td>To: </td>
            <td><input id="r_end_l2" type="text" class="datepicker"/></td>
        </tr>
    </table>
</div>
<!--Bounced Cheque-->
<div id="bounced_chq_report" title="Bounced Cheques Report" style="display:none;">
    <table width="100%">
        <tr>
            <td>Landlord: </td>
            <td style="padding-left: 10px;vertical-align: middle;">
                <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="report_bounc_l" tabindex="2">
                    <option value="Select Option">Select Option</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>From: </td>
            <td><input id="bounce_start" type="text" class="datepicker"/></td>
        </tr>
        <tr>
            <td>To: </td>
            <td><input id="bounce_end" type="text" class="datepicker"/></td>
        </tr>
    </table>
</div>
<script>
    $(document).on("click",'#pp',function(){
        window.location = $('#pp1').attr('href');
    });
    $('#nm_hd').html('First Name:');
    $(document).on('change','#regttype',function(){
        var typ = $('#regttype').val();
        if(typ == 'company'){
            $('#nm_hd').html('Company Name:');
            $('#regtlname').val('n/a');
            $('#regtlname').attr("style","text-align:center");
            $('#regtlname').attr("title","Company Name");
            $('#regtlname').attr("disabled",true);
        }else{
            $('#nm_hd').html('First Name:');
            $('#regtlname').attr("style","text-align:left");
            $('#regtlname').attr("title","First Name");
            $('#regtlname').val('');
            $('#regtlname').attr("disabled",false);
        }
    });
</script>

<script>

    var domain = "<?php echo base_url();?>";
    //===========Floor Registration=======================//
    $(document).on('click',"#addFloors",function(){

        $('#floorreg').dialog('open');
        //        $('.selectElement').chosen();
    });

    //===========Room Registration=======================//
    $(document).on('click',"#addtenNotes",function(){


        $('#tenantNotesForm').dialog('open');
        //        $('.selectElement').chosen();
    });
    //===========Notes completion=======================//
    $( "#tenantNotesForm" ).dialog({
        autoOpen: false,
        width: 600,
        modal: true,
        buttons: [
            {
                text: "Add",
                "class": "btnSavex",
                click: function(){
                    var tenant = $('#tenant').val();
                    var tenantNotes = $('#tenantNotes').val();
                    if(tenantNotes!=''&& tenant!=''){
                        $.ajax({
                            type: 'POST',
                            url: domain+"tenants/addnotes",
                            data:{tenantNotes:tenantNotes,tenant:tenant},
                            success : function(response)
                            {
                                if(response.status){
                                    $( "#tenantNotesForm" ).dialog("close");
                                    jAlert("Succesfull added tenant's Notes!","SUCCESS!");
                                    window.location = domain+"tenants";
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
                text: "Cancel",
                "class":"btnCancelx",
                click: function(){
                    $( "#tenantNotesForm" ).dialog( "close" );
                }

            }
        ]

    });

    //===========Floor Registration completion=======================//
    $( "#floorreg" ).dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        buttons: [
            {
                text: "Add",
                "class": "btnSavex",
                click: function(){
                    var floors = $('#flrs').val();
                    if(floors!=''){
                        $.ajax({
                            type: 'POST',
                            url: domain+"floors/add_floors",
                            data:{floors:floors},
                            success : function(response)
                            {
                                if(response.status){
                                    $( "#floorreg" ).dialog("close");
                                    jAlert("Succesfull added More floors!","SUCCESS!");
                                    window.location = domain+"buildings";
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
                text: "Cancel",
                "class":"btnCancelx",
                click: function(){
                    $( "#floorreg" ).dialog( "close" );
                }

            }
        ]

    });

</script>
