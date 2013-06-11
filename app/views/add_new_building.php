<!-- Content -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/knockout-2.1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/knockout/passengers.js"></script>

    <div class="content" id="container">

    	<div class="title"><h5>Add New Building:</h5></div>
        <?php $ci = & get_instance();?>
        <form action="<?php echo base_url(); ?>buildings/add" id="valid" class="mainForm" method="POST">
        <fieldset>

                <div class="widget first">

                    <div class="head"><h5 class="iList">Enter Building Details. <span data-bind="text: seats().length"></span></h5></div>

                    <div class="rowElem nobg">
                        <label>Building Name:</label><div class="formRight"><input type="text" name="name" class="validate[required]" value="<?= set_value('name');?>"/></div>
                            <?php
                            if (form_error('name')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('name') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem nobg">
                        <label>P. O. Box :</label><div class="formRight"><input type="text" name="p_o_box" class="validate[required]" value="<?= set_value('p_o_box');?>"/></div>
                            <?php
                            if (form_error('p_o_box')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('p_o_box') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem nobg">
                        <label>Town :</label><div class="formRight"><input type="text" name="town" class="validate[required]" value="<?= set_value('town');?>"/></div>
                            <?php
                            if (form_error('p_o_box')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('town') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem nobg">
                        <label>District :</label><div class="formRight"><input type="text" name="district" class="validate[required]" value="<?= set_value('district');?>"/></div>
                            <?php
                            if (form_error('district')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('district') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem nobg">
                        <label>Number of Floors :</label><div class="formRight"><input type="text" name="floors" class="validate[required]" value="<?= set_value('floors');?>"/></div>
                            <?php
                            if (form_error('floors')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('floors') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>

                    
                    <div class="rowElem nobg">
                        <label>Manager :</label><div class="formRight"><select name="manager" value="<?=set_value('manager_id');?>"><?=$managers?></select></div>
                            <?php
                            if (form_error('manager')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('manager') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Landlord :</label><div class="formRight"><select name="landlord" value="<?=set_value('landlord_id');?>"><?=$landlords?></select></div>
                            <?php
                            if (form_error('landlord')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('landlord') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem nobg">
                        <label>Type :</label><div class="formRight"><select name="type" class="validate[required]" value="<?=set_value('type');?>"><option value="BUILDING">COMMERCIAL BUILDING</option><option value="RESIDENTIAL">RESIDENTIAL</option><option value="WAREHOUSE">WAREHOUSE</option></select></div>
                            <?php
                            if (form_error('type')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('type') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem nobg">
                        <label>Currency :</label><div class="formRight"><select name="currency" class="validate[required]" value="<?=set_value('currency');?>"><option value="UGX">UGX</option><option value="USD">USD</option></select></div>
                            <?php
                            if (form_error('currency')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('currency') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Plot Number :</label><div class="formRight"><input type="text" name="plot" class="validate[required]" value="<?= set_value('plot');?>"/></div>
                            <?php
                            if (form_error('plot')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('plot') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Property Number :</label><div class="formRight"><input type="text" name="property_no" class="validate[required]" value="<?= set_value('property_no');?>"/></div>
                            <?php
                            if (form_error('property_no')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('property_no') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Block Number :</label><div class="formRight"><input type="text" name="block" class="validate[required]" value="<?= set_value('block');?>"/></div>
                            <?php
                            if (form_error('block')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('block') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Street Name :</label><div class="formRight"><input type="text" name="street" class="validate[required]" value="<?= set_value('street');?>"/></div>
                            <?php
                            if (form_error('street')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('street') . '</p>
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