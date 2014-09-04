<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Sensor humidity history'); ?></span>
        <div class="pull-right">
            <label for="aggregation-level-humidity-chart"><?php echo lang('Aggregation level'); ?></label>
            <select style="margin-right: 10px;" data-selected="30" id="aggregation-level-humidity-chart" onChange="window.humchart.aggregation_level = this.options[this.selectedIndex].value;">
                <option value="30"><?php echo lang('Half hourly'); ?></option>
                <option value="60"><?php echo lang('Hourly'); ?></option>
                <option value="1440"><?php echo lang('Daily'); ?></option>
                <option value="10080"><?php echo lang('Weekly'); ?></option>
                <option value="40320"><?php echo lang('Monthly'); ?></option>
            </select>
            <button style="margin-right: 5px;" type="button" class="btn btn-default btn-xs" onclick="window.humchart.moveDateRange(true);"><i class="fa fa-backward"></i></button>
            <span id="date-range-humidity-chart">
                <i class="fa fa-calendar"></i>
                <span></span> <i class="caret"></i>
            </span>
            <button style="margin-left: 5px;" type="button" class="btn btn-default btn-xs" onclick="window.humchart.moveDateRange(false);"><i class="fa fa-forward"></i></button>
            <button style="margin-left: 10px;" type="button" class="btn btn-default btn-xs" onclick="window.humchart.reload();"><i class="fa fa-refresh"></i></button>
        </div>

    </div>
    <div class="panel-body">
        <div id="sensors-humidity-line-chart"></div>
    </div>
</div>

<script>

    window.humchart = {};
    window.humchart.daterange_start = moment().startOf('day').format(MYSQL_DATETIME_FORMAT);
    window.humchart.daterange_end = moment().format(MYSQL_DATETIME_FORMAT);
    window.humchart.aggregation_level = 30;

    window.humchart.reload = function() {
        window.humchart.chart = c3.generate({
            bindto: '#sensors-humidity-line-chart',
            data: {
                x: 'x',
                xFormat: '%Y-%m-%d %H:%M:%S',
                columns: window.humchart.getData(),
            },
            axis: {
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '<?php echo lang('c3js_long_date_format'); ?>',
                        count: 100,
                        rotate: 75
                    },
                    height: 110
                },
                y: {
                    label: {
                        text: '<?php echo lang('Humidity') ?>',
                        position: 'outer-middle'
                    }
                }
            },
            legend: {
                position: 'bottom'
            },
            zoom: {
                enabled: true
            },
            zoom: {
                enabled: true
            },
            size: {
                height: 600
            },
            grid: {
                x: {
                    show: false
                },
                y: {
                    show: true
                }
            }
        });
    };

    window.humchart.getData = function() {
        var sensors = [];
        var x = [];
        x.push('x');
        $.ajax({
            url: '<?php echo base_url('api/common/get_data/sensors') ?>',
            dataType: 'json',
            async: false,
            success: function(sensorsResponse) {
                $.each(sensorsResponse.data, function(i) {
                    var sensor = [];
                    sensor.push(sensorsResponse.data[i].name);
                    var query = "SELECT sensor_id, timestamp, TRUNCATE(AVG(relative_humidity), 1) as relative_humidity FROM sensors_history WHERE sensor_id = " + sensorsResponse.data[i].id + " AND timestamp BETWEEN '" + window.humchart.daterange_start + "' AND '" + window.humchart.daterange_end + "' GROUP BY sensor_id, (60 / " + window.humchart.aggregation_level + ") * HOUR(timestamp) %2B FLOOR(MINUTE(timestamp) / " + window.humchart.aggregation_level + ") ORDER BY timestamp";
                    $.ajax({
                        url: '<?php echo base_url('api/common/get_data/sensors_history') ?>',
                        dataType: 'json',
                        type: 'POST',
                        data: {'custom-select': query},
                        async: false,
                        success: function(sensorsHistoryResponse) {
                            $.each(sensorsHistoryResponse.data, function(ii) {
                                sensor.push(parseFloat(sensorsHistoryResponse.data[ii].relative_humidity));
                                x.push(sensorsHistoryResponse.data[ii].timestamp);
                            });
                        }
                    });
                    sensors.push(sensor);
                });
            }
        });
        sensors.push(x);
        return sensors;
    }

    $('#date-range-humidity-chart').daterangepicker({
        ranges: {
            '<?php echo lang('Today'); ?>': [moment(), moment()],
            '<?php echo lang('Yesterday'); ?>': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    '<?php echo lang('Last Week'); ?>': [moment().subtract('days', 6), moment()],
                    '<?php echo lang('This Month'); ?>': [moment().startOf('month'), moment().endOf('month')],
                    '<?php echo lang('Last Month'); ?>': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        startDate: Date.parse(window.humchart.daterange_start),
        endDate: Date.parse(window.humchart.daterange_end),
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
        window.humchart.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
        window.humchart.daterange_end = end.format(MYSQL_DATETIME_FORMAT);
        window.humchart.displayDateRange();
    }
    );

    window.humchart.displayDateRange = function() {
        $('#date-range-humidity-chart span').html(moment(window.humchart.daterange_start).format('<?php echo lang('js_short_date_format'); ?>') + ' - ' + moment(window.humchart.daterange_end).format('<?php echo lang('js_short_date_format'); ?>'));
    }

    window.humchart.moveDateRange = function(backwards) {
        var start = moment(window.humchart.daterange_start);
        var end = moment(window.humchart.daterange_end);
        var days = end.diff(start, 'days');

        if (days == 0)
            days = 1;

        if (backwards)
            days = days * -1;

        start.add('days', days);
        end.add('days', days);
        window.humchart.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
        window.humchart.daterange_end = end.format(MYSQL_DATETIME_FORMAT);

        window.humchart.displayDateRange();
        window.humchart.reload();
    }

    $(document).ready(function() {
        window.humchart.displayDateRange();
        window.humchart.reload();
    });

</script>