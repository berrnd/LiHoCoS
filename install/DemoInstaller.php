<?php

class DemoInstaller {

    public static function is_demo() {
        return file_exists('../application/config/demo.txt');
    }

    public static function do_demo_installation() {
        $installer = new Installer();
        $databaseInstaller = new DatabaseInstaller();

        $demoType = file_get_contents('../application/config/demo.txt');

        $data = array(
            'hostname' => 'localhost',
            'username' => 'lihocos-demo',
            'password' => 'HxH8oKh0B6gteWGWaA7a2gTpm',
            'database' => "lihocos-demo-$demoType"
        );

        $databaseInstaller->create_database($data, $errorMessage);
        $databaseInstaller->create_schema($data, $errorMessage);
        $installer->write_database_config($data);
        $installer->write_config();

        $installer->redirect_after_installation();
    }

}