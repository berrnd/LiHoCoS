set projectPath=%~dp0
set testWwwRoot=A:\PortableWebserver\www\LiHoCoS-test


if %projectPath:~-1%==\ set projectPath=%projectPath:~0,-1%

robocopy /MIR "%projectPath%" "%testWwwRoot%" /XD .git /XD nbproject /XF .gitignore