<!-- Content -->

    <div class="content" id="container">

    	<div class="title"><h5>Expense Details:</h5></div>
        <div class="fix"></div>
        <a href="<?php echo base_url(); ?>expenses/delete/<?php echo $e_code; ?>" title="">
            <input type="button" value="Delete Expense" class="greenBtn right" />
        </a>

        <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>
                <div class="widget first">

                    <div class="head"><h5 class="iList">Edit Expense Details.</h5></div>

                    <div class="rowElem nobg">
                        <label>Expense Code:</label><div class="formRight"><input type="text" name="e_code" class="validate[required]" value="<?php echo $e_code;?>"/></div>
                        <?php
                            if (form_error('e_code')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('e_code') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Expense Description:</label><div class="formRight"><input type="text" name="description" class="validate[required]" value="<?php echo $description;?>"/></div>
                        <?php
                            if (form_error('description')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('description') . '</p>
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
