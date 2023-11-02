#!/usr/bin/env bash
set -e

DB_EXEC="docker compose exec mysql"
PHP_EXEC="docker compose exec symfony"

if [ -z "$1" ]; then
  echo "Provide dump type [stage|prod]"
  exit 1
fi
if [ -z "$2" ]; then
  echo "Provide database name"
  exit 1
fi
$DB_EXEC sh -c "sed -i 's/DEFINER=[^*]*\*/\*/g' /var/dumps/$1_struct.sql"
echo "Importing $1 dump"

echo "Dropping old db..."
$DB_EXEC sh -c "mariadb -u root -proot -e \"DROP DATABASE $2;\""

echo "Recreating db..."
$DB_EXEC sh -c "mariadb -u root -proot -e \"CREATE DATABASE $2;\""
$DB_EXEC sh -c "mariadb -u root -proot $2 < /var/dumps/$1_struct.sql"
$DB_EXEC sh -c "mariadb -u root -proot $2 < /var/dumps/$1_data.sql"


echo "Clear cache..."
# $PHP_EXEC bin/console cache:clear

echo "DONE!!!!"
