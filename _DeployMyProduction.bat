set projectPath=%~dp0
set prodWwwRoot=\\BestelServer\inetpub\wwwroot\LiHoCoS


if %projectPath:~-1%==\ set projectPath=%projectPath:~0,-1%

rem Backup config files
copy "%prodWwwRoot%\application\config\config.php" "%temp%\config.php" /Y
copy "%prodWwwRoot%\application\config\database.php" "%temp%\database.php" /Y

robocopy /MIR "%projectPath%" "%prodWwwRoot%" /XD .git /XD nbproject /XD demo.lihocos.de /XF .gitignore
del "%prodWwwRoot%\application\config\demo.txt"
del "%prodWwwRoot%\_*.bat"

rem Restore config files
copy "%temp%\config.php" "%prodWwwRoot%\application\config\config.php" /Y
del "%temp%\config.php"
copy "%temp%\database.php" "%prodWwwRoot%\application\config\database.php" /Y
del "%temp%\database.php"