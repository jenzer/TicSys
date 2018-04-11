# TicSys
Schulprojekt für das Fach Web-Engineering an der ABB Technikerschule

## Apache vhost Beispiel-Konfiguration

    <VirtualHost *:80>
        ServerName localhost
        ServerAlias localhost
        DocumentRoot "C:/Apache24/htdocs"
    </VirtualHost>
    
    <VirtualHost *:80>
        ServerName ticsys.local
        ServerAlias ticsys.local
        ServerAdmin jem@semabit.ch
        DocumentRoot "C:/DATA/ticsys/web"
        ErrorLog "C:/DATA/ticsys/logs/error.log"
        CustomLog "C:/DATA/ticsys/logs/access.log" common
    
        <Directory "C:/DATA/ticsys/web">    
            Options Indexes FollowSymLinks
            AllowOverride All   
            Require all granted
        </Directory>
    </VirtualHost>