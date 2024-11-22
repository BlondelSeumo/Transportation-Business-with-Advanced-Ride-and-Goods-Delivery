# Admin Panel update from previous version

---

- [Introduction](#section-1)
- [Update Instructions](#section-2)

<a name="section-1"></a>
## Introduction
In this article, we are going to update the admin panel source code from the previous version. 

<a name="section-2"></a>
## Update Instructions

### Update the latest code with your current proejct

* if you want to update the backend source code without your custom changes please follow the below steps.
    * Just download the files
    * replace all the files except the following files folers of your current project. .env file & public/push-configurations/firebase.json & vendor folder.
    * Delete the storage folder under public folder.
    * run the below commands
        * php artisan migrate
        * php artisan db:seed
        * php artisan storage:link

### Update the latest code with your current proejct after the customizations
 
 * First, push your code on a git branch. Then download our project code from codecanyon and push it to another branch. And at last marge both branch and it is possible to getting conflict on branch. Resolve it carefully. we won't be responsibe for if something went wrong.

 * Follow the sample video tutorial- https://youtu.be/mn9otng7Lho?si=9LNfpmTJ4cL6CL6N

 * after merging the latest updated code with your current code, please follow the steps.
        * Delete the storage folder under public folder.

    #### run the below commands
        * php artisan migrate
        * php artisan db:seed
        * php artisan storage:link   



