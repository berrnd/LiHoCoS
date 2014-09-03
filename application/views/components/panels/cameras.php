<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Cameras'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php foreach ($cameras as $camera) : ?>
                <div class="col-md-4">
                    <h4>
                        <?php echo $camera->name; ?>
                        <small><code class="camera-timestamp"><?php echo format_datetime_user_defined(mysql_now()); ?></code></small>

                        <button id="camera-play-button-<?php echo $camera->id; ?>" onclick="camera_play('camera-img-<?php echo $camera->id; ?>')" type="button" class="btn btn-default"><i class="glyphicon glyphicon-play"></i></button>
                        <button id="camera-stop-button-<?php echo $camera->id; ?>" onclick="camera_stop('camera-img-<?php echo $camera->id; ?>')" type="button" class="btn btn-default"><i class="glyphicon glyphicon-stop"></i></button>
                    </h4>

                    <img id="camera-img-<?php echo $camera->id; ?>" data-camera-id="<?php echo $camera->id; ?>" width="100%" height="100%" class="img-responsive img-rounded auto-reload" data-src-base64="<?php echo base_url('api/cameras/snapshot/' . $camera->id); ?>?base64=true" />
                    <div id="camera-unavailable-<?php echo $camera->id; ?>">
                        <p class="bs-callout bs-callout-danger">Camera unavailable</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>

    //Reload camera images every second

    var imgReloadIntervals = new Array();

    function camera_play(imageId) {
        imgReloadIntervals[imageId] = window.setInterval(function() {
            camera_refresh(imageId);
        }, 1000);
    }

    function camera_refresh(imageId) {
        var img = $('#' + imageId);
        var imgUrl = img.data('src-base64');
        var cameraId = img.data('camera-id');

        $.ajax({
            url: imgUrl,
            type: 'GET',
            success: function(data, textStatus, request) {
                var serverTime = request.getResponseHeader('X-Server-Time')
                img.attr('src', 'data:image/jpg;base64,' + data);
                img.prev().children('small').children('.camera-timestamp').text(serverTime);
                $('#camera-unavailable-' + cameraId).hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                img.remove();
                $('#camera-unavailable-' + cameraId).show();
                $('#camera-play-button-' + cameraId).addClass('disabled');
                $('#camera-stop-button-' + cameraId).addClass('disabled');
            }
        });
    }

    function camera_stop(imageId) {
        window.clearInterval(imgReloadIntervals[imageId]);
    }

    $(document).ready(function() {
<?php foreach ($cameras as $camera) : ?>
    <?php echo "camera_refresh('camera-img-$camera->id');"; ?>
<?php endforeach; ?>
    });

</script>