<?php

class Installer {

    function validate_post($data) {
        //Validating the hostname, the database name and the username. The password is optional.
        return !empty($data['hostname']) && !empty($data['username']) && !empty($data['database']);
    }

    function show_message($type, $message) {
        return $message;
    }

    function write_database_config($data) {
        $templatePath = '../application/config/database-dist.php';
        $outputPath = '../application/config/database.php';

        $databaseFile = file_get_contents($templatePath);

        $new = str_replace("%HOSTNAME%", $data['hostname'], $databaseFile);
        $new = str_replace("%USERNAME%", $data['username'], $new);
        $new = str_replace("%PASSWORD%", $data['password'], $new);
        $new = str_replace("%DATABASE%", $data['database'], $new);

        // Write the new database.php file
        $handle = fopen($outputPath, 'w+');

        // Chmod the file, in case the user forgot
        @chmod($outputPath, 0777);

        // Verify file permissions
        if (is_writable($outputPath)) {
            // Write the file
            if (fwrite($handle, $new))
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    function write_config() {
        $templatePath = '../application/config/config-dist.php';
        $outputPath = '../application/config/config.php';

        $configFile = file_get_contents($templatePath);

        $new = str_replace("%ENCRYPTION_KEY%", $this->generate_password(32), $configFile);

        // Write the new database.php file
        $handle = fopen($outputPath, 'w+');

        // Chmod the file, in case the user forgot
        @chmod($outputPath, 0777);

        // Verify file permissions
        if (is_writable($outputPath)) {
            // Write the file
            if (fwrite($handle, $new))
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }

    function generate_password($length) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = strlen($chars);

        for ($i = 0, $password = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $password .= substr($chars, $index, 1);
        }

        return $password;
    }

    function redirect_after_installation() {
        $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $redir .= "://" . $_SERVER['HTTP_HOST'];
        $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $redir = str_replace('install/', '', $redir);
        header('Location: ' . $redir . 'deploy/after_database_installation');
    }

}