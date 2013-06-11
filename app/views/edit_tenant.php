<!-- Content -->

    <div class="content" id="container">

    	<div class="title"><h5>Tenant Details:</h5></div>
        <div class="fix"></div>        
        
        <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>
                <div class="widget first">

                    <div class="head"><h5 class="iList">Edit Tenants Details Here.</h5></div>

                    <div class="rowElem nobg">
                        <label>First Name:</label><div class="formRight"><input type="text" name="f_name" class="validate[required]" value="<?php echo $f_name;?>"/></div>
                        <?php
                            if (form_error('f_name')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('f_name') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Last Name:</label><div class="formRight"><input type="text" name="name_last" class="validate[required]" value="<?php echo $name_last;?>"/></div>
                        <?php
                            if (form_error('name_last')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('name_last') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem nobg">
                    <label>Email:</label><div class="formRight"><input type="text" name="email" class="validate[required]" value="<?php echo $email;?>"/></div>
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
                    <label>Telephone1:</label><div class="formRight"><input type="text" name="telephone1" class="validate[required]" value="<?php echo $phone1;?>"/></div>
                        <?php
                        if (form_error('telephone1')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('telephone1') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>
                <div class="rowElem nobg">
                    <label>Telephone2:</label><div class="formRight"><input type="text" name="telephone2" class="validate[required]" value="<?php echo $phone2;?>"/></div>
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
                    <label>Telephone3:</label><div class="formRight"><input type="text" name="telephone3" class="validate[required]" value="<?php echo $phone3;?>"/></div>
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
                    <label>Contact Person:</label><div class="formRight"><input type="text" name="cp" class="validate[required]" value="<?php echo $c_person;?>"/></div>
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
                    <label>Telephone:</label><div class="formRight"><input type="text" name="telephone" class="validate[required]" value="<?php echo $telephone;?>"/></div>
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
                    <label>Purpose:</label><div class="formRight"><input type="text" name="purpose" class="validate[required]" value="<?php echo $purpose;?>"/></div>
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
                    <label>Starting Date:</label><div class="formRight"><input type="text" name="s_date" class="datepicker" value="<?php echo $s_date;?>"/></div>
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
                    <label>Handover Date:</label><div class="formRight"><input type="text" name="h_date" class="datepicker" value="<?php echo $h_date;?>"/></div>
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
                    <label>Down Payment:</label><div class="formRight"><input type="text" name="d_pay" class="validate[required]" value="<?php echo $d_pay;?>"/></div>
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
                        <label>Status:</label><div class="formRight"><select name="status" value=""><?php echo $statuses?></select></div>
                        <?php
                            if (form_error('status')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('status') . '</p>
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