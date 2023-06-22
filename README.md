<table align="center">
    <tr style="text-align: center;">
        <td align="center" width="9999">
            <img src="./doc/infra.png" alt="Project icon" style="margin: 25px auto; display: inline-block">

 <h1 style="color: black;"> App user Management </h1>

<p style="color: black">Building A Vue Front End For A Laravel API/mongodb</p>
</td>
</tr>
</table>

## 1. How to Run
 Execute the command:
  `make all`
to build and up all containers with all dependencies for frontend and backend folders.
- migrations
- keys oauth generated
- database app_user_db created (root/root)

Execute `make drop` command to stop and delete all containers, volumes docker.
Before,you need to make sure you have the docker daemon running.
 ### Note
 
 Stack : Laravel Mongo and Vuejs.
Login: 
   - username :  admin@admin.com
   - password : admin
 
 You can connect to the database with: Robo3T.
   - username : root
   - password : root
   - authentication database :  admin
   - auth Mechanism : SCRAM-SHA-1
   - port: 27017 / address: your ip 
  
  Or you can decomment Mongo-express service in docker-compose.yml to use mongo express.
     
     
     Front   http://localhost:8080
     Api:    http://localhost/api/v1/users 
             http://localhost/api/v1/groupes 
 
