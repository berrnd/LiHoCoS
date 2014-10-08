<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Computer traffic'); ?></span>
        <div class="pull-right">
            <button style="margin-right: 5px;" type="button" class="btn btn-default btn-xs" onclick="window.ctchart.moveDateRange(true);"><i class="fa fa-backward"></i></button>
            <span id="date-range-computers-traffic-chart">
                <i class="fa fa-calendar"></i>
                <span></span> <i class="caret"></i>
            </span>
            <button style="margin-left: 5px;" type="button" class="btn btn-default btn-xs" onclick="window.ctchart.moveDateRange(false);"><i class="fa fa-forward"></i></button>
            <button style="margin-left: 10px;" type="button" class="btn btn-default btn-xs" onclick="window.ctchart.reload();"><i class="fa fa-refresh"></i></button>
        </div>

    </div>
    <div class="panel-body">
        <div id="computers-traffic-line-chart"></div>
    </div>
</div>

<script>

    window.ctchart = {};
    window.ctchart.daterange_start = moment().subtract(1, 'months').startOf('day').format(MYSQL_DATETIME_FORMAT);
    window.ctchart.daterange_end = moment().format(MYSQL_DATETIME_FORMAT);
    window.ctchart.aggregation_level = 30;
    window.ctchart.reload = function () {
        window.ctchart.chart = c3.generate({
            bindto: '#computers-traffic-line-chart',
            data: {
                x: 'x',
                xFormat: '%Y-%m-%d',
                columns: window.ctchart.getData(),
            },
            axis: {
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '<?php echo lang('c3js_short_date_format'); ?>',
                        count: 100,
                        rotate: 75
                    },
                    height: 110
                },
                y: {
                    label: {
                        text: 'MB',
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
    window.ctchart.getData = function () {
        var computers = [];
        var x = [];
        x.push('x');
        $.ajax({
            url: '<?php echo base_url('api/common/get_data/computers') ?>',
            dataType: 'json',
            async: false,
            success: function (computersResponse) {
                $.each(computersResponse.data, function (i) {
                    var computer = [];
                    computer.push(computersResponse.data[i].name);
                    var query = "SELECT date, bytes_in, bytes_out FROM computers_traffic WHERE computer_id = " + computersResponse.data[i].id + " AND date BETWEEN '" + window.ctchart.daterange_start + "' AND '" + window.ctchart.daterange_end + "' ORDER BY date";
                    $.ajax({
                        url: '<?php echo base_url('api/common/get_data/computers_traffic') ?>',
                        dataType: 'json',
                        type: 'POST',
                        data: {'custom-select': query},
                        async: false,
                        success: function (computersTrafficResponse) {
                            $.each(computersTrafficResponse.data, function (ii) {
                                var mbIn = Math.round(parseInt(computersTrafficResponse.data[ii].bytes_in) / 100000);
                                var mbOut = Math.round(parseInt(computersTrafficResponse.data[ii].bytes_out) / 100000);
                                computer.push(mbIn + mbOut);
                                x.push(computersTrafficResponse.data[ii].date);
                            });
                        }
                    });
                    computers.push(computer);
                });
            }
        });
        computers.push(x);
        return computers;
    }

    $('#date-range-computers-traffic-chart').daterangepicker({
        ranges: {
            '<?php echo lang('Today'); ?>': [moment(), moment()],
            '<?php echo lang('Yesterday'); ?>': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    '<?php echo lang('Last Week'); ?>': [moment().subtract('days', 6), moment()],
                    '<?php echo lang('This Month'); ?>': [moment().startOf('month'), moment().endOf('month')],
                    '<?php echo lang('Last Month'); ?>': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        startDate: Date.parse(window.ctchart.daterange_start),
        endDate: Date.parse(window.ctchart.daterange_end),
        maxDate: new Date(),
        showDropdowns: true,
        format: '<?php echo lang('js_short_date_format'); ?>',
        locale: {
            fromLabel: '<?php echo lang('From'); ?>',
            toLabel: '<?php echo lang('To'); ?>',
            applyLabel: '<?php echo lang('Apply'); ?>',
            cancelLabel: '<?php echo lang('Cancel'); ?>'
        }
    }, function (start, end) {
        window.ctchart.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
        window.ctchart.daterange_end = end.format(MYSQL_DATETIME_FORMAT);
        window.ctchart.displayDateRange();
    }
    );
    window.ctchart.displayDateRange = function () {
        $('#date-range-computers-traffic-chart span').html(moment(window.ctchart.daterange_start).format('<?php echo lang('js_short_date_format'); ?>') + ' - ' + moment(window.ctchart.daterange_end).format('<?php echo lang('js_short_date_format'); ?>'));
    }

    window.ctchart.moveDateRange = function (backwards) {
        var start = moment(window.ctchart.daterange_start);
        var end = moment(window.ctchart.daterange_end);
        var days = end.diff(start, 'days');
        if (days == 0)
            days = 1;
        if (backwards)
            days = days * -1;
        start.add('days', days);
        end.add('days', days);
        window.ctchart.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
        window.ctchart.daterange_end = end.format(MYSQL_DATETIME_FORMAT);
        window.ctchart.displayDateRange();
        window.ctchart.reload();
    }

    $(document).ready(function () {
        window.ctchart.displayDateRange();
        window.ctchart.reload();
    });

</script>