/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
function isNumber(evt) 
{
	
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

	 if (charCode != 8 && charCode != 0 && String.fromCharCode(charCode) != '-' && (charCode < 48 || charCode > 57)) 
	 {
       
               return false;
		}
    return true;
}
function isalpha(evt) 
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	
	if(charCode==32)
		{
			return true;
		}
			
	else if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) || charCode==13)
		{
			return false;
		}
}
function validate_file(id)
{

	var file_size = $('#'+id)[0].files[0].size;
	if(file_size>5242880) 
	{
		alert("File Size Should Below 5mb");
		$('#'+id).val("");
	} 
}
function check_agreement_type()
{
	val=$('input[name=agreement_type]:checked').val();
	if(val==3)
	{
		$("#men_agreement").css("display","block");
		$("#other_agreement").attr("required",true);
	}
	else
	{
		$("#men_agreement").css("display","none");
		$("#other_agreement").attr("required",false);
	}
}