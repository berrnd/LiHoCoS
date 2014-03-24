<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Windows'); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><?php echo lang('Name'); ?></th>
                    <th><?php echo lang('Room'); ?></th>
                    <th><?php echo lang('State'); ?></th>
                    <th><?php echo lang('Last changed'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($windows as $window) : ?>
                    <tr>
                        <td><?php echo $window->name ?></td>
                        <td><?php echo $window->get_room_name(); ?></td>
                        <td><?php echo $window->get_display_state(); ?></td>
                        <td>
                            <span data-timestamp="<?php echo $window->last_change ?>" class="moment"></span><br />
                            <code><?php echo timestamp_to_date_time_string_iso(strtotime($window->last_change)); ?></code>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>