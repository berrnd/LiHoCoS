<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Sensors'); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><?php echo lang('Room'); ?></th>
                    <th><?php echo lang('Temperature'); ?></th>
                    <th><?php echo lang('Relative humidity'); ?></th>
                    <th><?php echo lang('Last changed'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sensors as $sensor) : ?>
                    <tr>
                        <td><?php echo $sensor->get_room_name(); ?></td>
                        <td><?php echo round($sensor->temperature, 1) ?> °C</td>
                        <td><?php echo round($sensor->relative_humidity, 0) ?> %</td>
                        <td>
                            <span data-timestamp="<?php echo $sensor->last_change ?>" class="moment"></span><br />
                            <code><?php echo format_datetime_user_defined($sensor->last_change); ?></code>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>