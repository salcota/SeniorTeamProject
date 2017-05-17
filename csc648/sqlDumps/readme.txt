To create a new SqlDump:
(provided sh script)
sh takeadump.sh


(manually)
mysqldump -u [username] -p [databaseName] > group.sql




______________________________________________

To import an SqlDump into your database:
(provided sh script)
sh import.sh


(manually)
mysql -u [username] -p [databaseName] < group.sql