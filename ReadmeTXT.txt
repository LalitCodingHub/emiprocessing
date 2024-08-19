Run Commands in your terminal
1> php artisan migrate
2> php artisan db:seed

Go to : http://127.0.0.1:8000/

Click on Login (top RHS ) -> 
username => developer
password=> Test@Password123#


This "http://127.0.0.1:8000/loan-details" page will apper if login details are correct else it will throw error

Go to : http://127.0.0.1:8000/process-data

Click on to "Process Data" button,it will create a table named "emi_details" dynamically and if the table already exists, delete the table 
and recreate it.
If Emi details has been generated it will be displayed on the process data page.



