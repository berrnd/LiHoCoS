<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('Sensor temperature history'); ?>
        <div class="pull-right">
            <label for="aggregation-level-temperature-chart"><?php echo lang('Aggregation level'); ?></label>
            <select data-selected="30" id="aggregation-level-temperature-chart" onChange="window.tempchart.aggregation_level = this.options[this.selectedIndex].value;">
                <option value="30"><?php echo lang('Half hourly'); ?></option>
                <option value="60"><?php echo lang('Hourly'); ?></option>
                <option value="1440"><?php echo lang('Daily'); ?></option>
                <option value="10080"><?php echo lang('Weekly'); ?></option>
                <option value="40320"><?php echo lang('Monthly'); ?></option>
            </select>
            &nbsp;&nbsp;&nbsp;
            <span id="date-range-temperature-chart">
                <i class="fa fa-calendar fa-lg"></i>
                <span><?php echo date(lang('php_short_date_format'), strtotime('now')); ?> - <?php echo date(lang('php_short_date_format')); ?></span> <i class="caret"></i>
            </span>
            &nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-default btn-xs" onclick="window.tempchart.reload();"><i class="fa fa-refresh fa-lg"></i></button>
        </div>

    </div>
    <div class="panel-body">
        <svg id="sensors-temperature-line-chart" style="height: 600px;" />
    </div>
</div>

<script>
    $(document).ready(function() {

        var MYSQL_DATETIME_FORMAT = "YYYY-MM-DD HH:mm:ss";

        window.tempchart = {};
        window.tempchart.daterange_start = moment().startOf('day').format(MYSQL_DATETIME_FORMAT);
        window.tempchart.daterange_end = moment().format(MYSQL_DATETIME_FORMAT);
        window.tempchart.aggregation_level = 30;

        window.tempchart.reload = function reload_chart() {
            nv.addGraph(function() {
                var chart = nv.models.lineChart()
                        .xScale(d3.time.scale());

                chart.xAxis
                        .axisLabel('<?php echo lang('Time') ?>')
                        .tickFormat(function(d) {
                            return d3.time.format('<?php echo lang('d3js_long_date_format'); ?>')(new Date(d))
                        });

                chart.yAxis
                        .axisLabel('<?php echo lang('Temperature') ?>');

                d3.select("#sensors-temperature-line-chart")
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
        };

        function get_chart_data() {
            var lines = [];
            $.ajax({
                url: '<?php echo base_url('api/common/get_data/sensors') ?>',
                dataType: 'json',
                async: false,
                success: function(sensorsResponse) {
                    $.each(sensorsResponse.data, function(i) {
                        var line = {key: sensorsResponse.data[i].name, values: []};
                        var query = "SELECT sensor_id, timestamp, TRUNCATE(AVG(temperature), 1) as temperature FROM sensors_history WHERE sensor_id = " + sensorsResponse.data[i].id + " AND timestamp BETWEEN '" + window.tempchart.daterange_start + "' AND '" + window.tempchart.daterange_end + "' GROUP BY sensor_id, (60 / " + window.tempchart.aggregation_level + ") * HOUR(timestamp) %2B FLOOR(MINUTE(timestamp) / " + window.tempchart.aggregation_level + ") ORDER BY timestamp";
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
                                        y: parseFloat(sensorsHistoryResponse.data[ii].temperature)
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

        $('#date-range-temperature-chart').daterangepicker({
            ranges: {
                '<?php echo lang('Today'); ?>': [moment(), moment()],
                '<?php echo lang('Yesterday'); ?>': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        '<?php echo lang('Last Week'); ?>': [moment().subtract('days', 6), moment()],
                        '<?php echo lang('This Month'); ?>': [moment().startOf('month'), moment().endOf('month')],
                        '<?php echo lang('Last Month'); ?>': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            startDate: Date.parse(window.tempchart.daterange_start),
            endDate: Date.parse(window.tempchart.daterange_end),
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
            $('#date-range-temperature-chart span').html(start.format('<?php echo lang('js_short_date_format'); ?>') + ' - ' + end.format('<?php echo lang('js_short_date_format'); ?>'));
            window.tempchart.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
            window.tempchart.daterange_end = end.format(MYSQL_DATETIME_FORMAT);
        }
        );

        setTimeout(function() {
            window.tempchart.reload();
        }, 0);
    });
</script>