<?php

include '../application/helpers/application_helper.php';

class DemoInstaller {

    public static function do_demo_installation() {
        $installer = new Installer();
        $databaseInstaller = new DatabaseInstaller();

        $appInfo = get_application_version_info();
        $demoType = $appInfo->ReleaseType;

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
