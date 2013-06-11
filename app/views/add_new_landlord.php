<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5>Add New Landlord:</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Landlord Details.</h5></div>

                <div class="rowElem nobg">
                    <label>First Name:</label><div class="formRight"><input type="text" name="f_name" class="validate[required]" value="<?php echo set_value('f_name'); ?>"/></div>
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
                    <label>Last Name:</label><div class="formRight"><input type="text" name="l_name" class="validate[required]" value="<?php echo set_value('l_name'); ?>"/></div>
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
                    <label>Email:</label><div class="formRight"><input type="text" name="email" class="validate[required]" value="<?php echo set_value('email'); ?>"/></div>
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
                    <label>Telephone:</label><div class="formRight"><input type="text" name="telephone" class="validate[required]" value="<?php echo set_value('telephone'); ?>"/></div>
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
                    <label>Group :</label><div class="formRight"><select name="group" value="<?= set_value('group'); ?>"><option>None</option><option>New</option><?= $groups ?></select></div>


                    <?php
                    if (form_error('group')) {
                        echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('group') . '</p>
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