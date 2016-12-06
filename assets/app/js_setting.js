/*!
*
* @category Setting module
* @author Vicky Nitinegoro 
* 
*/
$(document).ready(function() {


	function load_timezone(selector) {
	    $.getJSON("../../assets/includes/json/timezone.json", function(data) 
	    {
		    $.each(data, function(i,item) {
		    	var selected = ($(selector).data('selected') == item['value'] ) ? 'selected' : '';
		        country = '<option value="'+item['value']+'" '+selected+'>'+item['text']+'</option>';
		        $(selector).append(country);
		    });
		});
	}

	load_timezone('#timezone');

	var customCSS = CodeMirror.fromTextArea(
		$("#custom-css")[0],{
			mode:"css",
			lineNumbers:true,
			theme:"3024-day"
		}
	);

	var customJS = CodeMirror.fromTextArea(
		$("#custom-js")[0],{
			mode:"js",
			lineNumbers:true,
			theme:"3024-day"
		}
	);
});