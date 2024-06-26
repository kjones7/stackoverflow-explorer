# stackoverflow-explorer
A web app that allows you to explore Stack Overflow's [data](https://data.stackexchange.com/) in a CRUD interface. Built using React, Symfony, and SQL Server.

## Installation
1. Install [PHP 8.3](https://windows.php.net/download#php-8.3)
1. Install [Composer](https://getcomposer.org/download/)
1. Install [Symfony CLI](https://symfony.com/download)
1. Install [Node.js](https://nodejs.org/en/download/) (consider using a version manager like [fnm](https://github.com/Schniz/fnm))
1. Install [SQL Server Developer](https://www.microsoft.com/en-us/sql-server/sql-server-downloads)
    - You may also want to install [SQL Server Management Studio](https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms)
1. Install [ODBC Driver for SQL Server](https://learn.microsoft.com/en-us/sql/connect/odbc/download-odbc-driver-for-sql-server?view=sql-server-ver16) (required for PHP to use SQL Server)
1. Install `sqlsrv` and `pdo_sqlsrv` PHP extensions
    - Download [here](https://github.com/microsoft/msphpsql/releases)
    - Extract the zip file then copy the `php_sqlsrv_83_nts_x64.dll` and `php_pdo_sqlsrv_83_nts_x64.dll` files to `C:\php8.3\ext`
    - Add the following to `php.ini`: `extension=php_sqlsrv_83_nts_x64.dll` and `extension=php_pdo_sqlsrv_83_nts_x64.dll`
1. Download the [Stack Overflow data](https://www.brentozar.com/archive/2015/10/how-to-download-the-stack-overflow-database-via-bittorrent/) (I used the 50GB database)
1. Optional suggestions from Symfony requirements check:
    - Uncomment `extension=intl` from `php.ini`
    - Set the following in `php.ini`: `realpath_cache_size = 5M`
    - Add the following to `php.ini` `[opcache]` section:
        - `zend_extension=php_opcache.dll`
        - `opcache.enable=1`
        - `opcache.memory_consumption=128`
        - `opcache.interned_strings_buffer=8`
        - `opcache.max_accelerated_files=4000`
        - `opcache.revalidate_freq=2`

## Setup
1. Extract the Stack Overflow database .zip files and move the `.mdf`, `.ndf`, and `.ldf` files to the SQL Server `DATA` directory, then attach the database through SSMS.