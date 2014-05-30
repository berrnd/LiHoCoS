<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Lights'); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 120px;">#</th>
                    <th><?php echo lang('Name'); ?></th>
                    <th><?php echo lang('Room'); ?></th>
                    <th><?php echo lang('State'); ?></th>
                    <th><?php echo lang('Last changed'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lights as $light) : ?>
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button data-success-message="<?php echo lang('Successfully controlled light'); ?>" data-error-message="<?php echo lang('Light could not be controlled'); ?>" data-url="<?php echo base_url('plugin/switch_light/' . $light->id . '/1'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-play"></i></button>
                                <button data-success-message="<?php echo lang('Successfully controlled light'); ?>" data-error-message="<?php echo lang('Light could not be controlled'); ?>" data-url="<?php echo base_url('plugin/switch_light/' . $light->id . '/0'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-off"></i></button>
                            </div>
                        </td>
                        <td><?php echo $light->name ?></td>
                        <td><?php echo $light->get_room_name(); ?></td>
                        <td><?php echo $light->get_display_state(); ?></td>
                        <td>
                            <span data-timestamp="<?php echo $light->last_change ?>" class="moment"></span><br />
                            <code><?php echo timestamp_to_date_time_string_iso(strtotime($light->last_change)); ?></code>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>