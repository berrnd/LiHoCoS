<?php

/**
 * @property Blinds_model $blinds_model
 * @property Cameras_model $cameras_model
 * @property Computers_model $computers_model
 * @property Doors_model $doors_model
 * @property Lights_model $lights_model
 * @property Sensors_model $sensors_model
 * @property Sensors_History_model $sensors_history_model
 * @property Windows_model $windows_model
 * @property Users_model $users_model
 * @property Settings_model $settings_model
 * @property Rooms_model $rooms_model
 * @property Macros_model $macros_model
 */
class Deploy extends MainController {

    public function __construct() {
        parent::__construct();

        $this->load->model('blinds_model');
        $this->load->model('cameras_model');
        $this->load->model('computers_model');
        $this->load->model('doors_model');
        $this->load->model('lights_model');
        $this->load->model('sensors_model');
        $this->load->model('sensors_history_model');
        $this->load->model('windows_model');
        $this->load->model('users_model');
        $this->load->model('settings_model');
        $this->load->model('rooms_model');
        $this->load->model('macros_model');
    }

    public function after_database_installation() {
        $this->insert_default_data();

        if (is_demo())
            $this->generate_demo_data();

        redirect(base_url('auth/login'));
    }

    public function insert_default_data() {
        $alreadyDone = get_setting(KnownSettings::DEFAULT_DATA_INSERTED);
        if (!empty($alreadyDone))
            return;

        $user = new Users_model();
        $user->firstname = 'Admin';
        $user->username = 'admin';
        $user->password = 'admin';
        $user->save();

        $room = new Rooms_model();
        $room->name = lang('Room') . '1';
        $room->save();

        $firstRoomId = -1;
        $rooms = $this->rooms_model->get();
        foreach ($rooms as $room)
            $firstRoomId = $room->id;

        $blind = new Blinds_model();
        $blind->name = lang('Blind') . '1';
        $blind->room_id = $firstRoomId;
        $blind->save();

        $camera = new Cameras_model();
        $camera->name = lang('Camera') . '1';
        $camera->snapshot_url = 'http://camera/stream';
        $camera->username = 'x';
        $camera->password = 'x';
        $camera->room_id = $firstRoomId;
        $camera->save();

        $computer = new Computers_model();
        $computer->name = lang('Computer') . '1';
        $computer->room_id = $firstRoomId;
        $computer->fqdn = 'Computer.domain.local';
        $computer->mac = '00:00:00:00:00:00';
        $computer->save();

        $door = new Doors_model();
        $door->name = lang('Door') . '1';
        $door->room_id = $firstRoomId;
        $door->save();

        $light = new Lights_model();
        $light->name = lang('Light') . '1';
        $light->room_id = $firstRoomId;
        $light->save();

        $sensor = new Sensors_model();
        $sensor->name = lang('Sensor') . '1';
        $sensor->room_id = $firstRoomId;
        $sensor->save();

        $window = new Windows_model();
        $window->name = lang('Window') . '1';
        $window->room_id = $firstRoomId;
        $window->save();

        $macro = new Macros_model();
        $macro->name = lang('Macro') . '1';
        $macro->description = lang('This macro was created during installation...');
        $macro->save();

        set_setting(KnownSettings::LANGUAGE, 'english');
        set_setting(KnownSettings::LATITUDE, '48.26969');
        set_setting(KnownSettings::LONGITUDE, '10.82958');
        set_setting(KnownSettings::PLUGIN_BLINDS, 'DemoBlindsPlugin');
        set_setting(KnownSettings::PLUGIN_DOORS, 'DemoDoorsPlugin');
        set_setting(KnownSettings::PLUGIN_LIGHTS, 'DemoLightsPlugin');
        set_setting(KnownSettings::PLUGIN_SENSORS, 'DemoSensorsPlugin');
        set_setting(KnownSettings::PLUGIN_WINDOWS, 'DemoWindowsPlugin');
        set_setting(KnownSettings::TIMEZONE, 'Europe/Berlin');
        set_setting(KnownSettings::LOCAL_BROADCAST_ADDRESS, '192.168.178.255');

        set_setting(KnownSettings::DEFAULT_DATA_INSERTED, '1');
    }

    public function generate_demo_data() {
        $firstRoomId = -1;
        $rooms = $this->rooms_model->get();
        foreach ($rooms as $room)
            $firstRoomId = $room->id;

        //Second sensor
        $sensor = new Sensors_model();
        $sensor->name = lang('Sensor') . '2';
        $sensor->room_id = $firstRoomId;
        $sensor->save();

        //Random sensor data for the last 24 hours
        $sensors = $this->sensors_model->get();
        foreach ($sensors as $sensor) {

            $time = new DateTime();
            for ($i = 1; $i <= 288; $i++) {
                $multiplicator = $i * 5;
                $time->modify("-$multiplicator minutes");

                $historyEntry = new Sensors_History_model();
                $historyEntry->sensor_id = $sensor->id;
                $historyEntry->timestamp = $time->format('Y-m-d H:m:s');
                $historyEntry->temperature = rand(10, 25);
                $historyEntry->relative_humidity = rand(5, 75);
                $historyEntry->save();
            }
        }

        //Second blind
        $blind = new Blinds_model();
        $blind->name = lang('Blind') . '2';
        $blind->room_id = $firstRoomId;
        $blind->save();

        //Second camera
        $camera = new Cameras_model();
        $camera->name = lang('Camera') . '2';
        $camera->snapshot_url = 'http://camera/stream';
        $camera->username = 'x';
        $camera->password = 'x';
        $camera->room_id = $firstRoomId;
        $camera->save();

        //Second computer
        $computer = new Computers_model();
        $computer->name = lang('Computer') . '2';
        $computer->room_id = $firstRoomId;
        $computer->fqdn = 'Computer.domain.local';
        $computer->mac = '00:00:00:00:00:00';
        $computer->save();

        //Second door
        $door = new Doors_model();
        $door->name = lang('Door') . '2';
        $door->room_id = $firstRoomId;
        $door->save();

        //Second light
        $light = new Lights_model();
        $light->name = lang('Light') . '2';
        $light->room_id = $firstRoomId;
        $light->save();

        //Second window
        $window = new Windows_model();
        $window->name = lang('Window') . '2';
        $window->room_id = $firstRoomId;
        $window->save();

        //Second macro
        $macro = new Macros_model();
        $macro->name = lang('Macro') . '2';
        $macro->description = lang('This macro was created during installation...');
        $macro->save();

        //Set API key for demo
        $users = $this->users_model->get();
        foreach ($users as $user) {
            $user->api_key = 'xx123xx' . rand(0, 1000);
            $user->save();
        }
    }

}
