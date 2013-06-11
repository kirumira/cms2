<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5>Add New Expense</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Expenses Details.</h5></div>

                <div class="rowElem nobg">
                    <label>Expense Code:</label><div class="formRight">
                        <input type="text" name="e_code" class="validate[required]"/></div>
                    <?php
                    if (form_error('e_code')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('e_code') . '</p>
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

                

                <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>


</div>