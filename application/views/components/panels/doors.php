<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Doors'); ?></h3>
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
                <?php foreach ($doors as $door) : ?>
                    <tr>
                        <td><?php echo $door->name ?></td>
                        <td><?php echo $door->get_room_name(); ?></td>
                        <td><?php echo $door->get_display_state(); ?></td>
                        <td>
                            <span data-timestamp="<?php echo $door->last_change ?>" class="moment"></span><br />
                            <code><?php echo format_datetime_user_defined($door->last_change); ?></code>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>