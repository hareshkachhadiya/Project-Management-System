jQuery(document).ready(function() {
	if(controllerName == 'project' && (functionName == 'index' || functionName == '')){
		var user = jQuery('#projectuserid').val();
		if(user == 0 || user == 2){
			var aoColumns = [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ] }, 
			];
		}
		else{
			var aoColumns = [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },  
				{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
			//	{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ] }, 
			];
		}
			
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
			aoColumns,			
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

	else if(controllerName == 'project' && functionName == 'projecttemplate'){
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
						{ "sWidth": "250px", sClass: "text-center", "asSorting": [ ] },
					  ],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Project/templatelist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Templates found<br/><br/></center>', "sZeroRecords": "<center><br/>No Templates found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ Templates", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
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
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Templates</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Templates</small>)';
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

	else if(controllerName == 'project' && functionName == 'viewarchiev'){
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
			"aoColumns": [
							{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
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
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Templates found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
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

	else if(controllerName == 'leaves' && (functionName == 'index' || functionName == '')){
		
		var oTable = jQuery('#leaves').DataTable({
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
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ] }, 
			],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Leaves/leavelist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No leaves found<br/><br/></center>', "sZeroRecords": "<center><br/>No leaves found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
				aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
				aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
				aoData.push( { "name": "ename", "value": $('#empname').val() } );

				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#leaves').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leaves</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leaves </small>)';
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

	else if(controllerName == 'ticket' && (functionName == 'index' || functionName == '')){
		
		var user = jQuery('#userid').val();
		if(user == 0){
			var aoColumns= [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ ]  }, 

		];
		}else if(user == 1){
			var aoColumns= [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
 
			];
		}else if(user == 2){
			var aoColumns= [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },  
			];
		}
		var oTable = jQuery('#tickets').DataTable({
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
			"sAjaxSource": base_url+"Ticket/ticketlist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No tickets found<br/><br/></center>', "sZeroRecords": "<center><br/>No tickets found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ tickets", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
		    	aoData.push({"name": "s_date", "value":$('#start_date').val()});
		    	aoData.push({"name" :"e_date" ,"value":$('#deadline').val()});
		    	aoData.push({ "name": "agent", "value": $('#agent').val() } );

				aoData.push({ "name": "status1", "value": $('#status').val() } );
				aoData.push({ "name": "priority", "value": $('#priority').val() } );
				aoData.push({ "name": "channelname", "value": $('#channelname').val() } );
				aoData.push({ "name": "tickettype", "value": $('#tickettype').val() } );
				
				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#tickets').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Tickets</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Tickets </small>)';
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

	else if(controllerName == 'timelog' && (functionName == 'index' || functionName == '')){
		var user = jQuery('#timeloguserid').val();
		if(user == 0){
			var aoColumns =[{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ ] }, 
		    ];
		}else if(user == 2){
			var aoColumns =[{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
		    ];

		}
		var oTable = jQuery('#timelog').DataTable({
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
			"sAjaxSource": base_url+"Timelog/timeloglist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Timelogs found<br/><br/></center>', "sZeroRecords": "<center><br/>No Timelogs found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
		    	aoData.push( { "name": "pname", "value": $('#projectData').val() } );
		    	aoData.push( { "name": "ename", "value": $('#employeeData').val() } );
		    	aoData.push({"name": "start_date", "value":$('#start_date').val()});
		    	aoData.push({"name" :"deadline" ,"value":$('#deadline').val()});
				
				
				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#timelog').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Timelogs</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Timelogs </small>)';
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

	else if(controllerName == 'taskreport' && ( functionName == '' || functionName == 'index')){
		
		var oTable = jQuery('#taskreport').DataTable({    
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
			"aoColumns": [
							{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ] }, 
							//{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
						],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"TaskReport/taskreportlist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No TaskReport found<br/><br/></center>', "sZeroRecords": "<center><br/>No TaskReport found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				aoData.push( { "name": "startdate", "value": $('#start_date').val() } );
				aoData.push( { "name": "enddate", "value": $('#deadline').val() } );
				aoData.push( { "name": "project", "value": $('#projectData').val() } );
				aoData.push( { "name": "empdata", "value": $('#employeeData').val() } );
				
				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	console.log(json.graphstr);
	                	taskChart(json.graphstr.complete,json.graphstr.doing,json.graphstr.todo,json.graphstr.incpm)
	                	
	                	
	                	var oTable = $('#taskreport').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' TaskReport</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' TaskReport</small>)';
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

	else if(controllerName == 'leavereport' && (functionName == 'index' || functionName == '')){
		
		var oTable = jQuery('#leavesreport').DataTable({
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
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }
			],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"LeaveReport/leavelistreport",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No LeavesReport Found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
				aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
				aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
				aoData.push( { "name": "ename", "value": $('#empname').val() } );

				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#leavesreport').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leaves</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leaves </small>)';
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

	else if(controllerName == 'attandancereport' && (functionName == 'index' || functionName == '')){
		
		var oTable = jQuery('#attandancereport').DataTable({
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
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }

			],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"AttandanceReport/attandancelistreport",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No AttandanceReport Found<br/><br/></center>', "sZeroRecords": "<center><br/>No AttandanceReport found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
				aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
				aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
				aoData.push( { "name": "ename", "value": $('#empname').val() } );

				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#attandancereport').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' AttandanceReport</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' AttandanceReport </small>)';
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

	else if(controllerName == 'financereport' && (functionName == 'index' || functionName == '')){
		
		var oTable = jQuery('#finanacereport').DataTable({
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
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] },
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ] }
			],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"FinanceReport/fianancereportlist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No FinanceReport found<br/><br/></center>', "sZeroRecords": "<center><br/>No FinanceReport found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
				aoData.push( { "name": "start_date", "value": $('#start_date').val() } );
				aoData.push( { "name": "deadline", "value": $('#deadline').val() } );
				aoData.push( { "name": "project", "value": $('#projectData').val() } );
				aoData.push( { "name": "clientData", "value": $('#clientData').val() } );
				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var getGraph = json.graphData;
	                	var splitArr = getGraph.xdata;
	                	//console.log(getGraph.xdata);
	                	graphDataAppend(getGraph.xdata,getGraph.ydata);
	                	//alert(splitArr[0]);
	                	var oTable = $('#finanacereport').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;
	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' FinanaceReport</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' FinanaceReport </small>)';
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

$('#project_status').change(function(){
	//button filter event click
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

$('#btnApplyLeaves').click(function(){ 
	var oTable = $('#leaves').DataTable();
	oTable.draw();
});

$('#btnApplyLeavesReport').click(function(){ 
	var oTable = $('#leavesreport').DataTable();
	oTable.draw();
});


$('#btnApplyTicket').click(function(){
	var oTable = $('#tickets').DataTable();
	oTable.draw();
});

$('#btnApply').click(function(){
	var oTable = $('#tickets').DataTable();
	oTable.draw();
});

$('#btnApplyLogs').click(function(){
	var oTable = $('#timelog').DataTable();
	oTable.draw();
});

$('#btnApplyReport').click(function(){
	var oTable = $('#taskreport').DataTable();
	oTable.draw();
});

$('#btnApplyAttandanceReport').click(function(){
	var oTable = $('#attandancereport').DataTable();
	oTable.draw();
});

$('#btnFinanceReport').click(function(){
	var oTable = $('#finanacereport').DataTable();
	oTable.draw();
});

//addproject=> datepicker
$(document).ready(function(){
	//for start date
	$("#start_date").datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
    }).on('changeDate', function (selected) {
        $('#deadline').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
        var minDate = new Date(selected.date.valueOf());
        $('#deadline').datepicker("update", minDate);
        $('#deadline').datepicker('setStartDate', minDate);
    });
	//for end date
	$("#deadline").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#start_date').datepicker('setEndDate', maxDate);
    });
});


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
	messages:{
			project_budget : "Enter valid input",
			hours_allocated : "Enter Valid input",
		},
	submitHandler: function(form) {
	form.submit();}
});

//edit(insert)ticket
$("form[name='editticket']").validate({
	rules:{
		editor:"required",
		requestername:"required",
		status:"required",
	},
	messages:{
		editor: "The subject field is required.",
		requestername:"The description field is required.",
		status:"The status field is requird",

	},
	submitHandler: function(form) {
	form.submit();}
});
	
//Leaves Validation
$("form[name='creatleave']").validate({
	rules:{
		date: "required",
		absence : "required",
	},	
	messages:{
		date    : "Enter valid date",
		absence : "Enter Reason",
	},
	submitHandler:function(form){
	form.submit();
	}
});

//addtimelog validation
$("form[name='addtimelog']").validate({
	rules:{
			project_name : "required",
			timelog_d1  : "required",
			timelog_d2  : "required",
			timelog_t1  : "required",
			timelog_t2  : "required",
			memo  : "required",
			empname : "required",

	},	
	messages:{
			project_name : "Choose project",
			timelog_d1  : "Choose StartDate",
			timelog_d2  : "Choose EndDate",
			timelog_t1  : "Choose StartTimelog",
			timelog_t2  : "Choose EndTimelog",
			memo  : "Enter your Memo",
	},	
	submitHandler: function(form) {
	form.submit();}
});


//for addticket vlaidation

$("form[id='addticket']").validate({
	rules:{
		ticket_subject: "required",
		editor2: "required",
		requestername: "required",
		status :"required",
		agentname:"required"

	},
	messages:{
		ticket_subject: "The subject field is required",
		editor2: "The description field is required",
		requestername: "Requester Name Required",
		status: "Status is Required",

	},
	submitHandler:function(form){
	form.submit();
	}
});

// for add category in addproject
$("#save-category").click(function(event) {
	var catname = $("input[name='category_name']").val();
	if(catname!=""){
		$.ajax({
			url: base_url+"project/checkcategory",
			type: 'POST',
			dataType: 'html',
			data:{category:catname},
			success: function(data) {
				
				if(data==0){
					var dataString = 'name='+ catname;
					jQuery('#errormsg').html('');
					$.ajax({
					    url: base_url+"project/insertcat",
					    type: 'POST',
					    dataType: 'json',
					    data: dataString,
						success: function(data) {
							//console.log(data.ticketdata);
							$('select[name="project-category"]').html('');       
							$('select[name="project-category"]').append(data.catdata);
							$("tbody").append("<tr id='cate_"+data.lastinsertid+"'><td>"+data.count+"</td><td>"+catname+"</td> <td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' onclick='deletecat(\'"+data.lastinsertid+"\');' id='deletecat' value='Remove'></tr>");
						    $('#project-category1').removeClass('show');
							$('.modal-backdrop').removeClass('show');
							$('.modal-backdrop').find('div').remove();
							$('body').removeAttr("style");
							$('body').removeClass("modal-open");
							$('#category')[0].reset();
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully category added</b>');
							$('#succmsg').fadeOut(5000);
					   }
					});
				}else{
					jQuery('#errormsg').html('')
					jQuery('#errormsg').html('<b>This category already exists</b>');
				}
			}
		});
	}else{
		jQuery('#errormsg').html('')
		jQuery('#errormsg').html('<b>Please enter category name</b>');
	}
});


// for add leaves 
$("#save_leave").click(function() {
	var leavename = $("input[name='leavename']").val();
	if(leavename != ''){
		$.ajax({
				url: base_url+"leaves/checkleaves",
			    type: 'POST',
			    dataType: 'Json',
			    data: {leave:leavename},
				success: function(data){
					if(data == 0){
						var dataString = 'name='+ leavename;
							$.ajax({
						   		url: base_url+"leaves/insertleavestype",
						  		type: 'POST',
						    	dataType: 'json',
						  		data: dataString,
								success: function(data){
										$('select[name="leave_type"]').html('');       
										$('select[name="leave_type"]').append(data.deleteleavetype);
										$("tbody").append("<tr id='leave"+data.leaveData+"'><td>"+data.count+"</td><td>"+leavename+"</td> <td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' onclick='deleteleavetype(\""+data.leaveData+"\");' id='deletesearchLeave' value='Remove'></td></tr>");
										$('#leave_type1').modal('toggle');
										$('#leave')[0].reset();
								 }
							});
					}else{
						jQuery('#errormsg').html('')
						jQuery('#errormsg').html('<b>This Leaves already exists</b>');
					}	
				}
		});
	}else{
			jQuery('#errormsg').html('')
			jQuery('#errormsg').html('<b>Please enter Leaves name</b>');
	}
});

// add ticket type
$("#save_ticket").click(function(event) {
	var t_name = $("input[name='ticket_type']").val();
	if(t_name!=""){
		$.ajax({
			url: base_url+"ticket/check_t_type",
			type: 'POST',
			dataType: 'html',
			data:{ticket:t_name},
			success: function(data) {
				if(data==0){
					var dataString = 'name='+ t_name;
					jQuery('#errormsg').html('');
					$.ajax({
					    url: base_url+"ticket/insert_t_type",
					    type: 'POST',
					    dataType: 'json',
					    data: dataString,
						success: function(data) {
							console.log(data.ticketdata);
						    $('#question').html('');       
							$('#question').append(data.ticketdata);
							$('#ticket')[0].reset();
							$('#type1').modal('toggle');
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully ticket added</b>');
							$('#succmsg').fadeOut(3000);
					   }
					});
				}else{
					jQuery('#errormsg').html('')
					jQuery('#errormsg').html('<b>This ticket already exists</b>');
				}
			}
		});
	}else{
		jQuery('#errormsg').html('')
		jQuery('#errormsg').html('<b>Please enter ticket name</b>');
	}
});


//add channel 
$("#save_tchannel").click(function(event) {
	var c_name = $("input[name='channel_name']").val();
	if(c_name!=""){
		$.ajax({
			url: base_url+"ticket/check_t_channel",
			type: 'POST',
			dataType: 'html',
			data:{channel:c_name},
			success: function(data) {
				if(data==0){
					var dataString = 'name='+ c_name;
					jQuery('#errormsg').html('');
					$.ajax({
					    url: base_url+"ticket/insert_t_channel",
					    type: 'POST',
					    dataType: 'json',
					    data: dataString,
						success: function(data) {
							console.log(data.ticketcdata);
						    $('#channel').html('');       
							$('#channel').append(data.ticketcdata);
							$('#channel1').modal('toggle');
							$('#ticketchannel')[0].reset();	
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully Channel added</b>');
							$('#succmsg').fadeOut(3000);
					   	}
					});
				}else{
					jQuery('#errormsgc').html('')
					jQuery('#errormsgc').html('<b>This Channel already exists</b>');
				}
			}
		});
	}else{
		jQuery('#errormsgc').html('')
		jQuery('#errormsgc').html('<b>Please enter Channel Name</b>');
	}
});


// addproject=> delete category 
	function deleteleavetype(id){
		$.ajax({
		    type: "POST",
		    url: base_url+"leaves/deleteleavetype",
		    cache: false,
		    data: "id="+id,
		    success: function(data){
			   	if(data == 1){
					jQuery('#leave'+id).remove();
					$('#leave_type1').removeClass('show');
					$('.modal-backdrop').removeClass('show');
					$('.modal-backdrop').find('div').remove();
					$('body').removeAttr("style");
					$('body').removeClass("modal-open");
					$('#leave')[0].reset();
					$('#succmsg').html('');
					$('#succmsg').html('<b>Successfully category removed</b>');
					$('#succmsg').fadeOut(3000);
				}else{
					$('#succmsg').html('');
					$('#succmsg').html('<b>Something went to wrong</b>');
				}
			}
		});
	}

	// addleaves=> addleavestype => deleteleaves 
	function deletecat(id){
		$.ajax({
		    type: "POST",
		    url: base_url+"project/deletecat",
		    cache: false,
		    data: "id="+id,
		    success: function(data){
			   	if(data == 1){
					
					/*$('#project-category1').removeClass('show');
					$('.modal-backdrop').removeClass('show');
					$('.modal-backdrop').find('div').remove();
					$('body').removeAttr("style");
					$('body').removeClass("modal-open");
					$('#leavecategory')[0].reset();
					$('#succmsg').html('');*/
					$('#succmsg').html('<b>Successfully category removed</b>');
					$.ajax({
						url: base_url+"project/getcategory",
						type: 'POST',
						dataType: 'JSON',
						success: function(data){
							jQuery('#cate_'+id).remove();
							$('select[name="project-category"]').html('');       
							$('select[name="project-category"]').append(data.catdata);
							$('#project-category1').removeClass('show');
					$('.modal-backdrop').removeClass('show');
					$('.modal-backdrop').find('div').remove();
					$('body').removeAttr("style");
					$('body').removeClass("modal-open");
					$('#leavecategory')[0].reset();
					$('#succmsg').html('');
							jQuery('#errormsg').css('display','none');
						}
					});	
					

				}else{
					$('#succmsg').html('');
					$('#succmsg').html('<b>Something went to wrong</b>');
				}

			}
		});
	}

   
	function searchleaves(id){
		$.ajax({
		    type: "POST",
		    url: base_url+"leaves/searchleaves",
		    cache: false,
		    dataType: 'json',
		    data: "id="+id,
		   success: function(data){
		   	$('#leave-preview').html('');
		   	$('#leave-preview').append(data);

			}
		});
	}

	function edittimelog(id){
		$('#timelog-popup').modal('show');
		$.ajax({
			type: "POST",
		    url: base_url+"timelog/edittimelog",
		    cache: false,
		    dataType: 'json',
		    data: "id="+id,
		    success: function(data){
			    $('#timelog_edit').html('');
			   	$('#timelog_edit').append(data);
			},
			error: function (xhr, ajaxOptions, thrownError) { }
		});
	}

	function checkUncheck(){ 
		var checkBox = document.getElementById("without_deadline");
        if (checkBox.checked) {
            $('#deadlineBox').hide().checked;
        }
		else{
			 $('#deadlineBox').show();
		}	
	}

	function viewtask(){ 
		var checkBox = document.getElementById("client-view-tasks");
        if (checkBox.checked) {
            $('#viewnotification').show().checked;
        }
		else{
			 $('#viewnotification').hide();
		}	
	}

	//delete projects
	function deleteproject(id){
		var url = base_url+"project/deleteproject";
		swal({
			title: "Are you sure?",
			text: "Do you want to delete this project?",
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
					    $('#archievdata').DataTable().ajax.reload();
				    },
				    error: function (xhr, ajaxOptions, thrownError) {
					   swal("Error deleting!", "Please try again", "error");
				    }
				});
			}
		});
	}
	
	//delete timelog
	function deletetimelog(id){
		
		var url = base_url+"timelog/deletetimelog";
		swal({
			title: "Are you sure?",
			text: "Do you want to delete this timelog?",
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
					   
					    if(controllerName == 'project' && functionName == 'timelogs'){
					    		window.location.reload();
					    }
					     $('#timelog').DataTable().ajax.reload();
				   },
				    error: function (xhr, ajaxOptions, thrownError) {
					   swal("Error deleting!", "Please try again", "error");
				    }
				});
			}
		});
	}

	// deleteticket
    function deleteticket(id){
		var url = base_url+"ticket/deleteticket";
		swal({
			title: "Are you sure?",
			text: "Do you want to delete this Ticket?",
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
						    $('#tickets').DataTable().ajax.reload();
					  	},
					   	error: function (xhr, ajaxOptions, thrownError) {
						   	swal("Error deleting!", "Please try again", "error");
					    }
				});
			}
		});
	}

	//deletetemplate
	function deletetemplate(id){
		var url = base_url+"project/deletetemplate";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this project?",
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
					   },
					   error: function (xhr, ajaxOptions, thrownError) {
						   swal("Error deleting!", "Please try again", "error");
					   }
				   });
			   }
			});
		}

	//delete leaves
	function deleteleaves(id){
		var url = base_url+"Leaves/deleteleaves";
		swal({
			title: "Are you sure?",
			text: "Do you want to delete this leaves?",
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
						$('#leaves').DataTable().ajax.reload();
					},
					error: function (xhr, ajaxOptions, thrownError) {
						swal("Error deleting!", "Please try again", "error");
					}
				});
			}
		});
	}

	//edit leaves
	function editleaves(id){
		$('#leaves-popup').modal('toggle');
		$('#editleaves').modal('show');
		var url = base_url+"Leaves/editleavesbtn";
		  	$.ajax({
	   			type: 'POST',
		   		url: url,
		        cache: false,
			    dataType: 'json',
			    data: "id="+id,
			    success: function (data) {
			   		$('#leave_edit').html('');
				  	$('#leave_edit').append(data);
			    },
			   error: function (xhr, ajaxOptions, thrownError) {
			    }
	        });
	}
	

	function deleteSearchLeaves(id){
		var url = base_url+"Leaves/deleteSearchLeaves";
		swal({
			title: "Are you sure?",
			text: "Do you want to delete this leaves?",
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
						$('#edileaves').modal('toggle');
						window.location.reload();
					},
					error: function (xhr, ajaxOptions, thrownError) {
						swal("Error deleting!", "Please try again", "error");
					}
				});
			}
		});
    }

    //closeleaves
    function closeleaves(){
    	$.ajax({
    	    success: function (data) {
			    $('#edileaves').modal('toggle');
			    window.location.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {
			}
		});
    }
	 
    //edit btn clicking 
    function editdata(id){
    	var mem = $('#choose_mem').val();
		var ltype = $('#leave_type').val();
		var date = $('#date').val();
        var abs = $('#absence').val();
		var sta = $('#status').val();
		
		if(abs.trim() == ''){
			alert('Enter Reason for absence');
			return false;
		}else{
			$.ajax({
				url: base_url+"Leaves/updateleaves",
				type: "POST",
				dataType: "JSON",
				data: {id : id  , mem : mem ,ltype : ltype , date : date , abs : abs, sta : sta},
				dataType: "html",
			    success: function (data) {
					$('#timelog-popup').modal('toggle');
						window.location.reload();
				},
			});
		}
	}

	function updatetimelog(id){
		var projectname =$('#project_name').val();
		var date1 = $('#d1').val();
		var date2 = $('#d2').val();
		var time1 = $('#t1').val();
		var time2 = $('#t2').val();
		var hours = $('#hours1').val();
		var emp = $('#empname').val();
		var demo = $('#detail_memo').val();
		$.ajax({
			url:base_url+"timelog/update_timelog",
			type:"POST",
			dataType:"json",
			data:{id:id,pname:projectname,d1:date1,d2:date2,t1:time1,t2:time2,hour:hours,employee:emp,demo:demo},
			dataType:"html",
			success:function(data){
				$('#timelog-popup').modal('toggle');
				window.location.reload();
			},
		});
	}

	function archivetoproject(id){
		var url = base_url+"project/archivetoproject";
		swal({
				title: "Are you sure?",
				text: "Do you want to restore this project?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, restore it!",
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
						swal("Done!", "Project restored successfully..!", "success");
						$('#project').DataTable().ajax.reload();
					},
					error: function (xhr, ajaxOptions, thrownError) {
						swal("Error !", "Please try again", "error");
					}
				});
			}
	    });
	}
		
	function archivedata(id) {
		var url = base_url+"project/archivedata";
			swal({
			 		title: "Are you sure?",
					text: "Do you want to archive this project?",
					type: "warning",
				    showCancelButton: true,
				    confirmButtonColor: "#DD6B55",
				    confirmButtonText: "Yes, archive it!",
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
						   		swal("Done!", "Project archived successfully..!", "success");
						        $('#project').DataTable().ajax.reload();
					        },
					        error: function (xhr, ajaxOptions, thrownError) {
						   		swal("Error !", "Please try again", "error");
					   		}
				   });
			    }
		   });
	}

	//delete tickets testttt
	function delete_t_comment(id){
		var url = base_url+"ticket/deletecomment";
			swal({
				title: "Are you sure?",
				text: "Do you want to delete this Ticket Replay?",
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
							    window.location.reload();
						    },
						    error: function (xhr, ajaxOptions, thrownError) {
							    swal("Error deleting!", "Please try again", "error");
						    }
				    });
				}
			});
	}


	function showEmployee(){
		pname = $('#project_name').val();
		$('#empdiv').show();

		if(pname !=''){
			$.ajax({
				 url: base_url+"timelog/getEmployee",
				type:'post',
				 dataType:'json',
				 data:{projectname:pname},
				 success:function(data){
				 	$('#empname').html('');
		           	$('#empname').append(data.empname);
		        }

			});
	    }
	}
 	$('#starttime').timepicker();
  	$('#endtime').timepicker();
	function append(dl, dtTxt, ddTxt) {
	  	var dd = document.createElement("dd");
	  	dd.textContent = ddTxt;
	 	dl.appendChild(dd);
	  	$("#hours1").val(dd.textContent);
	}

	$(document).ready(function() {
	  var today = new Date();
	  $('#timelog_d1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate())).slice(-2));
	  $('#timelog_d2').val($('#timelog_d1').val());
	  $('#timelog_t1').val('00:00');
	  $('#timelog_t2').val('00:00');
	  //
	  //$('#d1 #d2 #t1 #t2').
	  $('#timelog_d1, #timelog_d2, #timelog_t1, #timelog_t2').on('change', function(ev) {
	    var dl = document.getElementById("diff");
	    while (dl.hasChildNodes()) {
	      dl.removeChild(dl.lastChild);
	    }

	    var date1 = new Date($('#timelog_d1').val() + " " + $('#timelog_t1').val()).getTime();
	    var date2 = new Date($('#timelog_d2').val() + " " + $('#timelog_t2').val()).getTime();
	   // append(dl, "Interval ", " from: " + $('#d1').val() + " " + $('#t1').val() + " to: " + $('#d2').val() + " " + $('#t2').val());
	    var msec = date2 - date1;
	    var mins = Math.floor(msec / 60000);
	    var hrs = Math.floor(mins / 60);
	    var days = Math.floor(hrs / 24);
	    var yrs = Math.floor(days / 365);
	    //append(dl, "Minutes: ", mins + " minutes");
	    mins = mins % 60;
	    append(dl, "", hrs +" Hrs " + mins + " Mins");
	  });
	  $('#timelog_d1').change();

	});


//for addtimelog calculate 
	/*function calculateHours(){
		var today = new Date();

	  	$('#d1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate() + 1)).slice(-2));
	 	$('#d2').val($('#d1').val());
	 	$('#t1').val('00:00');
	    $('#t2').val('00:00');
	    $('#d1, #d2, #t1, #t2').on('change', function(ev) {
	   		var dl = document.getElementById("diff");
	   		alert(d1);
	   	    while (dl.hasChildNodes()) {
	    		dl.removeChild(dl.lastChild);
	        }
	   		var date1 = new Date($('#d1').val() + " " + $('#t1').val()).getTime();
	        var date2 = new Date($('#d2').val() + " " + $('#t2').val()).getTime();
	   		var msec = date2 - date1;
	        var mins = Math.floor(msec / 60000);
	        var hrs = Math.floor(mins / 60);
	        var days = Math.floor(hrs / 24);
	        var yrs = Math.floor(days / 365);
	    	mins = mins % 60;
	    	append(dl, "", hrs +" Hrs " + mins + " Mins");
	    });

	    $('#d1').change();
	}*/

//for addtimelog datepicker
	$(document).ready(function(){
		$("#timelog_d1").datepicker({
		    format: 'yyyy-mm-dd',
		    todayHighlight: true,
		    autoclose: true,
		}).on('changeDate', function (selected) {
		    $('#timelog_d2').datepicker({
		        format: 'yyyy-mm-dd',
		        autoclose: true,
		        todayHighlight: true
		    });
		    var minDate = new Date(selected.date.valueOf());
		    $('#timelog_d2').datepicker("update", minDate);
		    $('#timelog_d2').datepicker('setStartDate', minDate);
		});
		//for end date
		$("#timelog_d2").datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose: true
		}).on('changeDate', function (selected) {
		    var maxDate = new Date(selected.date.valueOf());
		    $('#timelog_d1').datepicker('setEndDate', maxDate);
		});
	});


