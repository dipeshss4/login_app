login App and Admin and user 

configure the env 
migrate the database 

Run the seeder for the Admin creation as we don't have admin login
php artisan db:seed --class=CreateAdminSeeder
admin username:admin@maven.com
password:admin@123

route for the user 
localhost:8000/user/userLogin  
Method:POST
Token need for the dashboard access

Registering User
localhost:8000/user/register
Method:POSt


User Dashboard
localhost:8000/user/userDashboard
method:GET
Token need in header




Route for the Admin:

localhost:8000/admin/login  
Method:POST

dashboard
localhost:8000/admin/adminDashboard
Token needed in header 
