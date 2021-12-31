function checkuncheck()
{
	
	var checkbox = document.getElementById('randompassword');
	var password = document.getElementById('password');
	var jobValue = document.getElementById('txtname');
	if(checkbox.checked==true){
		var myval = "@123";
		password.value=document.getElementById('name').value+myval;
	}
	else{
		            	password.value="";

	}
}

//clientvalidation
	
$(function() {
	$("form[name='client']").validate({
		rules: {
			company_name:'required',
			website :{	
				required: true,
				url: true
			},
			name: "required",
			mobile:
					{	
						required:true,
						digits: true,
						minlength:10,
						maxlength:10
					},
			email:{	
				required:true,
				email: true
			},
			password:{	required: true,
						minlength: 8,
					}
	 	},
	 	messages:
		{
			mobile : "Enter 10 digit Number",
			password : {
				minlength: "Enter Minimum 8 characters or digits"
			}
			
			
		},		
		submitHandler: function(form) {
		form.submit();}
	});
});

//client list
jQuery(document).ready(function() {
	if(controllerName == 'clients' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#clients').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        
	        "aoColumns": [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Clients/client_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Clients found<br/><br/></center>', "sZeroRecords": "<center><br/>No Clients found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					aoData.push( { "name": "clientname", "value": $('#clientname').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#clients').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Clients</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Clients</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});

		$('#btnApplyClients').click(function(){ //button filter event click
	
			var oTable = $('#clients').DataTable();
			oTable.draw();
		});
	}
});



$('#reset-filters').click(function(){ 
	jQuery('#startdate').val('');
	jQuery('#enddate').val('');
	jQuery('#status').val('all');
	jQuery('#clientname').val('');
	$('#resetrmsg').html('');
	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable = $('#clients').DataTable();
	oTable.draw();
});
				
//delete clients
function deleteclients(clientid){
		var url = base_url+"Clients/deleteclient";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this Client?",
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
			   data: {clientid:clientid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#clients').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}
//datepicker	
$(document).ready(function(){
  	$("#startdate").datepicker({
			 dateFormat: 'Y-m-d'
	   });
  	$("#startdate1").datepicker({
			 dateFormat: 'Y-m-d'
	   });
		
		$("#enddate").datepicker({
	  		 dateFormat: 'Y-m-d'
	 	});
		
});

//count amount

function countamount(counter){
    var f1 = $('#quantity'+counter).val();
	var f2 = $('#cost_per_item'+counter).val();
	var mul = eval(f1)*eval(f2);
	$('#amount'+counter).val(mul);
	totalamount();
}		

function counttax(counter){
	var f3 = $('#taxes'+counter).val();
	if(f3 != ''){
		var f = $('#amount'+counter).val();
		var amount=eval(f);
		var fa=(eval(amount)*eval(f3))/100;
		var finalamount =eval(amount)+eval(fa);
		$('#amount'+counter).val(eval(finalamount));
	}
	totalamount();
}

function totalamount(){
	var counter=$('#counter').val();
	var totalAmount=0;
	for(var i=1;i<=counter;i++){
		var finalamount=$('#amount'+i).val();
		totalAmount=eval(totalAmount) + eval(finalamount);
	}
	document.getElementById("total").innerHTML = totalAmount;
	$('#finaltotal').val(eval(totalAmount));
}
	
//repeat Item
$('#item-repeat').click(function(){

	var counter=$('#counter').val();

	counter++;
	$('#counter').val(eval(counter));
	//alert($("#taxes'+counter+'").html());
	$('#dynamic').append('<div id="row'+counter+'"><div class="row"><div class="form-group"><label class="control-label hidden-md hidden-lg">Item</label><div class="input-group"><div class="input-group-addon"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div><input type="text" class="form-control item_name" name="item_name[]">  </div></div><div class="col-md-1"><div class="form-group"><label class="control-label hidden-md hidden-lg">Qty/Hrs</label><input type="number" min="1" class="form-control quantity" name="quantity[]" id="quantity'+counter+'"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label hidden-md hidden-lg">Unit Price</label><input type="text" class="form-control cost_per_item" name="cost_per_item[]" id="cost_per_item'+counter+'" onblur="countamount('+counter+');"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label hidden-md hidden-lg">TaX<a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#project-tax">	<i class="ti-settings text-info"></i></a>	</label><select name="tax[]" class="form-control"  id="taxes'+counter+'" onchange="counttax('+counter+');">'+$("#taxes1").html()+'</select></div></div><div class="col-md-2 border-dark  text-center"><label class="control-label hidden-md hidden-lg">Amount</label><input type="text" name="amount[]" id="amount'+counter+'"></div><div class="col-md-1 text-right visible-md visible-lg"><button type="button" name="remove" id="'+counter+'" class="btn remove-item btn-circle btn-danger remove"><i class="fa fa-remove"></i></button></div></div><div class="row"><div class="form-group"><textarea name="item_Description[]" class="form-control" placeholder="Description" rows="2"></textarea></div></div></div>');
	$("#taxes"+counter).val('');
});

$(document).on('click','.remove',function(){
	var btn_id=$(this).attr("id");
	var amount1=$('#amount'+btn_id).val();

	$("#row"+btn_id+'').remove();
		
	
	 var ftotal1=$('#finaltotal').val();

	var  finaltotal1=(eval(ftotal1))-(eval(amount1));
		document.getElementById("total").innerHTML = finaltotal1;
	$('#finaltotal').val(eval(finaltotal1));
	
});

//estimate table
jQuery(document).ready(function() {
	if(controllerName == 'finance' && (functionName == 'index' || functionName == '')){
		//alert(functionName);
		var user = jQuery('#estimateuserid').val();
		if(user == 0){
			var aoColumns= [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc"  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}
                     ];
		}else{
			var aoColumns= [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc"  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}
                     ];
		}

			
	
		
		var oTable = jQuery('#estimate').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	         aoColumns,
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Finance/estimate_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Estimates found<br/><br/></center>', "sZeroRecords": "<center><br/>No Estimates found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#estimate').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Estimates</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Estimates</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});
		$('#btnApplyEstimates').click(function(){ //button filter event click
			var oTable = $('#estimate').DataTable();
			oTable.draw();
});
	
	}
});

			
//delete estimate
function deleteestimates(estimateid){

		var url = base_url+"Finance/deleteestimate";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this Estimate?",
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
			   data: {estimateid:estimateid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#estimate').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}

//show &hide
 $("#recurring_payment").change(function(){
  if ( this.value == '1')
  {
	$(".showdiv").show();
  }
  else
  {
    $(".showdiv").hide();
  }
});

//invoicelist

jQuery(document).ready(function() {
	if(controllerName == 'finance' && (functionName == 'invoice')){
		var user = jQuery('#invoiceuserid').val();
		//alert(user);
		if(user == 0){
			var aoColumns = [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ ] }, 
			];

		}else{
			var aoColumns = [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ ] }, 
			];

		}
		
		var oTable = jQuery('#invoices').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        aoColumns,
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Finance/invoice_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Invoices found<br/><br/></center>', "sZeroRecords": "<center><br/>No Invoices found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "projectname", "value": $('#projectname').val() } );
					aoData.push( { "name": "clientname", "value": $('#clientname').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#invoices').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Invoices</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Invoices</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});

		$('#btnApplyInvoices').click(function(){ //button filter event click
	var oTable = $('#invoices').DataTable();
	oTable.draw();
	});
	}
});



