$(document).ready(function () {
    $('#sidebarCollapse2').on('click', function () {
        $('#sidebar').toggleClass('active', 3000);
    });

    $('#sidebarCollapse2').on('click', function(){
			$('#content').toggleClass('less', 3000);
	});

    $('[data-toggle="tooltip"]').tooltip(); 
});


$(window).on('resize', function(){ 
	var win = $(this); 
	//this = window 
	if (win.width() <= 1199) { 
		jQuery('#sidebar').addClass('active');
		jQuery('.content').addClass('less');
	} 
});