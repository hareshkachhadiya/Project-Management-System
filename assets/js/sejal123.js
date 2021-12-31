jQuery(document).ready(function() {
	if(controllerName == 'project' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#project').DataTable({
			    
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
	        "sAjaxSource": base_url+"Project/projectlist",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				aoData.push( { "name": "status1", "value": $('#project_status').val() } );
				aoData.push( { "name": "clientname1", "value": $('#clientname').val() } );
				aoData.push( { "name": "categoryname1", "value": $('#categoryname').val() } );
            
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#project').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Projects</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Projects</small>)';
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
	}
	else if(controllerName == 'project' && functionName == 'projecttemplate')
	{
			
			var oTable = jQuery('#template').DataTable({    
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
                     // { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      //{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      //{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Project/templatelist",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#template').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leads</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leads</small>)';
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
	}
	else if(controllerName == 'project' && functionName == 'viewarchiev')
		{
			
			var oTable = jQuery('#archievdata').DataTable({    
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
	        "sAjaxSource": base_url+"Project/archivelist",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				aoData.push( { "name": "status2", "value": $('#project_status').val() } );
				aoData.push( { "name": "clientname2", "value": $('#clientname').val() } );
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#archievdata').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Archive</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Archive</small>)';
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
	}
	
	
});
	//PROJECT FILTER
	$('#clientname').change(function(){ //button filter event click
				var oTable = $('#project').DataTable();
					oTable.draw();
			});
			$('#categoryname').change(function(){ //button filter event click
				var oTable = $('#project').DataTable();
					oTable.draw();
			});
			$('#project_status').change(function(){ //button filter event click
				var oTable = $('#project').DataTable();
					oTable.draw();
			});
        
		
		
	//ARCHIEVE FILTER
	$('#clientname').change(function(){ 
				var oTable = $('#archievdata').DataTable();
					oTable.draw();
			});

			$('#project_status').change(function(){ 
				var oTable = $('#archievdata').DataTable();
					oTable.draw();
			});

	//addproject=> datepicker
	$(document).ready(function(){
		//for start date
		$("#start_date").datepicker({
			format: 'dd-mm-yyyy',
			numberOfMonths: 1,
			onSelect: function(selected) {
					$("#deadline").datepicker("option","minDate", selected)
			}
     	});
		//for end date
		$("#deadline").datepicker({ 
			format: 'dd-mm-yyyy',
			numberOfMonths: 1,
			onSelect: function(selected) {
				$("#start_date").datepicker("option","maxDate", selected)
			}
		 });
	});

	//addproject=> sweetalert for delete
	/* function deleteproducts(id){
		var url = base_url+"Project/deleteproject";
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
				   data: {id:id},
				  dataType: "html",
				  
				   success: function (data) {
					   swal("Done!", "It was succesfully deleted!", "success");
					   $('#project').DataTable().ajax.reload();
				   },
				   error: function (xhr, ajaxOptions, thrownError) {
					   swal("Error deleting!", "Please try again", "error");
				   }
			   });
		   }
		   });
	}*/

	//addproject date validation
	function changeDate(){
			var SD = document.getElementById('start_date').value;
			var ED = document.getElementById('deadline').value;
			var flag=0;
			if (SD > ED) {
               alert("Start date should not be greater than end date");
			  // document.getElementById('start_date').focus();
			   flag=1;
           }
		  if(flag==1)
		  {
			  return false;
		  }
		  else{
			  return true;
		  }
       }
	
 
  	//addproject validation for all input
	$("form[name='creatclient']").validate({
		rules:{
				project_name : "required",
				select_client : "required",
				start_date : "required",
				deadline : "required",
				project_budget:{
								digits: true,
				},
				hours_allocated:{
								digits:true,
				},
		},		
		messages:
				{
					project_budget : "Enter valid input",
					hours_allocated : "Enter Valid input",
				},
		submitHandler: function(form) {
		form.submit();}
	});
	
	//addtemplate validation
	$("form[name='creatclient']").validate({
		rules:{
				project_name : "required",
		},			
		submitHandler: function(form) {
		form.submit();}
	});
	
	//addcategory using jquery 
	/*$("#category").submit(function(event) {
				event.preventDefault();
				var name = $("input[name='category_name']").val();
				var dataString = 'name='+ name;
				$.ajax({
				   url: base_url+"project/insertcategory",
				   type: 'POST',
				   data: dataString,
				   error: function() {
					  alert('Something is wrong');
				   },
				   success: function(data) {
					window.location.reload();
				  }
				});
	});*/

	// for add category in addproject
	$("#save-category").click(function(event) {
				event.preventDefault();
				var catname = $("input[name='category_name']").val();
				var dataString = 'name='+ catname;
				$.ajax({
				   url: base_url+"project/insertcat",
				   type: 'POST',
				   dataType: 'json',
				   data: dataString,
				   error: function() {
					  alert('Something is wrong');
				},
				success: function(data) {
				console.log(data);
				$('select[name="category_name"]').html('');       
				$('select[name="category_name"]').append(data.catdata);
				
				$("tbody").append("<tr><td>"+data.count+"</td><td>"+name+"</td> <td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' id='deletecat' value='Remove'></tr>");
				$('#project-category1').modal('toggle');
				$('#category')[0].reset();
			   }
			});
	});

	// addproject=> delete category 
	$('#deletecat').click(function(){
		var btn = this;
		e.preventDefault();
			$.ajax({
			   type: "POST",
			   url: base_url+"project/deletecat",
			   cache: false,
			   data: "id="+$(this),
			   success: function(){
			}
			});
	return false
	});
	