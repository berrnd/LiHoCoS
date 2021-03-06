<?php

/**
 * @property Blinds_model $blinds_model
 * @property Cameras_model $cameras_model
 * @property Computers_model $computers_model
 * @property Doors_model $doors_model
 * @property Lights_model $lights_model
 * @property Sensors_model $sensors_model
 * @property Windows_model $windows_model
 * @property Users_model $users_model
 * @property Settings_model $settings_model
 * @property Rooms_model $rooms_model
 * @property Macros_model $macros_model
 * @property Macro_Actions_model $macro_actions_model
 */
class Settings extends SessionController {

    public function __construct() {
        parent::__construct();

        $this->load->model('blinds_model');
        $this->load->model('blind_positions_model');
        $this->load->model('cameras_model');
        $this->load->model('computers_model');
        $this->load->model('doors_model');
        $this->load->model('lights_model');
        $this->load->model('sensors_model');
        $this->load->model('windows_model');
        $this->load->model('users_model');
        $this->load->model('settings_model');
        $this->load->model('rooms_model');
        $this->load->model('macros_model');
        $this->load->model('macro_actions_model');
        $this->load->helper('jtable');
        $this->load->helper('plugin');
        $this->load->helper('network');
    }

    public function index() {
        $data = array(
            'pageId' => 'settings',
            'title' => lang('Settings'),
            'plugins' => get_all_plugins(),
            'blinds' => $this->blinds_model->get(),
            'doors' => $this->doors_model->get(),
            'lights' => $this->lights_model->get(),
            'sensors' => $this->sensors_model->get(),
            'windows' => $this->windows_model->get(),
            'rooms' => $this->rooms_model->get()
        );

        $this->load->view('settings', $data);
    }

    public function save() {
        $knownSettings = get_known_settings();

        foreach (get_all_plugins() as $plugin) {
            foreach ($plugin->settings as $setting) {
                $knownSettings[] = $setting['key'];
            }
        }

        foreach ($_POST as $key => $newValue) {
            if (in_array($key, $knownSettings)) {
                $setting = $this->settings_model->get_by_name($key);
                $setting->value = $newValue;
                $setting->save();
            }

            if (string_starts_with($key, 'plugin_reference')) {
                $keyParts = explode('-', $key);
                $modelClassName = strtolower($keyParts[1]);
                $id = $keyParts[2];

                $object = $this->$modelClassName->get($id);
                $object->plugin_reference = $newValue;
                $object->save();
            }
        }

        redirect(base_url('/settings?message=saved'));
    }

    public function ajax_jtable($model, $action, $additionalParam = FALSE) {
        $modelClass = $model . '_model';

        switch ($action) {
            case 'list':
                $rows = $this->$modelClass->get();
                echo jtable_result('OK', $rows);
                break;
            case 'list-dropdown':
                $rows = $this->$modelClass->get();
                $options = array();

                foreach ($rows as $row) {
                    $options[] = array(
                        'DisplayText' => $row->$additionalParam,
                        'Value' => $row->id
                    );
                }

                echo jtable_result('OK', $options);
                break;
            case 'list-child-table':
                $rowsAll = $this->$modelClass->get();
                $rowsFiltered = array();

                if (!empty($rowsAll)) {
                    foreach ($rowsAll as $row) {
                        if ($row->$_REQUEST['column'] == $_REQUEST['value'])
                            $rowsFiltered[] = $row;
                    }
                }

                echo jtable_result('OK', $rowsFiltered);
                break;
            case 'create':
                $object = new $modelClass();
                foreach ($_POST as $key => $value) {
                    $object->$key = $value;
                }
                $object->save();
                echo jtable_result('OK', '', $object);
                break;
            case 'update':
                $id = $_POST['id'];
                $object = $this->$modelClass->get($id);
                foreach ($_POST as $key => $value) {
                    $object->$key = $value;
                }
                $object->save();
                echo jtable_result('OK');
                break;
            case 'delete':
                $id = $_POST['id'];
                $object = $this->$modelClass->get($id);
                $object->delete();
                echo jtable_result('OK');
                break;
        }
    }

    public function render_macro_action_edit_form($macroActionId) {
        $macroAction = $this->macro_actions_model->get($macroActionId);
        $macro = $this->macros_model->get($macroAction->macro_id);
        $lights = $this->lights_model->get();
        $blinds = $this->blinds_model->get();
        $macros = $this->macros_model->get();

        $data = array(
            'macroAction' => $macroAction,
            'macro' => $macro,
            'lights' => $lights,
            'blinds' => $blinds,
            'macros' => $macros
        );

        $this->load->view("components/macro-action-edit-forms/$macroAction->type.php", $data);
    }

    public function set_macro_action_parameters($macroActionId) {
        $macroAction = $this->macro_actions_model->get($macroActionId);
        $macroAction->parameters = $_POST['parameters'];
        $macroAction->save();
    }

}
