<?php $dp=0;?>
<script src="<?php echo base_url(); ?>js/knockout.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.numeric.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.monthpicker.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mtz.monthpicker.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.printElement.js"></script>
<style>
    @media screen { #receipt { display: none; } }
    @media screen { #receipt2 { display: none; } }
</style>
<?php $ci = & get_instance();?>
<div class="content" style="padding-bottom: 180px;">
        <div class="title"><h5>Payments Panel > <?php echo $ci->session->userdata('building_name');?></h5></div>
        <div class="widget first">
            <div class="head">
                    <h5 class="iMoney">Payments Panel > (<?php echo $ci->session->userdata('currency');?>)
                        rate( $1 = Ugx. <?php echo $rate;?>)
                    </h5>
                </div>
            
            <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
                <thead>
                    <tr>
                        <td width="auto"><b>Particulars</b></td>
                        <td width="auto"><b>Month</b></td>
                        <!--<td width="auto"><b>Year</b></td>-->
                        <td width="auto"><b>Amount</b></td>
                        <td width="auto"><b>Mode</b></td>
                        <td width="auto"><b>Details</b></td>
                        <td width="auto" ><b>VAT</b></td>
                        <td width="auto"><b>Action</b></td>
                    </tr>
                </thead>
                <tbody data-bind="foreach: payments">
                <tr>
                    <td style="text-align: center;"><select class="selectEl" style="" data-bind="options: $root.particulars, value: particular, optionsText: 'pName'"></select></td>
                    <!--<td style="text-align: center;"><span data-bind="visible:pcheck"><select width="100%" class="selectEl" style="" data-bind="options: $root.months, value: month, optionsText: 'mtName'"></span></select></td>-->
                    <td style="text-align: center;"><span data-bind="visible:pcheck"><input readonly="readonly" class="month_pick" style="width: 100px;text-align:center;height:22px;padding-top:5px;" data-bind="value: month"/></span></td>
                    <!--<td style="text-align: center;"><div data-bind="visible: pcheck"><select style="width:100px;" class="selectEl" data-bind="options: $root.years, value: year, optionsText: 'nyear'"></select></div></td>-->
                    <td>
                        <table style="width:100%;"><tr>
                            <td><b style="float:left" data-bind="text:xcurr"></b></td>
                            <td><input style="padding-left: 5px;padding-top: 5px;vertical-align: middle;height:22px; font-family: Arial,Helvetica,sans-serif;font-size: 100%;" class="positivenumeric" data-bind="value: amount,valueUpdate: 'afterkeydown'" /></td>                            
                        </tr></table>
                    </td>
                    <td style="text-align: center;"><select class="selectEl" style="width:100px;" data-bind="options: $root.modes, value: mode, optionsText: 'mName'"></select></td>
                    <td style="text-align: center;"><input style="padding-left: 5px;padding-top: 5px;vertical-align: middle;height:22px; font-family: Arial,Helvetica,sans-serif;font-size: 100%;" data-bind="value: xnum, visible: xcheck, valueUpdate: 'afterkeydown'" /></td>
                    <td style="text-align: center;"><div data-bind="visible:vat_viz"><p><input type="checkbox" data-bind="checked: doVat" /></p><span data-bind="text: disp_vat1" ></span></div></td>
                    <td style="text-align: center;">
                        <a class="btn14 topDir mr5" original-title="Add" title="" href="#" data-bind="click: $root.addPayment, visible: $root.enabler">
                            <img alt="" src="<?php echo base_url();?>images/icons/color/plus.png"/>
                        </a>
                        <a class="btn14 topDir mr5" original-title="Remove" title="" href="#" data-bind="click: $root.removePayment, visible: $root.payments().length>1">
                            <img alt="" src="<?php echo base_url();?>images/icons/color/cross.png"/>
                        </a>
                    </td>
                </tr>    
            </tbody>
            </table>
           <div class="head">
                <div class="head">
                <table style="float:left;">
                    <tr style="height:25px;">
                        <td style="vertical-align:middle;">
                            <h5 class="iMoney"><b style="float:left;">Total Payment:  <?php echo $ci->session->userdata('currency');?>. <span style="font-size:15px;" data-bind="text: $root.totalPayDisplay"></span></b><span data-bind="visible: isConv" style="float:right;vertical-align:middle;margin-left:30px;"><span><input style="margin-top:5px;float:left;" type="checkbox" data-bind="checked: doConvert" /></span><b style="float:left">UGX</b></span></h5>
                        </td> 
                        <td style="vertical-align:middle;">
                            <h5 data-bind="visible:umeme_viz"><b style="float:left;">UMEME Total:  UGX.</b><b style="float:left" data-bind="text: $root.umeme_Total"></b></h5> 
                        </td>                                               
                    </tr>
                </table>
            </div> 
               <!--<h5 class="iMoney"><b style="float:left;">Total Payment:  <?php echo $ci->session->userdata('currency');?>. <span style="font-size:15px;" data-bind="text: $root.totalPayDisplay"></span></b><span data-bind="visible: isConv" style="float:right;vertical-align:middle;margin-left:30px;"><span><input style="margin-top:5px;float:left;" type="checkbox" data-bind="checked: doConvert" /></span><b style="float:left">UGX</b></span></h5>
<!--               <span style="margin-left:40%; font-size:16px;">Room Name:</span>-->
               
<!--               <span style="margin-top: 3px; float:right;margin-right:5%;">Date: <input class="datepicker" style="float:right;vertical-align: middle;height:26px; font-family: Arial,Helvetica,sans-serif;font-size: 100%;" id="ddd" /></span>-->
               
<!--                 <img style=" display:none;margin-top:-5px;" id ="purchaseLoader" class="p12" alt="" src="images/loaders/loader3.gif" />-->
           </div>
            <div class="head">
                <table style="float:right;">
                    <tr style="height:25px;">
                        <td style="vertical-align:middle;">
                            <span style="margin-top: 3px; float:right;margin-right:5%;">Date: </span> 
                        </td> 
                        <td style="vertical-align:middle;">
                            <span style="margin-top: 3px; float:right;margin-right:5%;"><input class="mydatepicker" style="text-align:center;width:80px;float:right;vertical-align: middle;height:26px; font-family: Arial,Helvetica,sans-serif;font-size: 100%;" id="ddd" /></span>
                        </td>
                        <td style="vertical-align:middle;">
                            <span style="vertical-align:top;margin-top: 3px;padding-left:5px;padding-right:3px;">Tenant / Room Name:</span>
                        </td>
                        <td style="vertical-align:middle;">
                             <select style="  width:160px;  display: inline-table;" class="selectEl"name="select2" id="rm" data-bind="options:$root.rooms, optionsValue:'Id',value: $root.room, optionsText:'rName', optionsCaption: 'Select Tenant / Room'" > </select>  
                        </td>  
                        <td style="vertical-aliTenant /gn:m 
                            <span style="vertical-align:top;margin-top: 3px;">Received From:</span>
                        </td>
                        <td style="vertical-align:middle;">
                            <input style="text-align:center;float:right;vertical-align: middle;height:26px; font-family: Arial,Helvetica,sans-serif;font-size: 100%;" id="rfrm" />
                        </td>
                        <td style="vertical-align:middle;">
                            <a style="width:95px;height:30px;margin-right:5%;margin-left:15px;float:right; margin-top: 3px; border-radius: 17px 17px 17px 17px;"  class="btnIconLeft mr10" title="" href="#" data-bind="click: $root.Pay">
                                <img class="icon" alt="" src="<?php echo base_url();?>images/icons/dark/cart.png"/>
                                <span>Finish</span>
                            </a>
                        </td> 
                         
                           
                           
                    </tr>
                </table>
            </div> 
        </div>  
    <div class="fix"></div>
    <div class="widgets">
        <div class="left">
            <div class="widget" id="ten_info" style="display: none">
                <div class="head"><h5 class="iTenant">Tenant Summary</h5></div>

                <div class="supTicket nobg">
                    <div class="issueType">
                            <span class="issueInfo"><a href="#" title="">Tenant Name:</a></span>
                        <span class="issueNum"><a href="#" title="" id="t_name">Silas Kaggwa</a></span>
                        <div class="fix"></div>
                    </div>

                    <div class="issueSummary">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top;"><a href="#" title="" class="floatleft"><img id ="t_pic" width="80px" height="80px" src="<?php echo base_url();?>images/user.png" alt="" /></a></td>
                                <td style="vertical-align:middle;">
<!--                                    Current Balance:<br>-->
                                    Tenant status:<br>
                                    Phone number:<br>
                                    Email:<br>
                                </td>
                                <td style="vertical-align:middle;"> 
                                    <strong class="green" style="float:right;" id="t_st"></strong><br>                                   
                                    <strong class="green" style="float:right;" id="t_4n"></strong><br>
                                    <a href="#" title="" style="float:right;" id="t_em"></a></li>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="widget" id="rm_info" style="display: none">
                <div class="head"><h5 class="iRoom">Room Information</h5><div class="num"><a href="#" class="redNum">T</a></div></div>
                <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">

                    <tr>
                        <td>Monthly Rent</td>
                        <td align="center" id="mr"></td>                       
                    </tr>
                    <tr>
                        <td>Room Status</td>
                        <td align="center" id="rs"></td>                       
                    </tr>
                    <tr>
                        <td>Current Balance</td>
                        <td align="center" id="cb"></td>                       
                    </tr>
                    <tr id="rdp">
                        <td>Down Payment</td>
                        <td align="center" id ="dp"></td>                       
                    </tr>
                    <tr>
                        <td>UMEME balance (UGX)</td>
                        <td align="center" width='150px' id="um"></td>
                    </tr>                            
                    
                </table>
                <div id="sched"></div>
                <div id="penalty"></div>
            </div>
        </div>
    </div>
    <!--Pay Installment Form -->
    <div id="pay_installment_Form" title="Pay Installment" style="display:none;">
        <table style="width: 90%;">

            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" align="center"><span id="p_room">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma"> Tenant Name:</span></td>
                <td style="vertical-align: middle;" align="center"><span id="ten_name">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Installment Number:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" align="center"><span id="p_num">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Installment Amount:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><input type="text" class="positivenumeric" id="p_amount" /></td>
            </tr>

        </table>
    </div>
    <!--Penalty Payment Form -->
    <div id="pen_dialog" title="Pay Cheque Penalty" style="display:none;">
        <table style="width: 90%;">

            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" align="center"><span id="pen_room">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma"> Tenant Name:</span></td>
                <td style="vertical-align: middle;" align="center"><span id="pen_ten_name">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma"> Cheque:</span></td>
                <td style="vertical-align: middle;" align="center"><span id="pen_cheque">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma"> Cheque Amount:</span></td>
                <td style="vertical-align: middle;" align="center"><span id="pen_chq_amount">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Penalty Amount:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><input type="text" class="positivenumeric" id="penalty_amount" /></td>
            </tr>

        </table>
    </div>
    <div class="fix"></div>
</div>
<div id="succ_pay" title="Payment Success" style="display:none;text-align:center;">
    <span style="text-align:center;width:100%">
        <b>Payment done successfully!</b>
    </span>
</div>
<script>
    $('#succ_pay').dialog({
        autoOpen: false,
        width: 340,
        resizable: false,
        modal: true,
        buttons:[
            {
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    $('#succ_pay').dialog('close');
                    window.location = "<?php echo base_url();?>payments";
                }
            }
        ]
    });
</script>
<!--<div class="widget first" id="receipt">
    <div class="receipt_header">
        <h2><?php echo $ci->session->userdata('building_name');?></br>Kampala, Uganda</br>Tel: +256702604010</h2>
        <h2>RECEIPT</h2>
        <table width="100%">
            <tr>
                <td id="receiptdate"></td>
                <td id="rct_tn"></td>
            </tr>
        </table>
    </div>
    <table cellspacing="0" cellpadding="0" width="100%" class="">
        <thead>
                <tr>
                <th width="15%" style="border-left:1px double black;" class="b_right">PARTICULARS</th>
                <th width="10%" class="b_right">MONTH</th>
                <th width="10%" class="b_right">YEAR</th>                
                <th width="10%" class="b_right">MODE</th>                
                <th width="20" class="b_right">CH/SLIP</th>
                <th width="10" class="b_right">VAT</th>
                <th width="25%" class="b_right">AMOUNT</th>
            </tr>
        </thead>
        <tbody id="receipt_tbody"></tbody>
    </table>
    <div class="receipt_header">
        <i style="float:left;"><b>Handled by: </b><?php echo $ci->session->userdata("name_first")." ".$ci->session->userdata("name_last"); ?></i><h3 style="float:right;margin-right:10%;">Thank you!</h3>
    </div>

</div>-->
<div class="widget first" id="receipt2">
    <div class="receipt_header2">
<!--        <h2>CRANE MANAGEMENT SERVICES</h2>-->
        <h2><?php echo $ci->session->userdata('building_name');?></br>P.O.BOX <?php echo $p_o_box;?><br><?php echo $b_district;?>, Uganda</br>Tel: +256702604010</h2>
        <h2>TAX INVOICE/RECEIPT</h2><h2 align="right">TIN: 1000023523</h2>
        <table width="100%">
            <tr>
                <td id="receiptdate2"></td>
                <td id="rct_tn2"></td>
            </tr>
        </table>
    </div>
    <table cellspacing="0" cellpadding="0" width="100%" class="">
        <thead>
            <tr>
                <th width="10%" style="border-left:1px double black;" class="b_right">PARTICULARS</th>
                <th width="10%" class="b_right">MONTH</th>            
                <th width="10%" class="b_right">MODE</th>                
                <th width="10" class="b_right">CH/SLIP</th>
                <th width="10" class="b_right">BEFORE VAT(UGX)</th>
                <th width="10" class="b_right">VAT(UGX)</th>
                <th width="15%" class="b_right" colspan="2">TOTAL AMOUNT(UGX)</th>
<!--                <th width="10%" class="b_right">RATE(UGX)</th>
                <th width="15%" class="b_right">TOTAL(USD)</th>-->
            </tr>
        </thead>
        <tbody id="receipt_tbody2"></tbody>
    </table>
    <div class="receipt_header2">
        <i style="float:left;"><b>Handled by: </b><?php echo $ci->session->userdata("name_first")." ".$ci->session->userdata("name_last"); ?></i><h3 style="float:right;margin-right:10%;">Thank you!</h3>
    </div>
</div>    
<div class="widget first" id="receipt">
    <div class="receipt_header">
        <h2><?php echo $ci->session->userdata('building_name');?></br>P.O.BOX <?php echo $p_o_box;?><br><?php echo $b_district;?>, Uganda</br>Tel: +256702604010</h2>
        
        <h2>TAX INVOICE/RECEIPT</h2><h2 align="right">TIN: 1000023523</h2>
        <table width="100%">
            <tr>
                <td id="receiptdate"></td>
                <td id="rct_tn"></td>
            </tr>
        </table>
    </div>
    <table cellspacing="0" cellpadding="0" width="100%" class="">
        <thead>
            <tr>
                <th width="10%" style="border-left:1px double black;" class="b_right">PARTICULARS</th>
                <th width="10%" class="b_right">MONTH</th>
                <!--<th width="10%" class="b_right">YEAR</th>-->                
                <th width="10%" class="b_right">MODE</th>                
                <th width="15" class="b_right">CH/SLIP</th>
                <th width="15" class="b_right">BEFORE VAT</th>
                <th width="10" class="b_right">VAT</th>
                <th width="20%" class="b_right">TOTAL</th>
            </tr>
        </thead>
        <tbody id="receipt_tbody"></tbody>
    </table>
    <div class="receipt_header">
        <i style="float:left;"><b>Handled by: </b><?php echo $ci->session->userdata("name_first")." ".$ci->session->userdata("name_last"); ?></i><h3 style="float:right;margin-right:10%;">Thank you!</h3>
    </div>

</div>



<script>

    $(document).ready(function(){
        $('.checker').jqTransform({imgPath:'../images/forms'});
    });
    //0714903119
    $("#ddd").val($.datepicker.formatDate('dd M yy', new Date()));
    $('.mydatepicker').datepicker({
        defaultDate: +0,
        dateFormat: 'dd M yy' 
    });
    $.ajax({
        type:"GET",
        url: "<?php echo base_url();?>bills/payment_settings",
        success : function(response)
        {
            //console.log(response.particulars);
            ko.applyBindings(new PaymentViewModel(response.particulars,response.rooms));
            $('.selectEl').chosen();
            $('.positivenumeric').numeric();
            $('.positivenumeric').keyup(function(){
                var n = $(this).val().replace(/,/g, '');
                $(this).val(add_commas(n));
            });
            $('.month_pick').monthpicker({
                dateFormat: 'MM-yy'
            });
        },
        dataType:'json'
     });
    var conv = null;
    var current_curr = "<?php echo $ci->session->userdata('currency');?>";
    var rate = parseFloat(<?php echo $rate;?>);
    if(isNaN(rate)){
        rate = 1;
    }
    
    function RowModel(particulars, mode){
    
        var self = this;

        self.particular = ko.observable(particulars);
        self.amount = ko.observable();
        self.ugx_eqv = ko.observable();
        self.dollar_eqv = ko.observable();
        self.ugx_vat_eqv = ko.observable();
        self.dollar_vat_eqv = ko.observable();
        self.mode = ko.observable(mode);
        self.xnum = ko.observable();
        self.month = ko.observable("<?php echo date('F-Y');?>");
        self.year = ko.observable();
        self.doVat = ko.observable(false);
        self.disp_vat = ko.observable(0);
        self.vat_viz = ko.computed(function(){
            var b_type = "<?php echo $b_type;?>";
            var ret = null;
            if(b_type == 'RESIDENTIAL'){
                ret = false;
            }else{
                ret = true;
            }
            return ret;
        });

        self.amount.subscribe(function(){
            var vat = (18/118);
            if(self.doVat()){
                var ret = null;
                var am2 = self.amount();
                if(am2!=undefined){                
                    ret = ''+am2.replace(/,/g, '');
                }else{
                    ret = 0;
                }
                self.disp_vat((vat*parseInt(ret)).toFixed(2));
            }else{
                self.disp_vat(0);
            }
            
        });
        self.disp_vat1 = ko.computed(function(){
            return add_commas(self.disp_vat());
        });
        self.amount.subscribe(function(){
            if(conv){
                if(self.amount()!=undefined && self.amount()!=null && self.amount()!=''){
                    self.ugx_eqv(''+self.amount().replace(/,/g,''));
                    self.dollar_eqv(parseFloat(''+self.amount().replace(/,/g,'') / rate).toFixed(2));
                }else{
                    self.ugx_eqv(0);
                    self.dollar_eqv(0);
                } 
            }else{
                if(self.amount()!=undefined && self.amount()!=null && self.amount()!=''){
                    self.ugx_eqv(parseFloat(''+self.amount().replace(/,/g,'')*rate).toFixed(0));
                    self.dollar_eqv(''+self.amount().replace(/,/g,''));
                }else{
                    self.ugx_eqv(0);
                    self.dollar_eqv(0);
                } 
            }
        });
        self.doVat.subscribe(function(){
            var vat = (18/118);
            if(self.doVat()){
                var ret = null;
                var am2 = self.amount();
                if(am2!=undefined){                
                    ret = ''+am2.replace(/,/g, '');
                }else{
                    ret = 0;
                }
                self.disp_vat((vat*parseInt(ret)).toFixed(2));
            }else{
                self.disp_vat(0);
            }
            
        });
        
        self.amount.subscribe(function(){
            
            nStr = ''+self.amount().replace(/,/g, '');
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            var ret = x1 + x2;
            self.amount(ret);
        });
        
        self.xcheck = ko.computed(function(){ 
            if(self.mode().mName != "Cash"){
                return true;
            }else{            
                return false;
            }
        });
        self.pcheck = ko.computed(function(){
            var xpn = self.particular().pName;
            if(xpn == "Rent" || xpn == "UMEME"){
                //$('.selectEl').chosen();
                return true;
            }else{
                return false;
            }
        });
        self.real_amount = ko.computed(function(){
            var ret = null;
            var am2 = self.amount();
            if(am2!=undefined){                
                ret = ''+am2.replace(/,/g, '');
            }else{
                ret = 0;
            }
            
            return ret-self.disp_vat();
        });
        self.xcurr = ko.observable(current_curr);
        self.particular.subscribe(function(){
            if(self.particular().pName == 'UMEME'){
                self.xcurr('UGX');
            }else{
                self.xcurr(current_curr)
            }
        });

    }
    function PaymentViewModel(p,r) {
        var self = this;
        self.particulars = p;
        self.modes = [
            {mName: "Cash"},
            {mName: "Cheque"},
            {mName: "Bank slip"},
            {mName: "TT"}
        ];
        self.months = [
            {mtName: "January"},
            {mtName: "February"},
            {mtName: "March"},
            {mtName: "April"},
            {mtName: "May"},
            {mtName: "June"},
            {mtName: "July"},
            {mtName: "August"},
            {mtName: "September"},
            {mtName: "October"},
            {mtName: "November"},
            {mtName: "December"},
        ];
        var year = parseInt(new Date().getFullYear())-1;
        self.years = [
            {nyear: year+1},
            {nyear: year},            
            {nyear: year+2},
            {nyear: year+3},
        ];
//        for(var q;q<5;q++){
//            self.years.push({nyear: year++});
//        }
//            
//        
        self.rooms = r;
        self.payments = ko.observableArray([new RowModel(self.particulars[0],self.modes[0])]);
        self.addPayment = function() {
            self.payments.push(new RowModel(self.particulars[0],self.modes[0]));
            $('.selectEl').chosen();
            $('.positivenumeric').numeric();
//            $('.positivenumeric').keyup(function(){
//                var n = $(this).val().replace(/,/g, '');
//                $(this).val(add_commas(n));
//            });
            $('.month_pick').monthpicker({
                dateFormat: 'MM-yy'
            });
        }
        self.removePayment = function(task){
            self.payments.remove(task);
        }
        self.enabler = ko.computed(function(){
            var status;
            for(var j=0; j<self.payments().length; j++){
                if(self.payments()[j].amount() == null || self.payments()[j].amount()==''){
                    status = false;
                    break;
                }else if(self.payments()[j].mode()["mName"]!="Cash" && self.payments()[j].xnum()==null){
                    status = false;
                    break;
                }else{                    
                    //console.log(self.payments()[j].mode()["mName"]+">>"+self.payments()[j].xnum());
                    
                    status = true;
                }
            }
            
            return status;
        });
        self.room = ko.observable();
        self.room.subscribe(function(){
            $('#ten_info').slideUp('slow');
            $('#rm_info').slideUp('slow');
            if(self.room()){
                $.ajax({
                    type: "POST",
                    url:  "<?php echo base_url();?>bills/room_tenant_info",
                    data: {rm_id:self.room()},
                    dataType: 'json',
                    success: function(response){
                        $('#t_pic').attr('src', response.room.pic_path);
                        $('#t_em').html(response.room.email);
                        var tname;
                        if(response.room.f_name == null && response.room.l_name == null){
                            tname = "No Tenant";
                        }else{
                            tname = response.room.f_name+" "+response.room.l_name;
                        }
                        $('#rct_tn').html('Tenant: <b>'+tname+'</b><br>Room: <b>'+response.room.room_name+'</br>');
                        $('#rct_tn2').html('Tenant: <b>'+tname+'</b><br>Room: <b>'+response.room.room_name+'</br>');
                        //$('#rc_rm').html(response.room.room_name);
                        $('#t_4n').html(response.room.telephone);
                        $('#t_name').html(tname);
                        $('#mr').html(add_commas(response.room.rm_cost));
                        var state = '';
                        if(response.room.rm_state=='CLOSED'){state=' ('+response.room.rm_state+')';}
                        
                        if(response.room.rm_status!='PENDING'){
                        $('#rs').html(response.room.rm_status+state);
                            $('#rdp').hide();
                        }else{
                            $('#rdp').show();
                            $('#dp').html(add_commas(response.room.d_payment));
                            $('#rs').html('BOOKED');
                        }  
                        $('#t_st').html(response.room.status);                      
                        $('#cb').html(add_commas(response.room.debit-response.room.credit));
                        $('#um').html(add_commas(response.room.debit_umeme-response.room.credit_umeme));
                        $('#sched').html(response.schedule);
                        $('#penalty').html(response.penalty);
                        $('#ten_info').slideDown('slow');
                        $('#rm_info').slideDown('slow');
                    }
                });
            }           
            
        });
        self.TotalPay = ko.computed(function(){
            var tot = 0;
            for(var i=0;i<self.payments().length;i++){                
               var added = self.payments()[i].amount();//0701307737               
               if(added==null){
                   added = 0;
               }else{
                   added = added.replace(/,/g, '');
               }
               if(self.payments()[i].particular().pName!='UMEME'){
                    tot+= parseInt(added);
               }               
            }
            return tot;
        });
        self.umeme_Total1 = ko.computed(function(){
            var utot = 0;
            for(var i=0;i<self.payments().length;i++){                
               var added = self.payments()[i].amount();//0701307737            
               if(added==null){
                   added = 0;
               }else{
                   added = added.replace(/,/g, '');
               }
               if(self.payments()[i].particular().pName=='UMEME'){
                    utot+= parseInt(added);
                    self.payments()[i].xcurr('UGX');
               }               
            }
            return utot;
        });
        self.umeme_Total = ko.computed(function(){
            return add_commas(self.umeme_Total1());
        });
        self.umeme_viz = ko.computed(function(){
            if(self.umeme_Total1()>0){
                return true;
            }else{
                return false;
            }
        });
        self.doConvert = ko.observable(false);
        self.isConv = ko.computed(function(){
            var curr = "<?php echo $ci->session->userdata('currency');?>";
            if(curr=='USD'){
                return true;
            }else{
                return false;
            }
        });
        self.doConvert.subscribe(function(){
            if(self.doConvert()){
                conv = true;
                 
                for(var i = 0;i<self.payments().length;i++){
                    self.payments()[i].xcurr('UGX.');
                    current_curr = 'UGX.';
                    if(self.payments()[i].amount()!=undefined && self.payments()[i].amount()!=null && self.payments()[i].amount()!=''){
                        self.payments()[i].ugx_eqv(''+self.payments()[i].amount().replace(/,/g,''));
                        self.payments()[i].dollar_eqv(parseFloat(''+self.payments()[i].amount().replace(/,/g,'') / rate).toFixed(2));
                    }else{
                        self.payments()[i].ugx_eqv(0);
                        self.payments()[i].dollar_eqv(0);
                    }                    
                }
            }else{
                
                conv = false;
                for(var i = 0;i<self.payments().length;i++){
                    self.payments()[i].xcurr('USD.');
                    current_curr = 'USD.'
                    if(self.payments()[i].amount()!=undefined && self.payments()[i].amount()!=null && self.payments()[i].amount()!=''){
                        self.payments()[i].ugx_eqv(parseFloat(''+self.payments()[i].amount().replace(/,/g,'')*rate).toFixed(0));
                        self.payments()[i].dollar_eqv(''+self.payments()[i].amount().replace(/,/g,''));
                    }else{
                        self.payments()[i].ugx_eqv(0);
                        self.payments()[i].dollar_eqv(0);
                    }                    
                }
            }
            
        });
        self.totalPayDisplay = ko.computed(function(){
            //var rate = 2650;
            var cur = "<?php echo $this->session->userdata('currency');?>";            
            var disp = self.TotalPay();
            var ret;
            if(isNaN(disp)){
                disp = 0;
            }
            if(cur == 'USD'){
                //rate = 1;
                //console.log('>>'+self.doConvert);
                if(self.doConvert()){
                    ret = add_commas((disp/rate).toFixed(2))+' (Ugx. '+add_commas((disp).toFixed(0))+')';
                }else{
                    ret = add_commas(disp)+' (Ugx. '+add_commas((disp*rate).toFixed(0))+')';
                }
                
            }else{
                ret = add_commas(disp)+' ($ '+add_commas((disp/rate).toFixed(2))+')';
            }
            return ret;
        });
        
        
        
        self.Pay = function(){
            var rfrm = $('#rfrm').val();
            var rm = $('#rm').val();
            var t_4n = $('#t_4n').html();
            var t_name = $('#rfrm').val();
            var rm = $('#rm').val();
            var t_4n = $('#t_4n').html();
            var ddd = $('#ddd').val();
            var converted = false;
            if(self.isConv() && self.doConvert()){
                converted = true;
            }
            
            //var 
            if(self.enabler() && rfrm!='' && rm!='' && ddd!=''){
                var pay = ko.toJS(self.payments());
                var umeme = self.umeme_Total1();
                var ftot = self.TotalPay();   
                console.log(umeme);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>bills/make_payment",
                    data: {rate:rate,converted:converted,payments:pay,from:rfrm,total:ftot,room_id:rm,pdate:ddd},
                    dataType: 'json',
                    success: function(response){

                        if(response.status){
                          $.ajax({
                                type: 'POST',
                                //url: "http://121.241.242.114:8080/bulksms/bulksms?username=cd1-cranemgtsys&password=cms123&type=0&dlr=1&&destination="++"&source=CMS&message=tenant%20message",
                                url: "http://121.241.242.114:8080/bulksms/bulksms?",
                                data:{
                                    username:"cd1-cranemgtsys",
                                    password:"cms123",
                                    type:"0",
                                    dlr:"1", 
                                    //destination:telephone.replace(/-/g,'')+",256702604010", 
                                    destination:t_4n.replace(/-/g,''), 
                                    source:"CMS", 
                                    message:"You have successfully Paid for Rent. Thanks"},
             
                                success : function()
                                {
                                        jAlert("Message sent");
                                       // $("#mhhh").dialog( "close" );
                                    
                                }
                             });
                            jAlert("Payment made successfully","SUCCESS!");
                            //window.location = "<?php echo base_url();?>payments"
                            self.payments([new RowModel(self.particulars[0],self.modes[0])]);
                            $("#ddd").val($.datepicker.formatDate('dd M yy', new Date()));
                            $('.month_pick').monthpicker({
                                dateFormat: 'MM-yy'
                            });                            
                            $('.selectEl').chosen();
                            $('.positivenumeric').numeric();
                            $('.positivenumeric').keyup(function(){
                                var n = $(this).val().replace(/,/g, '');
                                $(this).val(add_commas(n));
                            });
                            $('#rfrm').val('');
                            $('#rm').val('');
                            $('#t_4n').val('');
                            self.room('');                            
                            $('.selectEl').trigger("liszt:updated");
                            $('#ten_info').slideUp('slow');
                            $('#rm_info').slideUp('slow');
                            
                            if(self.isConv() && self.doConvert()){
                                //==============================Receipt=======================================
                                var date = new Date();
                                var curr = null;
                                if("<?php echo $ci->session->userdata('currency')?>"=='USD'){
                                    curr = 'shillings';
                                }else{
                                    curr = 'shillings';
                                }
                                var current= date.getDate()+"/"+(parseInt(date.getMonth(),10)+1)+"/"+date.getFullYear()+"   TIME: "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                                $('#receiptdate2').html('DATE: '+current+'<br>Receipt: <b>'+response.rec_no+'</b>');
                                $('#receipt_tbody2').empty();
                                var total= '<tr style="border-top:1px;">'+
                                                '<td style="border-left:1px double black;text-align:left;border-top: 1px double black;">'+
                                                    'The sum of '+curr+': '+                                                                       
                                                '</td>'+
                                                '<td colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;">'+
                                                    '<b>'+toWords(ftot)+'</b>'+
                                                '</td>'+
                                                '<td colspan="1" rowspan="1" style="border-top: 1px double black;text-align:right;">Total: <b>UGX.</b> </td>'+
                                                '<td rowspan="1" class="b_right" style="text-align:right;padding-right:6%;border-top: 1px double black;"><b>'+add_commas(ftot)+'</b></td>'+
                                                '<td class="b_right" style="text-align:right;padding-right:6%;border-top: 1px double black;"> @'+add_commas(rate)+'</td>'+
                                                '<td rowspan="1" style="border-top: 1px double black;text-align:right;">Total: <b>USD.</b> </td>'+
                                                '<td rowspan="1" class="b_right" style="text-align:right;padding-right:6%;border-top: 1px double black;"><b>'+add_commas((ftot/rate).toFixed(2))+'</b></td>'+
                                                
                                            '</tr>';
                                   var info= '<tr>'+
                                                '<td rowspan="1" colspan="1" style="border-left:1px double black;text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+  
                                                    'Received from:'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+
                                                    '<b>'+rfrm+'</b>'+
                                                '</td>'+
                                                '<td colspan="5" class="b_right" style="text-align:center;border-top: 1px double black;border-bottom: 1px double black;">'+
                                                    'Rent Balance: USD '+add_commas(response.curr_bal)+'<br>'+
                                                    //'UMEM Balance: UGX '+add_commas(response.um_bal)+
                                                '</td>'+                                                
                                            '</tr>';
                                var x_month = '-';//&nbsp;
                                //var x_year = '-';
                                var num = '-';
                                $.each(pay, function(index,value){
                                    if(value.pcheck){
                                        x_month = value.month;
                                        //x_year = value.year.nyear;
                                    }
                                    if(value.xnum != undefined && value.xnum !=''){
                                        num = value.xnum;
                                    }
                                    var row='<tr>'+
                                                '<td style="border-left:1px double black;" class="b_right">'+value.particular.pName+'</td>'+
                                                '<td class="b_right">'+x_month+'</td>'+                          
                                                '<td class="b_right">'+value.mode.mName+'</td>'+
                                                '<td class="b_right">'+num+'</td>'+
                                                '<td class="b_right" style="text-align:right;padding-right:6%;">'+add_commas(parseFloat(value.real_amount).toFixed(0))+'</td>'+
                                                '<td class="b_right">'+add_commas(parseFloat(value.disp_vat).toFixed(0))+'</td>'+         
                                                '<td colspan="2" class="b_right" style="text-align:right;padding-right:6%;">'+add_commas(value.amount)+'</td>'+
                                                //'<td class="b_right" style="text-align:right;padding-right:6%;">'+add_commas(rate)+'</td>'+
                                                //'<td class="b_right" style="text-align:right;padding-right:6%;">'+add_commas(value.dollar_eqv)+'</td>'+
                                            '</tr>';
                                        $('#receipt_tbody2').prepend($(row).fadeIn('slow'));
                                });
                                $('#receipt_tbody2').append(total);
                                $('#receipt_tbody2').append($(info).fadeIn('fast',function(){
                                    $('#receipt2').printElement({
                                        leaveOpen: true,
                                        printMode: 'popup',
                                        overrideElementCSS: ["<?php echo base_url();?>css/billing_receipt.css"],
                                        pageTitle: 'Crane Management Services'
                                    });                                    
                                    //$('#succ_pay').dialog('open');
                                }));
                    //==============================================================================
                            }else{
                                    //==============================Receipt=======================================
                                
                                var date = new Date();
                                var curr = null;
                                if("<?php echo $ci->session->userdata('currency')?>"=='USD'){
                                    curr = 'dollars';
                                }else{
                                    curr = 'shillings';
                                }
                                var current= date.getDate()+"/"+(parseInt(date.getMonth(),10)+1)+"/"+date.getFullYear()+"   TIME: "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                                $('#receiptdate').html('DATE: '+current+'<br>Receipt: <b>'+response.rec_no+'</b>');
                                $('#receipt_tbody').empty();
                                if(umeme>0){
                                    var total1= '<tr style="border-right:1px double black;">'+
                                                '<td style="border-left:1px double black;text-align:left;border-top: 1px double black;">'+
                                                    'The sum of '+curr+': '+                                                                       
                                                '</td>'+
                                                '<td colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;">'+
                                                    '<b>'+toWords(ftot)+'</b><br>'+
                                                '</td>'+
                                                '<td colspan="2" style="border-top: 1px double black;text-align:right;">Total: <b>'+"<?php echo $ci->session->userdata('currency')?>"+'.</b> </td>'+
                                                '<td style="border-right:1px double black;text-align:right;padding-right:6%;border-top: 1px double black;"><b>'+add_commas(ftot)+'</b></td>'+
                                            '</tr>';
                                    var total= '<tr style="border-right:1px double black;">'+
                                                '<td style="border-left:1px double black;text-align:left;border-top: 1px double black;">'+
                                                    'The sum of '+curr+': '+                                                                       
                                                '</td>'+
                                                '<td colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;">'+
                                                    '<b>'+toWords(ftot)+'</b><br>'+
                                                '</td>'+
                                                '<td colspan="1" style="border-top: 1px double black;">UMEME Total:</td>'+
                                                '<td colspan="1" style="border-right:1px double black;padding-right:6%;border-top: 1px double black;">UGX. '+add_commas(umeme)+'</td>'+
                                                '<td colspan="1" style="border-top: 1px double black;">Others Total: </td>'+
                                                '<td colspan="1" style="border-right:1px double black;text-align:right;padding-right:6%;border-top: 1px double black;"><b>'+"<?php echo $ci->session->userdata('currency')?>"+'. </b><b>'+add_commas(ftot)+'</b></td>'+
                                            '</tr>';
                                    var info1 = '<tr>'+
                                                '<td rowspan="1" style="border-left:1px double black;text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+  
                                                    'Received from:'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+
                                                    '<b>'+rfrm+'</b><br>'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="2" style="text-align:right;border-top: 1px double black;border-bottom: 1px double black;">Balance: <b>'+"<?php echo $ci->session->userdata('currency')?>"+'.</b> </td>'+ 
                                                '<td rowspan="1" style="border-right:1px double black;text-align:right;padding-right:6%;border-top: 1px double black;border-bottom: 1px double black;"><b>'+add_commas(response.curr_bal)+'</b></td>'+
                                            '</tr>';
                                    var info = '<tr>'+
                                                '<td rowspan="1" style="border-left:1px double black;text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+  
                                                    'Received from:'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+
                                                    '<b>'+rfrm+'</b><br>'+
                                                '</td>'+
                                                '<td colspan="1" style="border-top: 1px double black;border-bottom: 1px double black;">UMEME Balance:</td>'+
                                                '<td colspan="1" style="border-right:1px double black;padding-right:6%;border-top: 1px double black;border-bottom: 1px double black;">UGX. '+add_commas((response.um_bal).toFixed(0))+'</td>'+
                                                '<td rowspan="1" colspan="1" style="border-top: 1px double black;border-bottom: 1px double black;">Other Balance: </td>'+ 
                                                '<td rowspan="1" colspan="1" style="border-right:1px double black;border-top: 1px double black;border-bottom: 1px double black;"><b><?php echo $ci->session->userdata('currency')?>. </b><b>'+add_commas(response.curr_bal)+'</b></td>'+
                                            '</tr>';
                                }else{
                                    var total1= '<tr style="border-right:1px double black;">'+
                                                '<td style="border-left:1px double black;text-align:left;border-top: 1px double black;">'+
                                                    'The sum of '+curr+': '+                                                                       
                                                '</td>'+
                                                '<td colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;">'+
                                                    '<b>'+toWords(ftot)+'</b><br>'+
                                                '</td>'+
                                                '<td colspan="2" style="border-top: 1px double black;text-align:right;">Total: <b>'+"<?php echo $ci->session->userdata('currency')?>"+'.</b> </td>'+
                                                '<td style="border-right:1px double black;text-align:right;padding-right:6%;border-top: 1px double black;"><b>'+add_commas(ftot)+'</b></td>'+
                                            '</tr>';
                                    var total= '<tr style="border-right:1px double black;">'+
                                                '<td style="border-left:1px double black;text-align:left;border-top: 1px double black;">'+
                                                    'The sum of '+curr+': '+                                                                       
                                                '</td>'+
                                                '<td colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;">'+
                                                    '<b>'+toWords(ftot)+'</b><br>'+
                                                '</td>'+
                                                '<td colspan="3" style="border-top: 1px double black;text-align:right;">Total: <b>'+"<?php echo $ci->session->userdata('currency')?>"+'.</b> </td>'+
                                                '<td colspan="1" style="border-right:1px double black;text-align:right;padding-right:6%;border-top: 1px double black;"><b>'+add_commas(ftot)+'</b></td>'+
                                            '</tr>';
                                    var info1 = '<tr>'+
                                                '<td rowspan="1" style="border-left:1px double black;text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+  
                                                    'Received from:'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+
                                                    '<b>'+rfrm+'</b><br>'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="2" style="text-align:right;border-top: 1px double black;border-bottom: 1px double black;">Balance: <b>'+"<?php echo $ci->session->userdata('currency')?>"+'.</b> </td>'+ 
                                                '<td rowspan="1" style="border-right:1px double black;text-align:right;padding-right:6%;border-top: 1px double black;border-bottom: 1px double black;"><b>'+add_commas(response.curr_bal)+'</b></td>'+
                                            '</tr>';
                                    var info = '<tr>'+
                                                '<td rowspan="1" style="border-left:1px double black;text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+  
                                                    'Received from:'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="2" class="b_right" style="text-align:left;border-top: 1px double black;border-bottom: 1px double black;">'+
                                                    '<b>'+rfrm+'</b><br>'+
                                                '</td>'+
                                                '<td rowspan="1" colspan="3" style="text-align:right;border-top: 1px double black;border-bottom: 1px double black;">Balance: <b>'+"<?php echo $ci->session->userdata('currency')?>"+'.</b> </td>'+ 
                                                '<td rowspan="1" colspan="1" style="border-right:1px double black;text-align:right;padding-right:6%;border-top: 1px double black;border-bottom: 1px double black;"><b>'+add_commas(response.curr_bal)+'</b></td>'+
                                            '</tr>';
                                }
                                

                                var x_month = '-';//&nbsp;
                                //var x_year = '-';
                                var num = '-';
                                $.each(pay, function(index,value){
                                    if(value.pcheck){
                                        x_month = value.month;
                                        //x_year = value.year.nyear;
                                    }
                                    if(value.xnum != undefined && value.xnum !=''){
                                        //console.log('>>>'+value.xnum);
                                        num = value.xnum;
                                    }
                                    var row1='<tr>'+
                                                '<td style="border-left:1px double black;" class="b_right">'+value.particular.pName+'</td>'+
                                                '<td class="b_right">'+x_month+'</td>'+
                                                //'<td class="b_right">'+x_year+'</td>'+                            
                                                '<td class="b_right">'+value.mode.mName+'</td>'+
                                                '<td class="b_right">'+num+'</td>'+
                                                '<td class="b_right">'+add_commas(value.disp_vat)+'</td>'+
                                                '<td class="b_right" style="text-align:right;padding-right:6%;">'+add_commas(value.real_amount)+'</td>'+
                                            '</tr>';
                                    var row='<tr>'+
                                                '<td style="border-left:1px double black;" class="b_right">'+value.particular.pName+'</td>'+
                                                '<td class="b_right">'+x_month+'</td>'+
                                                //'<td class="b_right">'+x_year+'</td>'+                            
                                                '<td class="b_right">'+value.mode.mName+'</td>'+                                                
                                                '<td class="b_right">'+num+'</td>'+
                                                '<td class="b_right" style="text-align:right;padding-right:6%;">'+add_commas(value.real_amount)+'</td>'+
                                                
                                                '<td class="b_right">'+add_commas(parseFloat(value.disp_vat).toFixed(2))+'</td>'+
                                                '<td class="b_right">'+value.amount+'</td>'+
                                            '</tr>';
                                        $('#receipt_tbody').prepend($(row).fadeIn('slow'));
                                });
                                $('#receipt_tbody').append(total);
                                $('#receipt_tbody').append($(info).fadeIn('fast',function(){
                                    $('#receipt').printElement({
                                        leaveOpen: true,
                                        printMode: 'popup',
                                        overrideElementCSS: ["<?php echo base_url();?>css/billing_receipt.css"],
                                        pageTitle: 'Crane Management Services LTD'
                                    });
                                    //$('#succ_pay').dialog('open');
                                }));
                    //==============================================================================
                            }
                        }else{
                            jAlert(response.msg,'ERROR');
                        }
                    }
                });
            }else{
                jAlert('Fill all required fields!','ERROR');
            }            
        }
    }
    function add_commas(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    
//    $(document).on('click','#penalty', function() {
//        var p_id = $('#xy').val();
//        $.ajax({
//            type: "POST",
//            dataType: "json",
//            url: domain+"cheque/get_cheque_data",
//            data: {p_id:p_id},
//            success: function(response){
//                $('#p_room').html(response.rm_name);
//                $('#ten_name').html(response.ten_name);
//                $('#p_num').html(response.in_num);
//                //$('#p_amount').html(response.in_amount);
//                $('#pay_installment_Form').dialog("open");
//
//            }
//        });
//    })
    //===========Click on pay penalty=================================//
    $(document).on('click', '#schx', function() {
        var pen_id = $('#xy').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: domain+"cheque/cheque_data",
            data: {pen_id:pen_id},
            success: function(response) {
                $('#pen_room').html(response.data.room_name);
                $('#pen_ten_name').html(response.data.f_name+" "+response.data.l_name);
                $('#pen_cheque').html(response.data.cheque);
                $('#pen_chq_amount').html(add_commas(response.data.amount));
                $('#pen_dialog').dialog('open');
            }
        });
    });

    //============Penalty payment Popup===================================//
    $('#pen_dialog').dialog({
            autoOpen: false,
            width: 400,
            modal: true,
            buttons: [
                {
                    text: "Pay Penalty",
                    "class": "btnSavex",
                    click: function(){
                        var amount2 = $('#penalty_amount').val();
                        var s_id2 = $('#xy').val();
                        $.ajax({
                            type: "POST",
                            url: domain+"cheque/pay_penalty",
                            dataType: "json",
                            data: {penalty_id:s_id2, amount:amount2},
                            success: function(response){
                                if(response.status){
                                    $( "#pen_dialog" ).dialog("close");
                                    jAlert("Succesfully paid ","SUCCESS!");
                                    window.location = domain+"payments";
                                }else{
                                    alert('Error Occured. Please try again.');
                                }
                            }
                        });
                    }
                },
                {
                    text: "Cancel",
                    "class":"btnCancelx",
                    click: function(){
                        $( "#pen_dialog" ).dialog( "close" );
                    }

                }
            ]
        });


    //===========Click on schedule payment=================//
    $(document).on('click',"#sch",function(){
        var s_id = $('#x').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: domain+"schedules/get_data",
            data: {s_id:s_id},
            success: function(response){
                $('#p_room').html(response.rm_name);
                $('#ten_name').html(response.ten_name);
                $('#p_num').html(response.in_num);
                //$('#p_amount').html(response.in_amount);
                $('#pay_installment_Form').dialog("open");

            }
        });
    });

    //===========Installment Payment Dialog================//

        $( "#pay_installment_Form" ).dialog({
            autoOpen: false,
            width: 400,
            modal: true,
            buttons: [
                {
                    text: "Pay Installment",
                    "class": "btnSavex",
                    click: function(){
                        var amount = $('#p_amount').val();
                        var s_id = $('#x').val();
                        $.ajax({
                            type: "POST",
                            url: domain+"schedules/pay_installment",
                            dataType: "json",
                            data: {s_id:s_id, amount:amount},
                            success: function(response){
                                if(response.status){
                                    $( "#pay_installment_Form" ).dialog("close");
                                    jAlert("Succesfully paid the installment","SUCCESS!");
                                    window.location = domain+"payments";
                                }else{
                                    alert('Error Occured. Please try again.');
                                }
                            }
                        });
                    }
                },
                {
                    text: "Cancel",
                    "class":"btnCancelx",
                    click: function(){
                        $( "#pay_installment_Form" ).dialog( "close" );
                    }

                }
            ]
        });
    
</script>