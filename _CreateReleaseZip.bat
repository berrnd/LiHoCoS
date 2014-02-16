set projectPath=%~dp0
set zip=A:\7-Zip\7za.exe


if %projectPath:~-1%==\ set projectPath=%projectPath:~0,-1%
set myTemp=%temp%\lihocos_release%random%
set /p version=<"%projectPath%\application\config\version.txt"

robocopy /MIR "%projectPath%" "%myTemp%" /XD .git /XD nbproject /XD demo.lihocos.de /XF .gitignore /XF README.md
del "%myTemp%\application\config\demo.txt"
del "%myTemp%\_*.bat"

"%zip%" a -tzip -r "%userprofile%\Desktop\LiHoCoS_%version%.zip" "%myTemp%\*.*"

rd /S /Q "%myTemp%"