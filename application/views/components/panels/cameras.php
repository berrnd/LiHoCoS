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

                        <button onclick="camera_play('camera-img-<?php echo $camera->id; ?>')" type="button" class="btn btn-default"><i class="glyphicon glyphicon-play"></i></button>
                        <button onclick="camera_stop('camera-img-<?php echo $camera->id; ?>')" type="button" class="btn btn-default"><i class="glyphicon glyphicon-stop"></i></button>
                    </h4>

                    <img id="camera-img-<?php echo $camera->id; ?>" width="100%" height="100%" class="img-responsive img-rounded auto-reload" data-src-base64="<?php echo base_url('api/cameras/snapshot/' . $camera->id); ?>?base64=true" src="<?php echo base_url('api/cameras/snapshot/' . $camera->id); ?>" />
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
            var img = $('#' + imageId);
            var imgUrl = img.data('src-base64');

            $.ajax({
                url: imgUrl,
                type: 'GET',
                success: function(data, textStatus, request) {
                    var serverTime = request.getResponseHeader('X-Server-Time')
                    img.attr('src', 'data:image/jpg;base64,' + data);
                    img.prev().children('small').children('.camera-timestamp').text(serverTime);
                }
            });

        }, 1000);
    }

    function camera_stop(imageId) {
        window.clearInterval(imgReloadIntervals[imageId]);
    }

</script>