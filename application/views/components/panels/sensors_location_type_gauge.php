<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Sensors Gauge'); ?></h3>
    </div>
    <div class="panel-body">
        <div id="sensors-gauge-temperature">
            <p class="text-info text-center"><?php echo lang('Temperature'); ?> °C</p>
            <p class="text-center"><?php echo lang('Inside'); ?> <span id="sensors-gauge-temperature-inside" class="text-little-bit-bigger text-bold"></span> / <?php echo lang('Outside'); ?> <span id="sensors-gauge-temperature-outside" class="text-little-bit-bigger text-bold"></span></p>
        </div>
        <div id="sensors-gauge-humidty">
            <p class="text-info text-center"><?php echo lang('Humidity'); ?> %</p>
            <p class="text-center"><?php echo lang('Inside'); ?> <span id="sensors-gauge-humidity-inside" class="text-little-bit-bigger text-bold"></span> / <?php echo lang('Outside'); ?> <span id="sensors-gauge-humidity-outside" class="text-little-bit-bigger text-bold"></span></p>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {

        var query = "SELECT location_type, AVG(temperature) AS temperature, AVG(relative_humidity) AS relative_humidity FROM sensors GROUP BY location_type";
        $.ajax({
            url: '<?php echo base_url('api/common/get_data/sensors') ?>',
            dataType: 'json',
            type: 'POST',
            data: {'custom-select': query},
            async: false,
            success: function(sensorsResponse) {
                $.each(sensorsResponse.data, function(i) {
                    var locationType = sensorsResponse.data[i].location_type;
                    var temperature = parseFloat(sensorsResponse.data[i].temperature);
                    var relativeHumidity = parseFloat(sensorsResponse.data[i].relative_humidity);

                    if (locationType == 'INSIDE') {
                        $('#sensors-gauge-temperature-inside').text(temperature);
                        $('#sensors-gauge-humidity-inside').text(relativeHumidity);
                    }

                    if (locationType == 'OUTSIDE') {
                        $('#sensors-gauge-temperature-outside').text(temperature);
                        $('#sensors-gauge-humidity-outside').text(relativeHumidity);
                    }
                });
            }
        });

    });

</script>