//for timelog modal datepicker
	function changeDate(){

		$("#d1").datepicker({
		    format: 'yyyy-mm-dd',
		    todayHighlight: true,
		    autoclose: true,
		}).on('changeDate', function (selected) {
		    $('#d2').datepicker({
		        format: 'yyyy-mm-dd',
		        autoclose: true,
		        todayHighlight: true
		    });
		    var minDate = new Date(selected.date.valueOf());
		    $('#d2').datepicker("update", minDate);
		    $('#d2').datepicker('setStartDate', minDate);
		});
		//for end date
		$("#d2").datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose: true
		}).on('changeDate', function (selected) {
		    var maxDate = new Date(selected.date.valueOf());
		    $('#d1').datepicker('setEndDate', maxDate);
		});
	}

//for timelog calculate hours function
function calculateHours(){
		var today = new Date();
	  	//$('#d1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate() + 1)).slice(-2));
	 	//$('#d2').val($('#d1').val());
	 	//$('#t1').val('00:00');
	    //$('#t2').val('00:00');
	    $('#d1, #d2, #t1, #t2').on('change', function(ev) {
	   		var dl = document.getElementById("diff");

	   	    while (dl.hasChildNodes()) {
	    		dl.removeChild(dl.lastChild);
	        }
	   		var date1 = new Date($('#d1').val() + " " + $('#t1').val()).getTime();
	        var date2 = new Date($('#d2').val() + " " + $('#t2').val()).getTime();
	   		var msec = date2 - date1;
	        var mins = Math.floor(msec / 60000);
	        var hrs = Math.floor(mins / 60);
	        var days = Math.floor(hrs / 24);
	        var yrs = Math.floor(days / 365);
	    	mins = mins % 60;
	    	append(dl, "", hrs +" Hrs " + mins + " Mins");
	    });

	    $('#d1').change();
	}


