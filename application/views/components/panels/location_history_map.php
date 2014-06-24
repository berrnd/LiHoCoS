<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Location History'); ?></span>
        <div class="pull-right">
            <button style="margin-right: 5px;" type="button" class="btn btn-default btn-xs" onclick="window.lhmap.moveDateRange(true);"><i class="fa fa-backward"></i></button>
            <span id="date-range-location-history-map">
                <i class="fa fa-calendar fa-lg"></i>
                <span></span> <i class="caret"></i>
            </span>
            <button style="margin-left: 5px;" type="button" class="btn btn-default btn-xs" onclick="window.lhmap.moveDateRange(false);"><i class="fa fa-forward"></i></button>
            <button style="margin-left: 10px;" type="button" class="btn btn-default btn-xs" onclick="window.lhmap.reload();"><i class="fa fa-refresh"></i></button>
        </div>
    </div>
    <div class="panel-body">
        <div id="location-history-map" style="height: 600px;"></div>
    </div>
</div>

<script>

    window.lhmap = {};
    window.lhmap.daterange_start = moment().subtract('days', 1).startOf('day').format(MYSQL_DATETIME_FORMAT);
    window.lhmap.daterange_end = moment().subtract('days', 1).endOf('day').format(MYSQL_DATETIME_FORMAT);

    window.lhmap.reload = function() {
        window.lhmap.clear();

        var query = "SELECT * FROM location_history WHERE timestamp BETWEEN '" + window.lhmap.daterange_start + "' AND '" + window.lhmap.daterange_end + "' ORDER BY timestamp";
        var coordinates = [];
        $.ajax({
            url: '<?php echo base_url('api/common/get_data/location_history') ?>',
            dataType: 'json',
            type: 'POST',
            data: {'custom-select': query},
            async: false,
            success: function(locationHistoryResponse) {
                $.each(locationHistoryResponse.data, function(i) {
                    latlng = new L.latLng(locationHistoryResponse.data[i].latitude, locationHistoryResponse.data[i].longitude);
                    coordinates.push(latlng);
                    L.marker(latlng)
                            .bindLabel(moment(locationHistoryResponse.data[i].timestamp).format('<?php echo lang('js_long_date_format'); ?>'))
                            .addTo(window.lhmap.map);
                });
            }
        });

        var polyline = L.polyline(coordinates, {
            color: 'red'
        }).addTo(window.lhmap.map);

        window.lhmap.map.fitBounds(polyline.getBounds());
    }

    $('#date-range-location-history-map').daterangepicker({
        ranges: {
            '<?php echo lang('Today'); ?>': [moment(), moment()],
            '<?php echo lang('Yesterday'); ?>': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    '<?php echo lang('Last Week'); ?>': [moment().subtract('days', 6), moment()],
                    '<?php echo lang('This Month'); ?>': [moment().startOf('month'), moment().endOf('month')],
                    '<?php echo lang('Last Month'); ?>': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        startDate: Date.parse(window.lhmap.daterange_start),
        endDate: Date.parse(window.lhmap.daterange_end),
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
        window.lhmap.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
        window.lhmap.daterange_end = end.format(MYSQL_DATETIME_FORMAT);
        window.lhmap.displayDateRange();
    }
    );

    window.lhmap.clear = function() {
        for (i in window.lhmap.map._layers) {
            if (window.lhmap.map._layers[i]._path != undefined) {
                try {
                    window.lhmap.map.removeLayer(window.lhmap.map._layers[i]);
                }
                catch (e) {
                    console.log("Error removing layer path " + e + window.lhmap.map._layers[i]);
                }
            }
        }
    }

    window.lhmap.displayDateRange = function() {
        $('#date-range-location-history-map span').html(moment(window.lhmap.daterange_start).format('<?php echo lang('js_short_date_format'); ?>') + ' - ' + moment(window.lhmap.daterange_end).format('<?php echo lang('js_short_date_format'); ?>'));
    }

    window.lhmap.moveDateRange = function(backwards) {
        var start = moment(window.lhmap.daterange_start);
        var end = moment(window.lhmap.daterange_end);
        var days = end.diff(start, 'days');

        if (days == 0)
            days = 1;

        if (backwards)
            days = days * -1;

        start.add('days', days);
        end.add('days', days);
        window.lhmap.daterange_start = start.format(MYSQL_DATETIME_FORMAT);
        window.lhmap.daterange_end = end.format(MYSQL_DATETIME_FORMAT);

        window.lhmap.displayDateRange();
        window.lhmap.reload();
    }

    $(document).ready(function() {
        window.lhmap.map = L.map('location-history-map');

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a target="_blank" href="http://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(window.lhmap.map);

        var homeLocation = new L.LatLng(<?php echo get_setting(KnownSettings::HOME_LATITUDE); ?>, <?php echo get_setting(KnownSettings::HOME_LONGITUDE); ?>);
        window.lhmap.map.setView(homeLocation, 12);

        window.lhmap.displayDateRange();
        window.lhmap.reload();
    });

</script>
