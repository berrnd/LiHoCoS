<?php
$dbConfigPath = '../application/config/database.php';

require_once 'Installer.php';
require_once 'DatabaseInstaller.php';
require_once 'DemoInstaller.php';

$installer = new Installer();
$databaseInstaller = new DatabaseInstaller();

if (is_demo())
    DemoInstaller::do_demo_installation();

if ($_POST) {
    if ($installer->validate_post($_POST) == true) {

        // First create the database, then create tables, then write database config file, then config file
        if ($databaseInstaller->create_database($_POST, $errorMessage) == false)
            $message = $installer->show_message('error', "The database could not be created, please verify your settings.<br /><code>$errorMessage</code>");
        else if ($databaseInstaller->create_schema($_POST, $errorMessage) == false)
            $message = $installer->show_message('error', "The database schema could not be created, please verify your settings.<br /><code>$errorMessage</code>");
        else if ($installer->write_database_config($_POST) == false)
            $message = $installer->show_message('error', 'The database configuration file could not be written, please chmod application/config/database.php file to 777');
        else if ($installer->write_config() == false)
            $message = $installer->show_message('error', 'The database configuration file could not be written, please chmod application/config/database.php file to 777');

        // If no errors, redirect to application
        if (!isset($message))
            $installer->redirect_after_installation();
    }
    else
        $message = $installer->show_message('error', 'Not all fields have been filled in correctly. The host, username, password, and database name are required.');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Install | LiHoCoS</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body style="text-align: center;">
        <div class="container">
            <div class="row">
                <h1>Setup LiHoCoS</h1>
                <hr />
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <?php if (isset($message)) : ?>
                            <div class="alert alert-danger">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <div class="panel-heading">
                            <h3 class="panel-title">Database</h3>
                        </div>
                        <div class="panel-body">
                            <?php if (is_writable($dbConfigPath)) : ?>

                                <form id="install_form" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        <legend>MySQL connection settings</legend>
                                        <div class="form-group">
                                            <label for="hostname">Hostname</label>
                                            <input id="hostname" name="hostname" class="form-control" placeholder="Hostname" value="localhost" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input id="username" name="username" class="form-control" placeholder="Username" type="text" autofocus="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" name="password" class="form-control" placeholder="Password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="database">Database name</label>
                                            <input id="database" name="database" class="form-control" placeholder="Database" value="lihocos" type="text">
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-success btn-block">Install</button>
                                    </fieldset>
                                </form>

                            <?php else : ?>
                                <?php if (!is_writable($dbConfigPath)) : ?>
                                    <div class="alert alert-danger">
                                        Please make the <?php echo realpath($dbConfigPath); ?> file writable.<br />
                                        <strong>Example:</strong><br />
                                        <code>chmod 777 <?php echo realpath($dbConfigPath); ?></code>
                                    </div>
                                    <button type="button" class="btn btn-danger" disabled="disabled">Installer cannot continue</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="panel-footer">
                            After installation you can login with<br />
                            Username: <code>admin</code><br />
                            Password: <code>admin</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>