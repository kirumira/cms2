<!-- Content -->

    <div class="content" id="container">
        <?php $ci = & get_instance();?>
        <div class="title"><h5><?php echo $ci->session->userdata('building_name');?> > Eviction Reason <?php echo $room_data[0]['room_name'] ;?>:</h5></div>

        <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

                <div class="widget first">

                    <div class="head"><h5 class="iList">Enter Eviction Reason.</h5></div>

                    <div class="rowElem nobg">
                        <label>Room Name:</label><div class="formRight"><label><?php echo $room_data[0]['room_name']?></label></div>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Floor:</label><div class="formRight"><label><?php echo $room_data[0]['floor']?></label></div>
                       
                        <div class="fix"></div>
                    </div>
                   
                    <div class="rowElem nobg">
                        <label>Monthly Rent:</label><div class="formRight"><label><?php echo $room_data[0]['rm_cost']?></label></div>
                        
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Reason For Departure:</label><div class="formRight"><input type="text" name="reason" class="validate[required]"/></div>
                        <?php
                            if (form_error('reason')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('reason') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem nobg">
                        <label>Date of Departure:</label>
                        <div class="formRight">
                            <input type="text" name="date" class="datepicker"/>
                        </div>
                        <?php
                            if (form_error('date')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('date') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>


                    <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
                </div>
       </fieldset>
       </form>
    </div>


