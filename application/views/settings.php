<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_default'); ?>

<div id="page-content">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#system" data-toggle="tab"><?php echo lang('System'); ?></a></li>
        <li><a href="#home" data-toggle="tab"><?php echo lang('Home'); ?></a></li>
    </ul>
    <form id="settings-form" role="form" action="<?php echo base_url('settings/save'); ?>" method="post" name="save">

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="system">
                <br />

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#common" data-toggle="tab"><?php echo lang('Common'); ?></a></li>
                    <li><a href="#plugins" data-toggle="tab"><?php echo lang('Plugins'); ?></a></li>
                    <li><a href="#users" data-toggle="tab"><?php echo lang('Users'); ?></a></li>
                    <li><a href="#advanced-settings" data-toggle="tab"><?php echo lang('Advanced'); ?></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="common">
                        <h4><?php echo lang('Common'); ?></h4>
                        <div class="form-group">
                            <label><?php echo lang('Language'); ?></label>
                            <select name="<?php echo KnownSettings::LANGUAGE; ?>" data-selected="<?php echo get_setting(KnownSettings::LANGUAGE); ?>" class="form-control">
                                <?php foreach (get_available_languages() as $language) : ?>
                                    <option value="<?php echo $language; ?>"><?php echo $language; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Timezone'); ?></label>
                            <select name="<?php echo KnownSettings::TIMEZONE; ?>" data-selected="<?php echo get_setting(KnownSettings::TIMEZONE); ?>" class="form-control">
                                <?php foreach (DateTimeZone::listIdentifiers() as $timezone) : ?>
                                    <option value="<?php echo $timezone; ?>"><?php echo $timezone; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="plugins">
                        <h4><?php echo lang('Plugins'); ?></h4>
                        <div class="form-group">
                            <label><?php echo lang('Blinds'); ?></label>
                            <div class="input-group">
                                <select name="<?php echo KnownSettings::PLUGIN_BLINDS; ?>" data-selected="<?php echo get_setting(KnownSettings::PLUGIN_BLINDS); ?>" class="form-control plugin-select">
                                    <?php foreach ($plugins as $plugin) : ?>
                                        <?php if ($plugin->pluginArea === PluginAreas::BLINDS) : ?>
                                            <option value="<?php echo $plugin->id; ?>"><?php echo $plugin->pluginReadableName; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#plugin-settings-<?php echo get_setting(KnownSettings::PLUGIN_BLINDS); ?>"><?php echo lang('Manage plugin settings'); ?></button>
                                </span >
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Doors'); ?></label>
                            <div class="input-group">
                                <select name="<?php echo KnownSettings::PLUGIN_DOORS; ?>" data-selected="<?php echo get_setting(KnownSettings::PLUGIN_DOORS); ?>" class="form-control plugin-select">
                                    <?php foreach ($plugins as $plugin) : ?>
                                        <?php if ($plugin->pluginArea === PluginAreas::DOORS) : ?>
                                            <option value="<?php echo $plugin->id; ?>"><?php echo $plugin->pluginReadableName; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#plugin-settings-<?php echo get_setting(KnownSettings::PLUGIN_DOORS); ?>"><?php echo lang('Manage plugin settings'); ?></button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Lights'); ?></label>
                            <div class="input-group">
                                <select name="<?php echo KnownSettings::PLUGIN_LIGHTS; ?>" data-selected="<?php echo get_setting(KnownSettings::PLUGIN_LIGHTS); ?>" class="form-control plugin-select">
                                    <?php foreach ($plugins as $plugin) : ?>
                                        <?php if ($plugin->pluginArea === PluginAreas::LIGHTS) : ?>
                                            <option value="<?php echo $plugin->id; ?>"><?php echo $plugin->pluginReadableName; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#plugin-settings-<?php echo get_setting(KnownSettings::PLUGIN_LIGHTS); ?>"><?php echo lang('Manage plugin settings'); ?></button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Sensors'); ?></label>
                            <div class="input-group">
                                <select name="<?php echo KnownSettings::PLUGIN_SENSORS; ?>" data-selected="<?php echo get_setting(KnownSettings::PLUGIN_SENSORS); ?>" class="form-control plugin-select">
                                    <?php foreach ($plugins as $plugin) : ?>
                                        <?php if ($plugin->pluginArea === PluginAreas::SENSORS) : ?>
                                            <option value="<?php echo $plugin->id; ?>"><?php echo $plugin->pluginReadableName; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#plugin-settings-<?php echo get_setting(KnownSettings::PLUGIN_SENSORS); ?>"><?php echo lang('Manage plugin settings'); ?></button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Windows'); ?></label>
                            <div class="input-group">
                                <select name="<?php echo KnownSettings::PLUGIN_WINDOWS; ?>" data-selected="<?php echo get_setting(KnownSettings::PLUGIN_WINDOWS); ?>" class="form-control plugin-select">
                                    <?php foreach ($plugins as $plugin) : ?>
                                        <?php if ($plugin->pluginArea === PluginAreas::WINDOWS) : ?>
                                            <option value="<?php echo $plugin->id; ?>"><?php echo $plugin->pluginReadableName; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#plugin-settings-<?php echo get_setting(KnownSettings::PLUGIN_WINDOWS); ?>"><?php echo lang('Manage plugin settings'); ?></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="users">
                        <h4><?php echo lang('Users'); ?></h4>
                        <p><div id="grid-users" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="advanced-settings">
                        <h4><?php echo lang('Advanced'); ?></h4>
                        <p><div id="grid-advanced_settings" class="grid"></div></p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="home">
                <br />

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#rooms" data-toggle="tab"><?php echo lang('Rooms'); ?></a></li>
                    <li><a href="#blinds" data-toggle="tab"><?php echo lang('Blinds'); ?></a></li>
                    <li><a href="#cameras" data-toggle="tab"><?php echo lang('Cameras'); ?></a></li>
                    <li><a href="#computers" data-toggle="tab"><?php echo lang('Computers'); ?></a></li>
                    <li><a href="#doors" data-toggle="tab"><?php echo lang('Doors'); ?></a></li>
                    <li><a href="#lights" data-toggle="tab"><?php echo lang('Lights'); ?></a></li>
                    <li><a href="#sensors" data-toggle="tab"><?php echo lang('Sensors'); ?></a></li>
                    <li><a href="#windows" data-toggle="tab"><?php echo lang('Windows'); ?></a></li>
                    <li><a href="#macros" data-toggle="tab"><?php echo lang('Macros'); ?></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="rooms">
                        <h4><?php echo lang('Rooms'); ?></h4>
                        <p><div id="grid-rooms" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="blinds">
                        <h4><?php echo lang('Blinds'); ?></h4>
                        <p><div id="grid-blinds" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="cameras">
                        <h4><?php echo lang('Cameras'); ?></h4>
                        <p><div id="grid-cameras" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="computers">
                        <h4><?php echo lang('Computers'); ?></h4>
                        <p><div id="grid-computers" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="doors">
                        <h4><?php echo lang('Doors'); ?></h4>
                        <p><div id="grid-doors" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="lights">
                        <h4><?php echo lang('Lights'); ?></h4>
                        <p><div id="grid-lights" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="sensors">
                        <h4><?php echo lang('Sensors'); ?></h4>
                        <p><div id="grid-sensors" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="windows">
                        <h4><?php echo lang('Windows'); ?></h4>
                        <p><div id="grid-windows" class="grid"></div></p>
                    </div>
                    <div class="tab-pane fade" id="macros">
                        <h4><?php echo lang('Macros'); ?></h4>
                        <p><div id="grid-macros" class="grid"></div></p>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default"><?php echo lang('Save'); ?></button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {

        //System

        $('#grid-users').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/users/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/users/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/users/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/users/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                username: {
                    title: '<?php echo lang('Username'); ?>'
                },
                firstname: {
                    title: '<?php echo lang('Firstname'); ?>'
                },
                lastname: {
                    title: '<?php echo lang('Lastname'); ?>'
                },
                email: {
                    title: '<?php echo lang('E-Mail'); ?>'
                },
                password: {
                    title: '<?php echo lang('Password'); ?>',
                    list: false,
                    type: 'password'
                },
                api_key: {
                    title: '<?php echo lang('API-Key'); ?>',
                    list: false,
                    type: 'password'
                }
            },
            sorting: true,
            defaultSorting: 'username ASC'
        });

        $('#grid-advanced_settings').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/settings/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/settings/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/settings/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/settings/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                value: {
                    title: '<?php echo lang('Value'); ?>'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        //Home

        $('#grid-rooms').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/rooms/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/rooms/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/rooms/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/rooms/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-blinds').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/blinds/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/blinds/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/blinds/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/blinds/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                },
                saved_positions: {
                    title: '<?php echo lang('Saved positions'); ?>',
                    width: '1%',
                    sorting: false,
                    edit: false,
                    create: false,
                    listClass: 'jtable-command-column',
                                        display: function(parentRow) {
                        var $img = $('<i class="glyphicon glyphicon-list"></i>');
                                            $img.click(function() {
                                                $('#grid-blinds').jtable('openChildTable', $img.closest('tr'), {
                                title: parentRow.record.name + ' - <?php echo lang('Saved positions'); ?>',
                                                                actions: {
                                                                    listAction: '<?php echo base_url('settings/ajax_jtable/blind_positions/list-child-table'); ?>' + '?column=blind_id&value=' + parentRow.record.id,
                                    createAction: '<?php echo base_url('settings/ajax_jtable/blind_positions/create'); ?>',
                                    updateAction: '<?php echo base_url('settings/ajax_jtable/blind_positions/update'); ?>',
                                    deleteAction: '<?php echo base_url('settings/ajax_jtable/blind_positions/delete'); ?>'
                                                                },
                                                                fields: {
                                                                    blind_id: {
                                                                        type: 'hidden',
                                                                        defaultValue: parentRow.record.id
                                                                    },
                                                                    id: {
                                        key: true,
                                        list: false
                                    },
                                    name: {
                                        title: '<?php echo lang('Name'); ?>'
                                    },
                                    position: {
                                        title: '<?php echo lang('Position'); ?>',
                                        input: function(data) {
                                            return '<input id="Edit-position" type="text" name="position"><a onclick="onclick_load_blind_position_button(' + data.form.find("#Edit-blind_id").val() + ');" href="#" class="btn"><?php echo lang('Load current position'); ?></a>';
                                        }
                                    }
                                                                }
                                        },
                            function(data) {
                                                    data.childTable.jtable('load');
                                                });
                                            });
                                            return $img;
                                        }
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-cameras').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/cameras/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/cameras/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/cameras/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/cameras/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                },
                snapshot_url: {
                    title: '<?php echo lang('Snapshot-URL'); ?>'
                },
                username: {
                    title: '<?php echo lang('Username'); ?>'
                },
                password: {
                    title: '<?php echo lang('Password'); ?>',
                    list: false,
                    type: 'password'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-computers').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/computers/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/computers/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/computers/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/computers/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                },
                fqdn: {
                    title: '<?php echo lang('FQDN'); ?>'
                },
                mac: {
                    title: '<?php echo lang('MAC'); ?>'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-doors').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/doors/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/doors/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/doors/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/doors/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-lights').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/lights/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/lights/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/lights/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/lights/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-sensors').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/sensors/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/sensors/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/sensors/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/sensors/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                type: {
                    title: '<?php echo lang('Type'); ?>',
                    options: [<?php
                                    foreach (get_class_constants('sensors_model') as $sensorType)
                                        echo "'$sensorType',";
                                    ?>]
                },
                location_type: {
                    title: '<?php echo lang('Location Type'); ?>',
                    options: [<?php
                                    foreach (get_class_constants('sensors_model') as $sensorType)
                                        echo "'$sensorType',";
                                    ?>]
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-windows').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/windows/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/windows/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/windows/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/windows/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>'
                },
                room_id: {
                    title: '<?php echo lang('Room'); ?>',
                    options: '<?php echo base_url('settings/ajax_jtable/rooms/list-dropdown/name'); ?>'
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $('#grid-macros').jtable({
            title: ' ',
            actions: {
                listAction: '<?php echo base_url('settings/ajax_jtable/macros/list'); ?>',
                createAction: '<?php echo base_url('settings/ajax_jtable/macros/create'); ?>',
                updateAction: '<?php echo base_url('settings/ajax_jtable/macros/update'); ?>',
                deleteAction: '<?php echo base_url('settings/ajax_jtable/macros/delete'); ?>'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: '<?php echo lang('Name'); ?>',
                },
                description: {
                    title: '<?php echo lang('Description'); ?>',
                    type: 'textarea'
                },
                macro_actions: {
                    title: '<?php echo lang('Macro actions'); ?>',
                    width: '1%',
                    sorting: false,
                    edit: false,
                    create: false,
                    listClass: 'jtable-command-column',
                                        display: function(parentRow) {
                        var $img = $('<i class="glyphicon glyphicon-list"></i>');
                                            $img.click(function() {
                                                $('#grid-blinds').jtable('openChildTable', $img.closest('tr'), {
                                title: parentRow.record.name + ' - <?php echo lang('Macro actions'); ?>',
                                                                actions: {
                                                                    listAction: '<?php echo base_url('settings/ajax_jtable/macro_actions/list-child-table'); ?>' + '?column=macro_id&value=' + parentRow.record.id,
                                    createAction: '<?php echo base_url('settings/ajax_jtable/macro_actions/create'); ?>',
                                    updateAction: '<?php echo base_url('settings/ajax_jtable/macro_actions/update'); ?>',
                                    deleteAction: '<?php echo base_url('settings/ajax_jtable/macro_actions/delete'); ?>'
                                                                },
                                                                fields: {
                                                                    macro_id: {
                                                                        type: 'hidden',
                                                                        defaultValue: parentRow.record.id
                                                                    },
                                                                    id: {
                                        key: true,
                                        list: false
                                    },
                                    name: {
                                        title: '<?php echo lang('Name'); ?>'
                                    },
                                    description: {
                                        title: '<?php echo lang('Description'); ?>',
                                        type: 'textarea'
                                    },
                                    type: {
                                        title: '<?php echo lang('Type'); ?>',
                                        options: [<?php
                                    foreach (get_class_constants('MacroActionTypes') as $actionType)
                                        echo '{ Value: "' . $actionType . '", DisplayText: "' . lang($actionType) . '" },';
                                    ?>]
                                    },
                                    action_parameters: {
                                        title: '<?php echo lang('Action parameters'); ?>',
                                        width: '2%',
                                        sorting: false,
                                        edit: false,
                                        create: false,
                                        listClass: 'jtable-command-column',
                                        display: function(parentRow) {
                                            var $img = $('<i class="glyphicon glyphicon-edit"></i>');
                                                                $img.click(function() {
                                                $.ajax({
                                                    url: '<?php echo base_url('settings/render_macro_action_edit_form'); ?>' + '/' + parentRow.record.id,
                                                    success: function(response) {
                                                        $('#modal-template-content').html(response);
                                                        $('#modal-template').modal('show');
                                                    }
                                                });
                                            });
                                            return $img;
                                        }
                                    }
                                                                }
                                        },
                            function(data) {
                                                    data.childTable.jtable('load');
                                                });
                                            });
                                            return $img;
                                        }
                }
            },
            sorting: true,
            defaultSorting: 'name ASC'
        });

        $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
            var activatedTab = $($(e.target).attr('href'));
            var grid = activatedTab.find('.grid').first();
            grid.jtable('load');
        })

    });

    function onclick_load_blind_position_button(blindId) {
        $.ajax({
            url: '<?php echo base_url('api/blinds/get_position/') ?>/' + blindId,
            dataType: 'json',
            async: false,
            success: function(apiResponse) {
                $("#Edit-position").val(apiResponse.data.position);
            }
        });

        return false;
    }
</script>

<div id="modal-template" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="modal-template-content" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
foreach ($plugins as $plugin) {
    $devices = NULL;

    switch ($plugin->pluginArea) {
        case PluginAreas::BLINDS:
            $devices = $blinds;
            break;
        case PluginAreas::DOORS:
            $devices = $doors;
            break;
        case PluginAreas::LIGHTS:
            $devices = $lights;
            break;
        case PluginAreas::SENSORS:
            $devices = $sensors;
            break;
        case PluginAreas::WINDOWS:
            $devices = $windows;
            break;
    }

    $data = array(
        'plugin' => $plugin,
        'pluginDevices' => $plugin->get_devices(),
        'devices' => $devices
    );

    $this->load->view('components/plugin_settings_modal_dialog', $data);
}
?>

<?php $this->load->view('layout/footer_default'); ?>
<?php $this->load->view('layout/footer_footer'); ?>