#!/bin/sh

if [ -n "$1" ]; then
    sql_path="$1"
else
    APP_HOME=$(dirname $(dirname $(dirname $(readlink -f "$0"))))
    sql_path=${APP_HOME}/install/mysql/lduojbackup.sql
fi

USER=$(cat /etc/mysql/debian.cnf |grep user|head -1|awk '{print $3}')
PASSWORD=$(cat /etc/mysql/debian.cnf |grep password|head -1|awk '{print $3}')
mysqldump -u"${USER}" -p"${PASSWORD}" -B lduoj > "${sql_path}"

echo "Generated back-up: ${sql_path}"
