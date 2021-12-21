#!/bin/bash
fecha=`date +%d-%m-%Y`
archivo="licor-$fecha.sql"
mysqldump --user=root --host localhost --password=slack142 licor > $archivo
mv $archivo sqls/
echo -e "Database Backing Up Successfully. File storage Successfully"

