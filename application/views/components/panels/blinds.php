<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Blinds'); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo lang('Name'); ?></th>
                    <th><?php echo lang('Room'); ?></th>
                    <th><?php echo lang('Position'); ?></th>
                    <th><?php echo lang('Last changed'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blinds as $blind) : ?>
                    <tr>
                        <td style="min-width: 100px;">
                            <div class="btn-group">
                                <button data-success-message="<?php echo lang('Successfully controlled blind'); ?>" data-error-message="<?php echo lang('Blind could not be controlled'); ?>" data-url="<?php echo base_url('plugin/set_blind_position/' . $blind->id . '/0'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-arrow-up"></i></button>
                                <button data-success-message="<?php echo lang('Successfully controlled blind'); ?>" data-error-message="<?php echo lang('Blind could not be controlled'); ?>" data-url="<?php echo base_url('plugin/set_blind_position/' . $blind->id . '/100'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-arrow-down"></i></button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo lang('Saved positions'); ?><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php $savedPositions = $blind->get_saved_positions(); ?>
                                        <?php if ($savedPositions) : ?>
                                            <?php foreach ($savedPositions as $savedPosition) : ?>
                                                <li><a data-success-message="<?php echo lang('Successfully controlled blind'); ?>" data-error-message="<?php echo lang('Blind could not be controlled'); ?>" data-url="<?php echo base_url('plugin/set_blind_position/' . $savedPosition->blind_id . '/' . $savedPosition->position); ?>" type="button" class="action-button"><?php echo $savedPosition->name; ?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $blind->name ?></td>
                        <td><?php echo $blind->get_room_name(); ?></td>
                        <td><?php echo $blind->position ?> %</td>
                        <td>
                            <span data-timestamp="<?php echo $blind->last_change ?>" class="moment"></span><br />
                            <code><?php echo timestamp_to_date_time_string_iso(strtotime($blind->last_change)); ?></code>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>