function showLeaveReportActive(id,status){

	$.ajax({
		type: "POST",
		url: base_url+"LeaveReport/LeaveReportActive",
		dataType: 'html',
	    data: "id="+id,
	    success: function(data){
	    
	    	var finalArr = data.split('#$#');
	    	$("#counter").append(finalArr[1]);
	    	$("tbody").append(finalArr[0]);
	    	//console.log(finalArr[1]);
			//$("tbody").append("<tr id='cate_"+data.empid+"'><td>#</td><td>"+data.leaveid+"</td><td>"+data.date+"</td><td>"+data.reason+"</td></tr>");
		 }
	});
}


function showLeaveReportPending(id,status){
	
	$.ajax({
		type: "POST",
		url: base_url+"LeaveReport/LeaveReportPending",
		dataType: 'html',
	    data: "id="+id,
	    success: function(data){
	    	
	    	var finalArr = data.split('#$#');
	    	$("tbody").html('');
	    	//$("#counter").html('');
	    	$("#counter").append(finalArr[1]);
	    	$("tbody").append(finalArr[0]);

	    	//$("#commonleave").modal('toggle');
						   /*window.location.reload();*/
	    	//window.location.reload();
	    	//setInterval('location.reload(true), 5000); 
	    	//console.log(finalArr[1]);
			
		 }
	});

}


jQuery('#close').click(function(){
    jQuery('#errormsg').css('display','none');
    jQuery('#category_name').val('');
});

 
