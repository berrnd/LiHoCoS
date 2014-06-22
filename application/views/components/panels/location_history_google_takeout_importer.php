<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Import Location History from Google Takeout'); ?></span>
    </div>
    <div class="panel-body">
        <form id="import-form" role="form">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo lang('Max. Date'); ?></label>
                <p class="help-block"><?php echo lang('Location points will be imported including this date'); ?></p>
                <input id="import-max-date" type="date" class="form-control">
            </div>
            <div class="form-group">
                <input type="file" id="file" name="file[]" />
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input id="import-as-sql" type="checkbox" value="">
                        <?php echo lang('Import as SQL'); ?>
                    </label>
                </div>
                <p class="help-block"><?php echo lang('If checked, you get a SQL statement with which you can import the location points directly into the database.'); ?></p>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default"><?php echo lang('Start Import'); ?></button>
                <p class="help-block"><?php echo lang('If you have a big file, this could take long - just wait until "Ready" shows up.'); ?></p>
            </div>
        </form>
        <code id="import-status"></code>
        <div id="import-ready-info" class="bs-callout bs-callout-info"><?php echo lang('Ready'); ?></div>
        <textarea id="import-sql-output" class="form-control" rows="10"></textarea>
    </div>
</div>

<script>

    var MYSQL_DATETIME_FORMAT = "YYYY-MM-DD HH:mm:ss";

    $("#import-form").submit(function(event) {
        event.preventDefault();

        var of = '<?php echo lang('of'); ?>';
        var imported = '<?php echo lang('imported'); ?>';
        var importAsSql = $('#import-as-sql').is(':checked');
        $('#import-status').show();

        var files = document.getElementById('file').files;
        var file = files[0];
        var fileReader = new FileReader();

        fileReader.onload = (function(f) {
            return function(e) {
                var json = JSON.parse(e.target.result);
                var locationCount = Object.keys(json.locations).length;
                var importedCount = 0;
                var maxImportDate = moment($('#import-max-date').val());
                maxImportDate.hour(23);
                maxImportDate.minute(59);
                maxImportDate.second(59);
                var sql = '';

                $.each(json.locations, function(i) {
                    var timestamp = moment.unix(json.locations[i].timestampMs / 1000);
                    var latitude = json.locations[i].latitudeE7 / 10000000;
                    var longitude = json.locations[i].longitudeE7 / 10000000;
                    var accuracy = json.locations[i].accuracy;

                    if (timestamp.isBefore(maxImportDate)) {
                        importedCount++;

                        if (importAsSql) {
                            sql += "INSERT INTO location_history (timestamp, latitude, longitude, accuracy) VALUES ('" + timestamp.format(MYSQL_DATETIME_FORMAT) + "', " + latitude + ", " + longitude + ", " + accuracy + ");\n";
                        }
                        else {
                            $.ajax({
                                url: '<?php echo base_url('api/location_history/add_data_point') ?>',
                                dataType: 'json',
                                type: 'POST',
                                data: {'timestamp': timestamp.format(MYSQL_DATETIME_FORMAT), 'latitude': latitude, 'longitude': longitude, 'accuracy': accuracy},
                                async: false,
                                success: function(response) {
                                    $('#import-status').text(importedCount++ + ' ' + of + ' ' + locationCount + ' ' + imported);
                                }
                            });
                        }
                    }
                });

                if (importAsSql) {
                    $('#import-sql-output').val(sql);
                    $('#import-status').hide();
                    $('#import-sql-output').show();
                }

                $('#import-ready-info').show();
            };
        })(file);

        fileReader.readAsText(file);
    });

    $(document).ready(function() {
        $('#import-status').hide();
        $('#import-ready-info').hide();
        $('#import-sql-output').hide();
        $('#import-max-date').val(new Date().toJSON().slice(0, 10));
    });

    $('#import-sql-output').click(function() {
        $(this).select();
    });

</script>
