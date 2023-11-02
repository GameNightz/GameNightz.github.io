#!/usr/bin/env bash
set -e

# lokaler Datenbankname
DATABASE_LOCAL="symfony"

set -o allexport
source .env set
set +o allexport

DB_USERNAME=""
DB_PASSWORD=""
DB_NAME=""

SSH_HOST=""

mkdir -p local/dumps

rm -rf local/dumps/prod_data.sql
rm -rf local/dumps/prod_struct.sql

echo "Downloading prod dump..."

ssh $SSH_HOST "mysqldump -h 127.0.0.1 -u $DB_USERNAME -p$DB_PASSWORD --lock-tables=false --opt --default-character-set=utf8 --quick --no-data $DB_NAME" > local/dumps/prod_struct.sql
ssh $SSH_HOST "mysqldump -h 127.0.0.1 -u $DB_USERNAME -p$DB_PASSWORD --lock-tables=false --opt --default-character-set=utf8 --quick --no-create-info --skip-triggers $DB_NAME | gzip -9" > local/dumps/prod_data.sql.gz

echo "Unpacking..."
gunzip local/dumps/prod_data.sql.gz

FILES="local/sql/*.sql"
for f in $FILES
do
  echo "Processing file $f ..."
  cat "$f" >> local/dumps/prod_data.sql
done

./local/import-db.sh prod $MYSQL_DATABASE

# mysql -h mysql -uroot -proot --default-character-set=UTF8 $DATABASE_LOCAL < backup.sql

# rm backup.sql