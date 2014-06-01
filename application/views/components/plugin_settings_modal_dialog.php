<div class="modal fade" id="plugin-settings-<?php echo $plugin->id; ?>" tabindex="-1" role="dialog" aria-labelledby="plugin-settings-<?php echo $plugin->id; ?>-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="plugin-settings-<?php echo $plugin->id; ?>-label"><?php echo lang('Plugin settings for') . ' ' . $plugin->pluginReadableName; ?>
                    <small>by <a href="<?php echo $plugin->authorWebsite; ?>" target="_blank"><?php echo $plugin->authorName; ?></a></small>
                </h4>
                <p class="text-muted"><?php echo $plugin->pluginDescription; ?></p>
            </div>
            <form class="ajax-settings-form" role="form" action="<?php echo base_url('settings/save'); ?>" method="post" name="save">
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#plugin-common-<?php echo $plugin->id; ?>" data-toggle="tab"><?php echo lang('Settings'); ?></a></li>
                        <li><a href="#plugin-device-mapping-<?php echo $plugin->id; ?>" data-toggle="tab"><?php echo lang('Device mapping'); ?></a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="plugin-common-<?php echo $plugin->id; ?>">
                            <br>
                            <?php foreach ($plugin->settings as $setting) : ?>
                                <div class="form-group">
                                    <label><?php echo $setting['readableName']; ?></label>
                                    <input name="<?php echo $setting['key']; ?>" value="<?php echo get_setting($setting['key']); ?>" class="form-control">
                                    <p class="help-block"><?php echo $setting['helpText']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="tab-pane fade" id="plugin-device-mapping-<?php echo $plugin->id; ?>">
                            <br>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>LiHoCoS <?php echo lang('Devices'); ?></th>
                                        <th><?php echo $plugin->pluginReadableName . ' ' . lang('Devices'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($devices as $device) : ?>
                                        <tr>
                                            <td><?php echo $device->get_display_name(); ?></td>
                                            <td>
                                                <select name="plugin_reference-<?php echo get_class($device) . '-' . $device->id; ?>" data-selected="<?php echo $device->plugin_reference; ?>" class="form-control plugin-select">
                                                    <?php if ($pluginDevices) : ?>
                                                        <?php foreach ($pluginDevices as $pluginDevice) : ?>
                                                            <option value="<?php echo $pluginDevice[0]; ?>"><?php echo $pluginDevice[1]; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo lang('Save'); ?></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>

    $(document).ready(function() {
        $('.ajax-settings-form').ajaxForm(function() {
            $('#plugin-settings-<?php echo $plugin->id; ?>').modal('hide');
        });
    });

</script>