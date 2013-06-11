<!-- Content -->

    <div class="content" id="container">
        <?php $ci = & get_instance();?>
        <div class="title"><h5><?php echo $ci->session->userdata('building_name');?> > Book Room </h5></div>

        <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

                <div class="widget first">

                    <div class="head"><h5 class="iList">Room Details.</h5></div>

                    <div class="rowElem nobg">
                        <label>Building:</label><div class="formRight"><input type="text" name="building" class="validate[required]" value="<?php echo $building_data[0]['b_name']?>" readonly/></div>
                        <?php
                            if (form_error('building')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('building') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Floor:</label><div class="formRight"><select name="floor"><?php echo $floor?></select></div>
                        <?php
                            if (form_error('floor')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('floor') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Room Name:</label><div class="formRight"><select name="room_n"><?php echo $names?></select></div>
                        <?php
                            if (form_error('room_n')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('room_n') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem nobg">
                        <label>Tenant:</label><div class="formRight"><select name="ten" value="<?php echo $room_data[0]['tenant_id']?>"><?php echo $tenants?></select></div>
                        <?php
                            if (form_error('ten')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('ten') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Monthly Rent:</label><div class="formRight"><input type="text" name="rm_cost" class="validate[required]" value="<?php if(isset($room_data[0]['rm_cost'])) {echo $room_data[0]['rm_cost'];}?>"/></div>
                        <?php
                            if (form_error('rm_cost')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('rm_cost') . '</p>
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

