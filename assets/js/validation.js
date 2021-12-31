$(function(){
	$("form[name='leads']").validate({
		rules:{
			company_name : "required",
			client_name : "required",
			client_email:
						{
							required:true,
							email: true
						},
			mobile:
					{	
						required:true,
						digits: true,
						minlength:10,
						maxlength:10
					},
		},	
		messages:
				{
					mobile : "Enter 10 digit Number",
					
				},		
		submitHandler: function(form) {
		form.submit();}
	});
	
	$("form[name='leadtoclient']").validate({
		rules:{
				password : "required",
				website :{
							required: true,
      						url: true
						},
		},			
		submitHandler: function(form) {
		form.submit();}
	});
	
});


function checkuncheck()
{
	
	var checkbox = document.getElementById('randompassword');
	var password = document.getElementById('password');
	if(checkbox.checked == true){
		var myval = "@123";
		password.value = document.getElementById('name').value+myval;
	}
	else{
		password.value = "";
	}
}

	//clientvalidation
	
$(function() {
	$("form[name='client']").validate({
		rules: {
			website :{	required: true,
      					url: true
						},
			name: "required",
			 client_email:
						{
							required:true,
							email: true
						},
			password:
			  {
				required: true,
				minlength: 6
			  
			  }
			 	},
				submitHandler: function(form) {
				form.submit();}
	});
});

function deleteLeadClient(leadId, clientId, type){
	var url = base_url+"leads/deleteleads";
	swal({
	  title: "Are you sure?",
	  text: "You will not be able to recover this imaginary file!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Yes, delete it!",
	  closeOnConfirm: false
	},
function(isConfirm){
	if (isConfirm) {
        $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: {leadId:leadId, clientId:clientId, type:type},
           	dataType: "html",
            success: function (data) {
                swal("Done!", "It was succesfully deleted!", "success");
                var objJson = JSON.parse(data);
 
            var table = $("#leads").dataTable();
 
            oSettings = table.fnSettings();
 
            table.fnClearTable(this);
 
            for (var i=0; i < objJson.detail.length; i++)
            {
                table.oApi._fnAddData(oSettings, objJson.detail[i]);
                //this part always send error DataTables warning: table id=tbDataTable - Requested unknown parameter '0' for row 0.
            }
 
            oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
            table.fnDraw();
                //$("#leads").fnReloadAjax();
                 //$('#leads').DataTable.ajax.reload(null,false); 
                // window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    }
    });
}


	