//delete invoice


function deleteinvoices(invoiceid){
		var url = base_url+"Finance/deleteinvoice";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this Invoice",
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
			   data: {id:invoiceid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#invoices').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}

//expense list
jQuery(document).ready(function() {
	if(controllerName == 'finance' && (functionName == 'expense')){
		var oTable = jQuery('#expenses').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        "aoColumns": [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc"  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
					  { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 

                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Finance/expense_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Expenses found<br/><br/></center>', "sZeroRecords": "<center><br/>No Expenses found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "employee", "value": $('#employee').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#expenses').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Expenses</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Expenses</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});

		$('#btnApplyExpanse').click(function(){ //button filter event click
			var oTable = $('#expenses').DataTable();
			oTable.draw();
		});
	}
});

//delete expenses
function deleteexpenses(expenseid){
		var url = base_url+"Finance/deleteexpense";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this Expense?",
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
			   data: {id:expenseid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#expenses').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}

//expense validation

$(function() {
  $("form[name='expense']").validate({
      rules: {
      employee: "required",
      project: "required",
	  currency:"required",
	  itemname:"required",
		price:"required",
		purchasedfrom:"required",
		purchasedate:"required"
	  
      },
    submitHandler: function(form) {
      form.submit();
    }
  });
});


//client wise project

function getprojectbyclient(projectid){
 	var url = base_url+"Finance/getproject";
        //var projectid = $this.val();
        if(projectid){
            $.ajax({
                type:'POST',
                url:url,
                dataType:'json',
                data:'id='+projectid,
                success:function(html){
                		//console.log(html);
                		//alert("ht");
                	$('select[name="project1"]').html("");
					 $('select[name="project1"]').append(html.projectdata);                }
            }); 
        }
}

//estimate-invoice validation

$("#estimate-invoice").click(function(event) {
	
	var client_name_err  = 0;
	var project_name_err  = 0;
	var currency_name_err  = 0;
	var validtill_err  = 0;

	
	var invoice_err  = 0;
	var invoicedate_err  = 0;
	var duedate_err  = 0;
	var status_err  = 0;

	var item_name_err  = 0;
	var quantity_err  = 0;
	var cost_per_item_err  = 0;
	var tax_err  = 0;
	var amount_err  = 0;
	

	$("select[name^='client']").each(function() {
		var client = $(this).val();
		if(client == ''){
			client_name_err = 1;
		}

});

	$("select[name^='project1']").each(function() {
		var project1 = $(this).val();
		if(project1.trim() == ''){
			project_name_err = 1;
		}
 
});

	$("select[name^='currency']").each(function() {
		var currency = $(this).val();
		if(currency.trim() == ''){
			currency_name_err = 1;
		}
   
  
});
	$("input[name^='valid_till']").each(function() {
		var valid_till = $(this).val();
		if(valid_till.trim() == ''){
			validtill_err = 1;
		}
   
  
});
	

	$("input[name^='invoice_number']").each(function() {
		var invoice_number = $(this).val();
		if(invoice_number == ''){
			invoice_err = 1;
		}
 
});

$("input[name^='invoice_date']").each(function() {
		var invoice_date = $(this).val();
		if(invoice_date == ''){
			invoicedate_err = 1;
		}
 
});

$("input[name^='due_date']").each(function() {
		var due_date = $(this).val();
		if(due_date == ''){
			duedate_err = 1;
		}
 
});

$("select[name^='status']").each(function() {
		var status = $(this).val();
		if(status == ''){
			status_err = 1;
		}
 
});

	

	$("input[name^='item_name']").each(function() {
		var item_name = $(this).val();
		if(item_name.trim() == ''){
			item_name_err = 1;
		}
   
  
});
	$("input[name^='quantity']").each(function() {
		var quantity = $(this).val();
		if(quantity.trim() == ''){
			quantity_err = 1;
		}
   
   
});
	$("input[name^='cost_per_item']").each(function() {
		var cost_per_item = $(this).val();
		if(cost_per_item.trim() == ''){
			cost_per_item_err = 1;
		}
  
    

});
	
	$("input[name^='amount']").each(function() {
	var amount = $(this).val();
	if(amount.trim() == ''){
		amount_err = 1;
	}
   
   
});

	if(client_name_err == 1){
		alert('Please enter Client name');
		return false;
	}
	if(project_name_err == 1){
		alert('Please enter Project');
		return false;
	}
	  if(currency_name_err == 1){
		alert('Please Select Currency');
		return false;
	}

	  if(validtill_err == 1){
		alert('Please enter ValidTill Date');
		return false;
	}

	if(invoice_err == 1){
		alert('Please enter Invoice Number');
		return false;
	}

	if(invoicedate_err == 1){
		alert('Please enter invoice date');
		return false;
	}

	if(duedate_err == 1){
		alert('Please enter Due Date');
		return false;
	}

	if(status_err == 1){
		alert('Please select Status');
		return false;
	}

	  if(item_name_err == 1){
		alert('Please enter item name');
		return false;
	}
	
	 if(quantity_err == 1){
		alert('Please enter quantity');
		return false;
	}

	if(cost_per_item_err == 1){
		alert('Please enter cost per item');
		return false;
	}

	

	 if(amount_err == 1){
		alert('Please enter amount');
		return false;
	}
});	

	


//insert attendance

function insertAttendance(employeeid,counter){
	//alert('fghh');
 	var url = base_url+"Attendance/insertattendance";
 	var attendancedate = $('#atsdate').val();
	var attendance = $('input:radio[name=attendance'+counter+']:checked').val();
	
       	 if(employeeid){
			$.ajax({
				url: url,
				type: "POST",
				data: {
					attendancedate: attendancedate,		
					employee: employeeid,
					attendance: attendance
							
				},
				cache: false,
				success: function(dataResult){
					//alert("fg");
					//$('#suceessmsg').html('');
					$('#suceessmsg'+counter).append('<b>Attendance Saved Successfully</b>');
					$('#suceessmsg'+counter).fadeOut(6000);  
			}	
		});
	}
}



//attendance filter   apply-filter

$("#apply-filter").click(function() {
	var month = $('#month').val();
	var year = $('#year').val();
	var department = $('#dept').val();
	var employee = $('#employee').val();
	//alert(employee);
	$.ajax({
		url : base_url+"Attendance/getfilterdata",
        type : 'POST',
        data : {month: month,year:year,department:department,employee:employee},
        error: function() {
              alert('Something is wrong');
           },
        success: function(data){
			window.location.reload();
        }
	});

	});

//datepicker validation 

$(document).ready(function(){
  	$("#atsdate").datepicker({
			 dateFormat: 'Y-m-d',
			  autoclose: true,
        	orientation: "top",
        	endDate: "today"
	   });
});

//reset filter attendance

$('#reset-filtersAttendance').click(function(){ 
	 

	$.ajax({
		url : base_url+"Attendance/destroydata",
        type : 'POST',
        error: function() {
              alert('Something is wrong');
           },
        success: function(){
			window.location.reload();
        }
	});
});

//for search option in select  

$(document).ready(function(){
	$("#timezone").select2();
   });

$(document).ready(function(){
	$("#date_format").select2();
   });

$(document).ready(function(){
	$("#time_format").select2();
   });

$(document).ready(function(){
	$("#locale").select2();
   });

//
 $(document).ready(function() {
          $('#recaptcha').click(function () { 
           var selected = $(this).val(); alert(selected);  
              if(selected == 'on') {
               $('.key').show();
               $('.secret').show();
            } else {
               $('.key').hide();
               $('.secret').hide();
             }
     });       
});


var h=0;
var m=0;
var s=0;
function to_start(id){

	switch(document.getElementById('btn').value)
	{
	case  'Stop':
	window.clearInterval(tm); // stop the timer 
	document.getElementById('btn').value='Stop';
	var button = 2;
	break;
	case  'Start':
	tm=window.setInterval('disp()',1000);
	$('#btn1').css("display","block");
	$("#data-tasktimer").modal("toggle");
	document.getElementById('btn').value='Stop';
	var button = 1;
	break;
	}

	//add timer Data
	
	memo = $('#memo').val();
	userid = $('#userid').val();


	//btnvalue = document.getElementById('btn').value;
	//alert(btnvalue);
	
	if(button == 1){
	$.ajax({
            url: base_url + 'EmpDashboard/addtimerData',
            type: 'post',
            dataType: 'json',
            data: { 
                project : id,
                memo : memo,
                userid : userid  
              }, 
            success: function (msg) {
              
            }
        });
	}
	else if(button == 2){
		loggedhours = $('#tasktimer').text();
	$.ajax({
            url: base_url + 'EmpDashboard/updateempTask',
            type: 'post',
            dataType: 'json',
            data: { 
                
                userid : userid,
                loggedhours : loggedhours

      
                
              }, 
            success: function (msg) {
              
            }
        });
	}


}


function disp(){
// Format the output by adding 0 if it is single digit //
if(s<10){var s1='0' + s;}
else{var s1=s;}
if(m<10){var m1='0' + m;}
else{var m1=m;}
if(h<10){var h1='0' + h;}
else{var h1=h;}
// Display the output //
str= h1 + ':' + m1 +':' + s1 ;
document.getElementById('tasktimer').innerHTML=str;
// Calculate the stop watch // 
if(s<59){ 
s=s+1;
}else{
s=0;
m=m+1;
if(m==60){
m=0;
h=h+1;
} // end if  m ==60
}// end if else s < 59
// end of calculation for next display

}

//notice table

jQuery(document).ready(function() {
	
	var user = jQuery('#noticeusertype').val();
		if(user == 0){
			var aoColumns = [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                     ];
		}else if(user == 1){
			var aoColumns = [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                     ];
		}
		else if(user == 2){
			var aoColumns = [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                     ];
		}

	if(controllerName == 'noticeboard' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#notices').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        aoColumns,
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"NoticeBoard/notice_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Notices found<br/><br/></center>', "sZeroRecords": "<center><br/>No Notices found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					/*aoData.push( { "name": "status", "value": $('#status').val() } );
					aoData.push( { "name": "clientname", "value": $('#clientname').val() } );*/
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#notices').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Notices</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Notices</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});

		$('#btnApplyNotices').click(function(){ //button filter event click
	
			var oTable = $('#notices').DataTable();
			oTable.draw();
		});
	}
});


//delete notice

function deletenotices(noticeid){
		var url = base_url+"NoticeBoard/deletenotice";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this Notice?",
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
			   data: {noticeid:noticeid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#notices').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}

//notice validation

$(function() {
  $("form[name='notice']").validate({
      rules: {
      heading: "required",
      noticeto: "required"
      },
    submitHandler: function(form) {
      form.submit();
    }
  });
});


//repeat campus 
jQuery(".allow-no").keydown(function (event) {
    if (event.shiftKey) {
        event.preventDefault();
    }

    if (event.keyCode == 46 || event.keyCode == 8) {
    }
    else {
        if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
            }
        }
        else {
            if (event.keyCode < 96 || event.keyCode > 105) {
                event.preventDefault();
            }
        }
    }
});

//payment validation 

$("#pay").click(function(event) {
	var project_name_err  = 0;
	var paidon_name_err = 0;
	var currency_name_err = 0;
	var amount_name_err = 0;	
	$("select[name^='project']").each(function() {
		var project = $(this).val();
		if(project == ''){
			project_name_err = 1;
		}
	});
	$("input[name^='paidon']").each(function() {
		var paidon = $(this).val();
		if(paidon == ''){
			paidon_name_err = 1;
		}
	});
	$("select[name^='currency']").each(function() {
		var currency = $(this).val();
		if(currency == ''){
			currency_name_err = 1;
		}
	});
	$("input[name^='amount']").each(function() {
		var amount = $(this).val();
		if(amount == ''){
			amount_name_err = 1;
		}
	});

	if(project_name_err == 1){
		alert('Please select Project');
		return false;
	}
	if(paidon_name_err == 1){
		alert('Please enter Date');
		return false;
	}
	if(currency_name_err == 1){
		alert('Please enter currency');
		return false;
	}
	if(amount_name_err == 1){
		alert('Please enter amount');
		return false;
	}
});	




//payment

 // var SITEURL = "<?php echo base_url(); ?>";
  $('#pay').on('click', function(e){

  	var project = $('select[name="project"]').val();
  	var paidon = $('input[name="paidon"]').val();
  	var currency = $('select[name="currency"]').val();
  	var amount = $('input[name="amount"]').val();
  	var remark = $('#remark').val();
  	var userid = $('#userid').val();
  	var invoiceid = $('#invoiceid').val();
    var options = {
    "key": "rzp_test_2ztarggUtWrOaN",
    "amount": (amount*100), // 2000 paise = INR 20
    "name": "PMS",
    "description": "Payment",
    
    "handler": function (response){
    	console.log(response);
          $.ajax({
            url: base_url + 'Payment/razorPaySuccess',
            type: 'post',
            dataType: 'json',
            data: { 
                razorpay_payment_id: response.razorpay_payment_id , 
                project : project,
                paidon : paidon,
                currency : currency,
                amount : amount,
                remark :remark,
                userid : userid,
                invoiceid:invoiceid
              }, 
            success: function (msg) {
              window.location.href = base_url + 'Payment/response/'+msg.invoiceid;
            }
        });
      
    },
 
    "theme": {
        "color": "#528FF0"
    }
    
  };
  if(project != '' && paidon != '' && currency != '' && amount != ''){

  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
}
  });

//
function reply(){
	$('#tdesc').css("display","block");
	$('#files').css("display","block");
	$('#reply-toggle').css("display","none");
}

//
function passwordAction(flag){
  if(flag==0){
    jQuery('input[type=password]').attr('type','text');
    jQuery('.pass-view').show();
    jQuery('.pass-hide').hide();
    jQuery('#pass_repeat').attr('type','text');
    jQuery('.pass-change').attr('type','text');
  }else if(flag == 1){
    jQuery('input[type=password]').attr('type','password');
    jQuery('.pass-view').hide();
    jQuery('.pass-hide').show();
    jQuery('#pass_repeat').attr('type','password');
    jQuery('.pass-change').attr('type','password');
  }
}



$('#project').change(function(){
	project = $(this).val();
	//alert(project);
	$.ajax({
		url : base_url+"Payment/assignAmount",
        type : 'POST',
         dataType: 'json',
        data : {project: project},
        error: function() {
              alert('Something is wrong');
           },
        success: function(data){
        	$('input[name="amount"]').val(data.amountdata);
        }
	});

});

$('#reset-filters-invoice').click(function(){ 
			//button filter event click
	jQuery('#status').val('all');
	jQuery('#startdate').val('');
	jQuery('#enddate').val('');
	jQuery('#projectname').val("");
	jQuery('#clientname').val("");
	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#invoices').DataTable();
	oTable1.draw();
});
$('#reset-filters-estimates').click(function(){ 
			//button filter event click
		 jQuery('#startdate').val('');
		 jQuery('#startdate').val('');
	jQuery('#status').val('all');
	// /jQuery('#startdate').reset();
	//jQuery('#enddate').val('');
	
	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#estimate').DataTable();
	oTable1.draw();
});
$('#reset-filters-expense').click(function(){ 
			//button filter event click
	jQuery('#status').val('all');
	jQuery('#startdate').val('');
	jQuery('#enddate').val('');
	jQuery('#employee').val('');
	
	
	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#expenses').DataTable();
	oTable1.draw();
});
$('#reset-filtersAttendance').click(function(){ 
			//button filter event click
	jQuery('#month').val('');
	jQuery('#employee').val('all');
	jQuery('#dept').val('all');
	jQuery('#year').val('');
	
	
	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#attendance-data').DataTable();
	oTable1.draw();
});
$('#reset-filters-notices').click(function(){ 
			//button filter event click
	jQuery('#startdate').val('');
	jQuery('#enddate').val('');
	
	
	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#notices').DataTable();
	oTable1.draw();
});
$('#reset-filters-timelog').click(function(){ 
			//button filter event click
	jQuery('#start_date').val('');
	jQuery('#deadline').val('');
	jQuery('#projectData').val('');
	jQuery('#employeeData').val('');

	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#timelog').DataTable();
	oTable1.draw();
});

$('#reset-filters-leaves').click(function(){ 
			//button filter event click
	jQuery('#startdate').val('');
	jQuery('#enddate').val('');
	jQuery('#empname').val('');
	

	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#leaves').DataTable();
	oTable1.draw();
});
$('#reset-filters-ticket').click(function(){ 
			//button filter event click
	jQuery('#tickettype').val('all');
	jQuery('#channelname').val('all');
	jQuery('#priority').val('all');
		jQuery('#status').val('all');

	jQuery('#agent').val('');

	

	jQuery('#ticket-filters').after('<p id="resetrmsg" style="color:#00B200"><b>Filters Reset Succesfully<b></p>');
	$('#resetrmsg').fadeOut(6000); 
	var oTable1 = $('#tickets').DataTable();
	oTable1.draw();
});

//datepicker filter
   $(function() {
      $('#startdate').datepicker();
    }).on('changeDate', function (selected) {
        $('#enddate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
        var minDate = new Date(selected.date.valueOf());
        $('#enddate').datepicker("update", minDate);
        $('#enddate').datepicker('setStartDate', minDate);
    });

    function changeDate(){

    $("#startdate").datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
    }).on('changeDate', function (selected) {
    	alert('dvg v');
        $('#enddate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
        var minDate = new Date(selected.date.valueOf());
        $('#enddate').datepicker("update", minDate);
        $('#enddate').datepicker('setStartDate', minDate);
    });
    //for end date
    $("#enddate").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#startdate').datepicker('setEndDate', maxDate);
    });
  }

   $(function() {
      $('#startdate1').datepicker(
      	'setStartDate', new Date());
    })