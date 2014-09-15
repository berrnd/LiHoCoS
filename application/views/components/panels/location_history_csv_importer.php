<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Import Location History from CSV'); ?></span>
    </div>
    <div class="panel-body">
        <form id="import-form-lhcsv" role="form">
            <div class="form-group">
                <p class="help-block"><?php echo lang('A CSV line should look like this'); ?>:</p>
                <p><code><?php echo htmlentities('<ParsableDateTime>,<Latitude>,<Longitude>,<Accuracy>'); ?></code></p>
                <input type="file" id="file-lhcsv" name="file-lhcsv[]" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default"><?php echo lang('Start Import'); ?></button>
                <p class="help-block"><?php echo lang('If you have a big file, this could take long - just wait until "Ready" shows up.'); ?></p>
            </div>
        </form>
        <code id="import-status-lhcsv"></code>
        <div id="import-ready-info-lhcsv" class="bs-callout bs-callout-info"><?php echo lang('Ready'); ?></div>
    </div>
</div>

<script>

    $("#import-form-lhcsv").submit(function(event) {
        event.preventDefault();

        var imported = '<?php echo lang('imported'); ?>';
        var of = '<?php echo lang('of'); ?>';
        $('#import-status-lhcsv').show();

        var files = document.getElementById('file-lhcsv').files;
        var file = files[0];
        var fileReader = new FileReader();
        var importedCount = 0;

        fileReader.onload = (function(f) {
            return function(e) {
                var csv = e.target.result;
                var lines = csv.split("\r\n");

                $.each(lines, function(i) {
                    var lineParts = lines[i].split(",");
                    var timestamp = moment(lineParts[0]);
                    var latitude = lineParts[1];
                    var longitude = lineParts[2];
                    var accuracy = lineParts[3];

                    $.ajax({
                        url: '<?php echo base_url('api/location_history/add_data_point') ?>',
                        dataType: 'json',
                        type: 'POST',
                        data: {'timestamp': timestamp.format(MYSQL_DATETIME_FORMAT), 'latitude': latitude, 'longitude': longitude, 'accuracy': accuracy},
                        success: function(response) {
                            importedCount++;
                        },
                        complete: function(response) {
                            $('#import-status-lhcsv').text(importedCount + ' ' + of + ' ' + lines.length + ' ' + imported);
                        }
                    });

                    //On last item
                    if (i == lines.length - 1) {
                        $('#import-ready-info-lhcsv').show();
                    }
                });
            };
        })(file);

        fileReader.readAsText(file);
    });
    $(document).ready(function() {
        $('#import-status-lhcsv').hide();
        $('#import-ready-info-lhcsv').hide();
    });

</script>
