<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Computers'); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo lang('Name'); ?></th>
                    <th><?php echo lang('FQDN'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($computers as $computer) : ?>
                    <tr>
                        <td style="min-width: 50px;">
                            <button data-success-message="<?php echo lang('Successfully controlled computer'); ?>" data-error-message="<?php echo lang('Computer could not be controlled'); ?>" data-url="<?php echo base_url('plugin/computer_action/' . $computer->id . '/wake'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-off"></i></button>
                        </td>
                        <td><?php echo $computer->name; ?></td>
                        <td><?php echo $computer->fqdn; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>