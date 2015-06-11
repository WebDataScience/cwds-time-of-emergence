# .sh style script

# Drop old table and create new empty table
/c/xampp/mysql/bin/mysql cig_toe -u root < create_table_only_variablev7.sql

# Show that count is zero.
/c/xampp/mysql/bin/mysql cig_toe -u root << END
select count(*) from variablev7;
END

# Convert unknown format to DOS or UNIX format.
dos2unix -v *.txt
# Second call only required for gitbash.
dos2unix -v -U *.txt

# Convert from DOS to UNIX or, if already UNIX, do nothing.
dos2unix -v *.csv
# Second call only required for gitbash.
dos2unix -v -U *.csv

# Ask MySQL to read files into table.
echo "Ask MySQL to read files into table. About ten minutes..."
/c/xampp/mysql/bin/mysql cig_toe -u root --local-infile << END 
load data local infile 'c:/vhosts/project/toe/dataconversionv7/BCSD3_streams.csv' into table cig_toe.variablev7 fields terminated by ',';       
load data local infile 'c:/vhosts/project/toe/dataconversionv7/HUC_WRF_v1-21.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;   
load data local infile 'c:/vhosts/project/toe/dataconversionv7/USC_WRF_v23-41.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;
load data local infile 'c:/vhosts/project/toe/dataconversionv7/BCSD5_streams.csv' into table cig_toe.variablev7 fields terminated by ',';         
load data local infile 'c:/vhosts/project/toe/dataconversionv7/HUC_WRF_v23-41.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;    
load data local infile 'c:/vhosts/project/toe/dataconversionv7/BCSD5_streams_hybrid.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;  
load data local infile 'c:/vhosts/project/toe/dataconversionv7/USC_BCSD3_v1.01-21.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;   
load data local infile 'c:/vhosts/project/toe/dataconversionv7/HUC_BCSD3_v1.01-21.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;       
load data local infile 'c:/vhosts/project/toe/dataconversionv7/USC_BCSD3_v23-41.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;  
load data local infile 'c:/vhosts/project/toe/dataconversionv7/HUC_BCSD3_v23-41.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;      
load data local infile 'c:/vhosts/project/toe/dataconversionv7/USC_BCSD5_ALL.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;
load data local infile 'c:/vhosts/project/toe/dataconversionv7/HUC_BCSD5_ALL.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;         
load data local infile 'c:/vhosts/project/toe/dataconversionv7/USC_WRF_v1-21.txt' into table cig_toe.variablev7 fields terminated by '\t' IGNORE 1 LINES;
END

# Verify appropriate number of rows created.
echo "Did we create about 11.8 million rows?"
/c/xampp/mysql/bin/mysql cig_toe -u root << END
select count(*) from variablev7;
END

# Create mysqldump file.
echo " Create mysqldump file"
/c/xampp/mysql/bin/mysqldump cig_toe variablev7 -u root > variablev7.sql

# Compress for transport.
echo "Compress for transport"
gzip -vc variablev7.sql > variablev7.sql.gz