:: Usage: import.cmd <Excel File> <Database Host> <Database User> <Database Password>
cd /d %~dp0
cd SourceCode

php import.php %1 %2 %3 %4
