set projectPath=%~dp0
set mysqldump=A:\PortableWebserver\webserver\mysql\bin\mysqldump.exe
set mysqlUser=root
set mysqlPassword=mysql
set mysqlDevDatabase=lihocos
set mysqlDumpDist=%projectPath%application\sql\lihocos-dist.sql
set mysqlDumpDev=%projectPath%application\sql\lihocos-dev.sql


if %projectPath:~-1%==\ set projectPath=%projectPath:~0,-1%

"%mysqldump%" -u%mysqlUser% -p%mysqlPassword% --opt %mysqlDevDatabase% --no-data --skip-comments > "%mysqlDumpDist%"
"%mysqldump%" -u%mysqlUser% -p%mysqlPassword% --opt %mysqlDevDatabase% --skip-comments > "%mysqlDumpDev%"