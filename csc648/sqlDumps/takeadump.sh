echo "Enter the group MySQL username"
read inputVar
echo "Enter the group MySQL password"
mysqldump -u $inputVar -p $inputVar > group.sql
return