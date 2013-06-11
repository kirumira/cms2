<!-- Content -->

<div class="content" id="container">
    <?php $ci = & get_instance();?>

    <div class="title"><h5>Enter Payments:</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Record Cash Here.</h5></div>


                <div class="rowElem nobg"><label>Date:</label>
                    <div class="formRight"><input type="text" class="datepicker" name="date"/></div>
                    <?php
                    if (form_error('date')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('date') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                
                <div class="rowElem nobg"><label>Room :</label>
                    <div class="formRight"><select name="room_n" value="<?= set_value('room_n'); ?>"><?php echo $x; ?></select></div>
                    <?php
                    if (form_error('room_n')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('room_n') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>

                <div class="rowElem nobg"><label>Particulars:</label>
                    <div class="formRight"><select name="part" class="validate[required]" value="<?= set_value('part'); ?>"/><?php echo $particulars;?></select></div>
                    <?php
                    if (form_error('part')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('part') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                <div class="rowElem nobg"><label>Amount:</label>
                    <div class="formRight"><input type="text" name="amount" class="validate[required]"/></div>
                    <?php
                    if (form_error('amount')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('amount') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                    
                    <div class="rowElem nobg"><label>Mode Of Payment:</label>
                    <div class="formRight"><select name="mode">
                            <option value="cash">Cash</option><option value="cheque">Cheque</option><option value="bank">Bank Slip</option>
                        </select></div>
                    <?php
                    if (form_error('mode')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('mode') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                <div class="rowElem nobg"><label>Currency:</label>
                    <div class="formRight"><input type="input" name="c_id" class="validate[required]" value="<?php echo $ci->session->userdata('currency');?>" readonly /></div>
                   
                     <?php
                    if (form_error('c_id')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('c_id') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                
                <div class="rowElem nobg"><label>Received From:</label>
                    <div class="formRight"><input type="text" name="p_name" class="validate[required]"/></div>
                    <?php
                    if (form_error('p_name')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('p_name') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                    <div class="rowElem nobg"><label>Cheque No:</label>
                    <div class="formRight"><input type="text" name="cheque" class="validate[required]"/></div>
                    <?php
                    if (form_error('cheque')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('cheque') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                    <div class="rowElem nobg"><label>Bank Slip No:</label>
                    <div class="formRight"><input type="text" name="slip" class="validate[required]"/></div>
                    <?php
                    if (form_error('slip')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('slip') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                <div class="rowElem"><input type="submit" value="Save" class="basicBtn submitForm" />

                    <div class="fix"></div></div>
            </div>
        </fieldset>
    </form>


</div>