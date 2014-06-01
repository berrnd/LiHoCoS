<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Computers'); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 80px;">#</th>
                    <th><?php echo lang('Name'); ?></th>
                    <th><?php echo lang('FQDN'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($computers as $computer) : ?>
                    <tr>
                        <td>
                            <button data-success-message="<?php echo lang('Successfully controlled computer'); ?>" data-error-message="<?php echo lang('Computer could not be controlled'); ?>" data-url="<?php echo base_url('api/computers/wake/' . $computer->id); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-off"></i></button>
                        </td>
                        <td><?php echo $computer->name; ?></td>
                        <td><?php echo $computer->fqdn; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>