<div class="col-md-3 filter-section">
    <ul class="nav tabs-vertical in">
         <div class="stats-box">
            <li class="tab">
                <a href="" class="active">Company Settings</a></li>
            <li class="tab">
                <a href="">Profile Settings</a></li>
            <li class="tab">
                <a href="">Notification Settings</a></li>
            <li class="tab ">
                <a href="">Currency Settings</a></li>
            <li class="tab ">
                <a href="">Theme Settings</a></li>
            <li class="tab ">
                <a href="">Payment Credentials</a>
            </li>
            <li class="tab ">
                <a href="">Finance Settings</a></li>
            <li class="tab ">
                <a href="">Ticket Settings</a></li>
            <li class="tab ">
                <a href="">Project Settings</a></li>

            <li class="tab  active ">
            <a href="" class="active">Attendance Settings</a></li>
            <li class="tab ">
            <a href="">Leaves Settings</a></li>
            
            <li class="tab ">
            <a href="">Update Log</a></li>
            
            <li class="tab ">
                <a href="">Custom Fields</a></li>
            <li class="tab ">
                <a href="">Module Settings</a></li>
            <li class="tab ">
                <a href="">Roles &amp; Permissions</a></li>

                    <li class="tab ">
                    <a href="">Message Settings</a></li>
                <li class="tab ">
                <a href="">Storage Settings</a></li>
            <li class="tab ">
                <a href="">Language Settings</a></li>
                <li class="tab ">
                <a href="">Lead Settings</a></li>
                    <li class="tab ">
                <a href="">Time Log  Settings</a></li>
                <li class="tab ">
                <a href="">Task Settings</a></li>

            <li class="tab ">
                <a href="" class="waves-effect"><span class="hide-menu"> GDPR</span></a>
            </li>
            
            
            <li><a href="" target="_blank" class="waves-effect"><span class="hide-menu"> Help</span></a>
            </li>
        </div>
    </ul>
    

    <script src="https://demo.worksuite.biz/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        var screenWidth = $(window).width();
        if(screenWidth <= 768){

            $('.tabs-vertical').each(function() {
                var list = $(this), select = $(document.createElement('select')).insertBefore($(this).hide()).addClass('settings_dropdown form-control');

                $('>li a', this).each(function() {
                    var target = $(this).attr('target'),
                        option = $(document.createElement('option'))
                            .appendTo(select)
                            .val(this.href)
                            .html($(this).html())
                            .click(function(){
                                if(target==='_blank') {
                                    window.open($(this).val());
                                }
                                else {
                                    window.location.href = $(this).val();
                                }
                            });

                    if(window.location.href == option.val()){
                        option.attr('selected', 'selected');
                    }
                });
                list.remove();
                $('.filter-section').show()
            });

            $('.settings_dropdown').change(function () {
                window.location.href = $(this).val();
            })

        }
    </script>
</div>
            