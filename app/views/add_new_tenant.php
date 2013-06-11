<!-- Content -->
<script type="text/javascript">
    // Capturing the change event of the Transformed Select Box using the modified method of capturing the value change event.
$("#rm_id1 div.jqTransformSelectOpen ul li a").click(function(){
    var value= $("#rm_id1 div.jqTransformSelectWrapper span").text()
    alert("Value Selected = "+value);
    return false; //prevent default browser action
});
</script>
<div class="content" id="container">
    <?php    $ci = & get_instance();    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name') ?> > Adding A New Tenant:</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Tenants Details.</h5></div>

                <div class="rowElem nobg">
                        <label>First Name:</label><div class="formRight"><input type="text" name="f_name" class="validate[required]"/></div>
                        <?php
                        if (form_error('f_name')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('f_name') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                        <div class="fix"></div>                       
                    
                </div>
                
                <div class="rowElem nobg">
                    <label >Last Name:</label><div class="formRight"><input type="text" name="l_name" class="validate[required]"/></div>
                        <?php
                        if (form_error('l_name')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('l_name') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                    <label>Email:</label><div class="formRight"><input type="text" name="email" class="validate[required]"/></div>
                        <?php
                        if (form_error('email')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('email') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>
                <div class="rowElem nobg">
                    <label>Telephone:</label><div class="formRight"><input type="text" name="telephone" class="validate[required]"/></div>
                        <?php
                        if (form_error('telephone')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('telephone') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>
                
                <div class="rowElem nobg">
                    <label>Telephone2:</label><div class="formRight"><input type="text" name="telephone2" class="validate[required]"/></div>
                        <?php
                        if (form_error('telephone2')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('telephone2') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    
                    
                    <div class="fix"></div>
                </div>
                
                <div class="rowElem nobg">
                    <label>Telephone3:</label><div class="formRight"><input type="text" name="telephone3" class="validate[required]"/></div>
                        <?php
                        if (form_error('telephone3')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('telephone3') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                    <label>Contact Person:</label><div class="formRight"><input type="text" name="cp" class="validate[required]"/></div>
                        <?php
                        if (form_error('cp')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('cp') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                    <label>Telephone1:</label><div class="formRight"><input type="text" name="c_phone" class="validate[required]"/></div>
                        <?php
                        if (form_error('c_phone')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('c_phone') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>
                <div class="rowElem nobg">
                     <label>Room :</label>
                     <div class="select-menus" id="rm_id1">
                         <div class="formRight"><select id="rm_id" name="room" value="<?=set_value('room');?>"><?php echo $rooms?></select></div>
                     </div>
                        <?php
                            if (form_error('room')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('room') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                </div>



                <div class="rowElem nobg">
                    <label>Purpose:</label><div class="formRight"><input type="text" name="purpose" class="validate[required]"/></div>
                        <?php
                        if (form_error('purpose')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('purpose') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>
                
                <div class="rowElem nobg">
                    <label>Starting Date:</label><div class="formRight"><input type="text" name="s_date" class="datepicker"/></div>
                        <?php
                        if (form_error('s_date')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('s_date') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                    <label>Handover Date:</label><div class="formRight"><input type="text" name="h_date" class="datepicker"/></div>
                        <?php
                        if (form_error('h_date')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('h_date') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                    <label>Down Payment:</label><div class="formRight"><input type="text" name="d_pay" class="validate[required]"/></div>
                        <?php
                        if (form_error('d_pay')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('d_pay') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                    <label>Security Deposit:</label><div class="formRight"><input type="text" name="deposit" class="validate[required]"/></div>
                        <?php
                        if (form_error('deposit')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('d_pay') . '</p>
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
