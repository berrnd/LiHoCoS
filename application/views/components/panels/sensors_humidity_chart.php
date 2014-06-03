<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('Sensor humidity history'); ?>
        <div id="date-range-humidity-chart" class="pull-right">
            <i class="fa fa-calendar fa-lg"></i>
            <span><?php echo date(lang('php_short_date_format'), strtotime('now')); ?> - <?php echo date(lang('php_short_date_format')); ?></span> <i class="caret"></i>
        </div>
    </div>
    <div class="panel-body">
        <svg id="sensors-humidity-line-chart" style="height: 600px;" />
    </div>
</div>

<script>
    $(document).ready(function() {

        var MYSQL_DATETIME_FORMAT = "YYYY-MM-DD HH:mm:ss";

        window.humiditychart = {};
        window.humiditychart.daterange_start = moment().startOf('day').format(MYSQL_DATETIME_FORMAT);
        window.humiditychart.daterange_end = moment().format(MYSQL_DATETIME_FORMAT);

        function reload_chart() {
            nv.addGraph(function() {
                var chart = nv.models.lineChart()
                        .xScale(d3.time.scale());

                chart.xAxis
                        .axisLabel('<?php echo lang('Time') ?>')
                        .tickFormat(function(d) {
                            return d3.time.format('<?php echo lang('d3js_long_date_format'); ?>')(new Date(d))
                        });

                chart.yAxis
                        .axisLabel('<?php echo lang('Humidity') ?>');

                d3.select("#sensors-humidity-line-chart")
                        .datum(get_chart_data())
                        .transition()
                        .call(chart);

                nv.utils.windowResize(
                        function() {
                            chart.update();
                        }
                );

                return chart;
            });
        }

        function get_chart_data() {
            var lines = [];
            $.ajax({
                url: '<?php echo base_url('api/common/get_data/sensors') ?>',
                dataType: 'json',
                async: false,
                success: function(sensorsResponse) {
                    $.each(sensorsResponse.data, function(i) {
                        var line = {key: sensorsResponse.data[i].name, values: []};
                        var query = "SELECT sensor_id, timestamp, TRUNCATE(AVG(relative_humidity), 1) as relative_humidity FROM sensors_history WHERE sensor_id = " + sensorsResponse.data[i].id + " AND timestamp BETWEEN '" + window.humiditychart.daterange_start + "' AND '" + window.humiditychart.daterange_end + "' GROUP BY sensor_id, (60 / 30) * HOUR(timestamp) %2B FLOOR(MINUTE(timestamp) / 30) ORDER BY timestamp";
                        $.ajax({
                            url: '<?php echo base_url('api/common/get_data/sensors_history') ?>',
                            dataType: 'json',
                            type: 'POST',
                            data: {'custom-select': query},
                            async: false,
                            success: function(sensorsHistoryResponse) {
                                $.each(sensorsHistoryResponse.data, function(ii) {
                                    line.values.push({
                                        x: Date.parse(sensorsHistoryResponse.data[ii].timestamp),
                                        y: parseFloat(sensorsHistoryResponse.data[ii].relative_humidity)
                                    });
                                });
                            }
                        });
                        lines.push(line);
                    });
                }
            });
            return lines;
        }

        $('#date-range-humidity-chart').daterangepicker({
            ranges: {
                '<?php echo lang('Today'); ?>': [moment(), moment()],
                '<?php echo lang('Yesterday'); ?>': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        '<?php echo lang('Last Week'); ?>': [moment().subtract('days', 6), moment()],
                        '<?php echo lang('This Month'); ?>': [moment().startOf('month'), moment().endOf('month')],
                        '<?php echo lang('Last Month'); ?>': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            startDate: Date.parse(window.humiditychart.daterange_start),
            endDate: Date.parse(window.humiditychart.daterange_end),
            maxDate: new Date(),
            showDropdowns: true,
            format: '<?php echo lang('js_short_date_format'); ?>',
            locale: {
                fromLabel: '<?php echo lang('From'); ?>',
                toLabel: '<?php echo lang('To'); ?>',
                applyLabel: '<?php echo lang('Apply'); ?>',
                cancelLabel: '<?php echo lang('Cancel'); ?>'
            }
        }, function(start, end) {
            $('#date-range-humidity-chart span').html(start.format('<?php echo lang('js_short_date_format'); ?>') + ' - ' + end.format('<?php echo lang('js_short_date_format'); ?>'));
            window.humiditychart.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
            window.humiditychart.daterange_end = end.format(MYSQL_DATETIME_FORMAT);

            setTimeout(function() {
                reload_chart();
            }, 0);
        }
        );

        setTimeout(function() {
            reload_chart();
        }, 0);
    });
</script>