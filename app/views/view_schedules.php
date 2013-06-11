
    	<!-- Content -->
    <div class="content">
    	<div class="title"><h5>Calendar</h5></div>
        
        <!-- Statistics -->
        <div class="stats">
        	<ul>
            	<li><a href="#" class="count grey" title=""><?php echo $pending; ?></a><span>today's scheduled payments</span></li>
                
                
                <li><a href="#" class="count grey" title="" id="first"><?php echo $m_pending; ?></a><span>this month's scheduled payments</span></li>
                <li><a href="#" class="count grey" title=""><?php echo $m_due; ?></a><span>this month's pending payments</span></li>
            </ul>
            <div class="fix"></div>
        </div>
                
        <!-- Calendar -->        
        <div class="widget first">
            <div class="head"><h5 class="iDayCalendar">Schedule</h5></div>
            <div id="calendar2"></div>
        </div>
        
    </div>

    <!--Pay Installment Form -->
    <div id="pay_installment_Form" title="Pay Installment" style="display:none;">
        <table style="width: 100%;">

            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span id="p_room">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma"> Tenant Name:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;"><span id="ten_name">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Installment Number:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span id="p_num">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Installment Amount:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span id="p_amount">0</span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Amount Remaining:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span id="p_clear">0</span></td>
            </tr>

        </table>
    </div>

    <div id="pay_installment_Form3" title="Pay Installment" style="display:none;">

    </div>
    <div class="fix"></div>
    <script>
            //===== Calendar =====//
        var domain = "http://localhost/cms/";
	
        var schedules = null;
        var s_id = null;
        var amount = null;
        $.ajax({
            type: "GET",
            dataType: "json",
            url: domain+"schedules/schedule_encode",
            success: function (response){
                if(response.status){
                    schedules = response.data;
                    $('#calendar2').fullCalendar({
                        header: {
                                left: 'prev,next',
                                center: 'title',
                                right: 'month,basicWeek,basicDay'
                        },
                        editable: false,
                        events: schedules,
                        eventClick: function(calEvent) {
                            s_id = calEvent.s_id;
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: domain+"schedules/get_data",
                                data: {s_id:calEvent.s_id},
                                success: function(response){
                                    $('#p_room').html(response.rm_name);
                                    $('#ten_name').html(response.ten_name);
                                    $('#p_num').html(response.in_num);
                                    $('#p_amount').html(response.in_amount);
                                    $('#p_clear').html(response.am_remaining);
                                    $('#pay_installment_Form').dialog("open");
                                    amount = response.in_amount;
                                    
                                }
                            });                        }
                    });
                }
            }
        });

        //===========Installment Payment Dialog================//        

        $( "#pay_installment_Form" ).dialog({
            autoOpen: false,
            width: 300,
            resizable:false,
            modal: true,
            buttons: [
//                {
//                    text: "Pay Installment",
//                    "class": "btnSavex",
//                    click: function(){
//                        $.ajax({
//                            type: "POST",
//                            url: domain+"schedules/pay_installment",
//                            dataType: "json",
//                            data: {s_id:s_id, amount:amount},
//                            success: function(response){
//                                if(response.status){
//                                    $( "#pay_installment_Form" ).dialog("close");
//                                    jAlert("Succesfully paid the installment","SUCCESS!");
//                                    window.location = domain+"schedules/view_schedule";
//                                }else{
//                                    alert('Error Occured. Please try again.');
//                                }
//                            }
//                        });
//                    }
//                },
                {
                    text: "OK",
                    "class":"btnSavex",
                    click: function(){
                        $( "#pay_installment_Form" ).dialog( "close" );
                    }

                }
            ]
        });
    </script>
  