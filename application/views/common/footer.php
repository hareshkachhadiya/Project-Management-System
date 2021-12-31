            <!-- footer -->
            <footer>
                <p>2020 &copy; PMS</p>
            </footer>
            <!-- ends of footer -->
        </div>
    </div>
    <!--for bar chart-->
    <!--  <script src="http://code.highcharts.com/highcharts.js"></script> -->
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/search-dropdown.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/datatables.bundle.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/custome.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/sejal.js"></script>
    <script src="<?php echo base_url();?>assets/js/varsha.js"></script> 
    <script src="<?php echo base_url();?>assets/js/vaishali.js"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
   
    <script type="text/javascript">
        var controllerName = '<?php echo strtolower($this->uri->segment(1)); ?>';
        var functionName = '<?php echo strtolower($this->uri->segment(2)); ?>';
        $(document).ready(function() {
            $('#users-table').DataTable();
            CKEDITOR.replace( 'editor1' );

            $('.toggle-filter').click(function () {
                $('#ticket-filters').toggle('slide');
            })
        });
    </script>
	
    <script type="text/javascript">
       function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);
            var time = minutes + ":" + seconds;
            if (--timer < 0) {
                timer = duration;
            }
            if (time == '00:00') {
                window.location.href = '<?php echo base_url().'login/logout'; ?>';
            }
        }, 1000);
    }

    jQuery(function ($) {
        var fiveMinutes = 60 * 60,
            display = $('#timer');
        startTimer(fiveMinutes, display);
    });
    </script>
    <script type="text/javascript">
        function taskChart(complete,doing,todo,incomp){
        Highcharts.chart('piechart', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'TASK'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.y}</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.y} '
      }
    }
  },
  series: [{
    name: 'Task',
    colorByPoint: true,
    data: [{
      name: 'Complete',
      y: eval(complete),
      sliced: true,
      selected: true
    }, {
      name: 'Pending',
      y: eval(doing),
    }, {
      name: 'TO DO',
      y: eval(todo),
    },  {
      name: 'IN Complete',
      y: eval(incomp),
    }]
  }]
});

         }
       </script>
        <script type="text/javascript">
    function graphDataAppend(str,str1)
    {
    Highcharts.chart('finance_container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Finance Report'
        },
      
        xAxis: {
            categories: str,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {

            }
        },
        series: [{
            name: 'Income',
            data:str1
        },]
    });
}
</script>
<script type="text/javascript">
  function graphTimelogData(month,total){
    Highcharts.chart('timelog_container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'TimeLog Report'
        },
      
        xAxis: {
            categories: month,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
            //    text: 'Rainfall (mm)'
            }
        },
        series: [{
            name: 'HourseLogged',
            data: total
            //data:[50.0,47.0,0.0]
        },]
    });
  }
</script>
    
    
</body>
</html>



