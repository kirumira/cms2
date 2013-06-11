<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5><?php $ci = & get_instance(); echo $ci->session->userdata('building_name'); ?> > <?php
                
                if(($floor==1)||($floor==21)||($floor==31)||($floor==41)){
                    echo $floor."st";
                }elseif(($floor==2)||($floor==22)||($floor==32)||($floor==42)){
                    echo $floor."nd";
                }elseif(($floor==3)||($floor==23)||($floor==33)||($floor==43)){
                    echo $floor."rd";
                }else{
                    echo $floor."th";
                }
?> Floor > Add New Room</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Room Details.</h5></div>

                <div class="rowElem nobg">
                    <label>Room Number:</label><div class="formRight">
                        <input type="text" name="room_n" class="validate[required]"/></div>
                    <?php
                    if (form_error('room_n')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('room_n') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div>
                </div>
                <div class="rowElem nobg">
                    <label>Room Name:</label><div class="formRight">
                        <input type="text" name="room_name" class="validate[required]"/></div>
                    <?php
                    if (form_error('room_name')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('room_name') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div>
                </div>
                <div class="rowElem nobg">
                    <label>Description:</label><div class="formRight">
                        <input type="text" name="description" class="validate[required]"/></div>
                    <?php
                    if (form_error('description')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('description') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                    <label>Montly Rent:</label><div class="formRight">
                        <input type="text" name="m_cost" class="validate[required]"/></div>

                    <?php
                    if (form_error('m_cost')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('m_cost') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>


</div>