/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
	
	var domain = "http://localhost/spa/";


        //===========Administrators=======================//


        $( "#buildingreg" ).dialog({
		autoOpen: false,
                width: 395,
		modal: true,
		buttons: {
			Register: function() {

			},
                        Close: function(){
                                $( this ).dialog( "close" );
                        }
		}
	});

       
});

