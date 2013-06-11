
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Crane Property Management System</title>
        <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>js/jquery-1.4.4.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/spinner/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/spinner/ui.spinner.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>js/fileManager/elfinder.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.image.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.link.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.table.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/flot/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/flot/jquery.flot.resize.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/flot/excanvas.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables/colResizable.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/forms.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/autogrowtextarea.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/autotab.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.validationEngine-en.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.dualListBox.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.filestyle.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/colorPicker/colorpicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/plupload.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/plupload.html5.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/plupload.html4.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/jquery.plupload.queue.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/ui/progress.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/ui/jquery.jgrowl.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/ui/jquery.tipsy.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/ui/jquery.alerts.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jBreadCrumb.1.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/cal.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.smartWizard.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.collapsible.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ToTop.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.listnav.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sourcerer.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.timeentry.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/custom.js"></script>
        <style type="text/css">
            .imag{
                border-radius: 5px 5px 5px 5px;
                margin-left: 42px;
                webkit-box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
            }
        </style>
    </head>
    <body>

        <!-- Top navigation bar -->

        <div id="topNav">
            <div class="fixed">
                <div class="wrapper">
                    <div class="backTo"><a href="#" title=""><img src="<?php echo base_url(); ?>images/icons/topnav/mainWebsite.png" alt="" /><span>CMS</span></a></div>
                    <div class="userNav">
                        <ul>
                            <li><a href="#" title=""><img src="<?php echo base_url(); ?>images/icons/topnav/register.png" alt="" /><span>Register</span></a></li>
                            <li><a href="#" title=""><img src="<?php echo base_url(); ?>images/icons/topnav/help.png" alt="" /><span>Help</span></a></li>
                        </ul>
                    </div>
                    <div class="fix"></div>
                </div>
            </div>
        </div>

        <!-- Login form area -->

       <div class="loginWrapper">
            <div class="loginLogo"><img class="imag" src="<?php echo base_url(); ?>images/CMSlogo_103.png" alt="" /></div>
            <div style="color:red; font-size:11px; margin-left:33px;" ><?php echo form_error('username'); ?></div>
            <div style="color:red; font-size:11px; margin-left:33px;"><?php echo form_error('password'); ?></div>

            <div class="loginPanel">        
                <div class="head"><h5 id="heading" class="iUser">Login</h5></div>        
                <form action="<?php echo base_url(); ?>login" id="valid" class="mainForm" method="POST">
                    <fieldset>
                        <div class="loginRow noborder">
                            <label for="req1">Username:</label>
                            <div class="loginInput"><input type="text" name="username" value="<?php echo set_value('username'); ?>" class="validate[required]" id="req1" /></div>
                            <div class="fix"></div>
                        </div>               
                        <div class="loginRow noborder">
                            <label for="req2">Password:</label>
                            <div class="loginInput"><input type="password" name="password" value="" class="validate[required]" id="req2" /></div>
                            <div class="fix"></div>
                        </div>               
                        <div class="loginRow noborder" id="loger">
                            <div class="rememberMe"><input type="checkbox" id="check2" name="chbox" /><label>Remember me</label></div>
                            <input type="submit" value="Log me in" class="basicBtn submitForm" />
                            <div class="fix"></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- Footer -->
        <div id="footer">
            <div class="wrapper">
                <span>&copy; Copyright 2012. All rights reserved. <a href="#" title=""></a></span>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#loger').jqTransform({imgPath:'../images/forms'});
            });
        </script>
    </body>
</html>