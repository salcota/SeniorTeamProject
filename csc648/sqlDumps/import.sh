echo "What is your MySql Username?"
read inputVar
echo "Enter the MySQL password"
mysql -u $inputVar -p student_$inputVar < group.sql
return