<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_default'); ?>

<div id="page-content">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#blinds" data-toggle="tab"><?php echo lang('Blinds'); ?></a></li>
        <li><a href="#cameras" data-toggle="tab"><?php echo lang('Cameras'); ?></a></li>
        <li><a href="#computers" data-toggle="tab"><?php echo lang('Computers'); ?></a></li>
        <li><a href="#doors" data-toggle="tab"><?php echo lang('Doors'); ?></a></li>
        <li><a href="#lights" data-toggle="tab"><?php echo lang('Lights'); ?></a></li>
        <li><a href="#sensors" data-toggle="tab"><?php echo lang('Sensors'); ?></a></li>
        <li><a href="#windows" data-toggle="tab"><?php echo lang('Windows'); ?></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="blinds">
            <h4><?php echo lang('Blinds'); ?></h4>
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
                            <td style="width: 10%;">
                                <div class="btn-group">
                                    <button data-success-message="<?php echo lang('Successfully controlled blind'); ?>" data-error-message="<?php echo lang('Blind could not be controlled'); ?>" data-url="<?php echo base_url('plugin/set_blind_position/' . $blind->id . '/0'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-arrow-up"></i></button>
                                    <button data-success-message="<?php echo lang('Successfully controlled blind'); ?>" data-error-message="<?php echo lang('Blind could not be controlled'); ?>" data-url="<?php echo base_url('plugin/set_blind_position/' . $blind->id . '/100'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-arrow-down"></i></button>
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
        <div class="tab-pane fade" id="cameras">
            <h4><?php echo lang('Cameras'); ?></h4>
            <div class="row">
                <?php foreach ($cameras as $camera) : ?>
                    <div class="col-md-4">
                        <h4><?php echo $camera->name; ?></h4>
                        <img width="100%" height="100%" class="img-responsive img-rounded" src="<?php echo base_url('api/camera_stream/' . $camera->id); ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="computers">
            <h4><?php echo lang('Computers'); ?></h4>
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
                            <td style="width: 18%;">
                                <button data-success-message="<?php echo lang('Successfully controlled computer'); ?>" data-error-message="<?php echo lang('Computer could not be controlled'); ?>" data-url="<?php echo base_url('plugin/computer_action/' . $computer->id . '/wake'); ?>" type="button" class="btn btn-default action-button"><i class="glyphicon glyphicon-off"></i></button>
                            </td>
                            <td><?php echo $computer->name; ?></td>
                            <td><?php echo $computer->fqdn; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="doors">
            <h4><?php echo lang('Doors'); ?></h4>
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
                                <code><?php echo timestamp_to_date_time_string_iso(strtotime($door->last_change)); ?></code>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="lights">
            <h4><?php echo lang('Lights'); ?></h4>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo lang('Name'); ?></th>
                        <th><?php echo lang('Room'); ?></th>
                        <th><?php echo lang('State'); ?></th>
                        <th><?php echo lang('Last changed'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lights as $light) : ?>
                        <tr>
                            <td style="width: 10%;">
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
        <div class="tab-pane fade" id="sensors">
            <h4><?php echo lang('Sensors'); ?></h4>
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
                            <td><?php echo $sensor->temperature ?></td>
                            <td><?php echo $sensor->relative_humidity ?></td>
                            <td>
                                <span data-timestamp="<?php echo $sensor->last_change ?>" class="moment"></span><br />
                                <code><?php echo timestamp_to_date_time_string_iso(strtotime($sensor->last_change)); ?></code>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="windows">
            <h4><?php echo lang('Windows'); ?></h4>
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
</div>

<script>
    $(document).ready(function() {

        $('.action-button').click(function() {
            var url = $(this).data('url');
            var successMessage = $(this).data('success-message');
            var errorMessage = $(this).data('error-message');

            $.ajax({
                url: url,
                type: 'POST',
                success: function() {
                    toastr['success'](successMessage, '<?php echo lang('Success'); ?>');
                },
                error: function(xhr, status, error) {
                    toastr['error'](errorMessage + '\n' + xhr.responseText, '<?php echo lang('Error'); ?>');
                }
            });

        });

        //Initalize toastr

        toastr.options = {
            'closeButton': true,
            'debug': false,
            'positionClass': 'toast-bottom-full-width',
            'onclick': null,
            'showDuration': '300',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        }

    });

</script>

<?php $this->load->view('layout/footer_default'); ?>
<?php $this->load->view('layout/footer_footer'); ?>