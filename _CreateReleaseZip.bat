set projectPath=%~dp0
set zip=A:\7-Zip\7za.exe
set jq=A:\jq\jq.exe


if %projectPath:~-1%==\ set projectPath=%projectPath:~0,-1%
set myTemp=%temp%\lihocos_release%random%
for /F "delims=" %%i in ('type "%projectPath%\application\config\version.json" ^| "%jq%" .Build') do set version=%%i
robocopy /MIR "%projectPath%" "%myTemp%" /XD .git /XD nbproject /XD demo.lihocos.de /XF .gitignore /XF README.md
del "%myTemp%\_*.bat"

set releasePath=%projectPath%\_release
mkdir "%releasePath%"
"%zip%" a -tzip -r "%releasePath%\LiHoCoS_v%version%.zip" "%myTemp%\*.*"

rd /S /Q "%myTemp%"