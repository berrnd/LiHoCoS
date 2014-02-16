<div class="panel panel-default">
    <div class="panel-heading">
        Area Chart Example
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="line-chart-blind-<?php /* echo $blind->id; */ ?>"></div>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->

<script>
    $(document).ready(function() {
        new Morris.Line({
            element: 'line-chart-blind-<?php /* echo $blind->id; */ ?>',
            data: get_json_data('<?php echo base_url('api/get_data/blinds_history'); ?>'),
            // The name of the data record attribute that contains x-values.
            xkey: 'time',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['temperature'],
            // Labels for the ykeys, will be displayed when you hover over the chart.
            labels: ['Temperature']
        });

        function get_json_data(url) {
            var json = null;
            $.ajax({
                'async': false,
                'global': false,
                'url': url,
                'dataType': 'json',
                'success': function(data) {
                    json = data;
                }
            });
            return json;
        }
    });
</script>