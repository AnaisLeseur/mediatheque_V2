Appli de gestion d'une médiathèque 

Started at : 2021-11-22
Techno : PHP Symfony / PhpMyQL

Procédure : 

1 : paramétrage de la base de donnée : dans .env : variable DATABASE_URL à modifier au besoin 
2 : création de la bdd => symfony console d:d:c 
3 : passage des migrations => symfony console doctrine:migrations:migrate
4 : passage des fixtures => symfony console doctrine:fixtures:load
   => permets d'avoir en bdd 3 livres
   => 1 utilisateur 'ROLE_ADMIN' (username : admin@admin.com; mdp: admin) +  1 utilisateur 'ROLE_USER' (username : user@user.com; mdp: admin)
   => le user ROLE_USER à un livre rendu et un livre en cours de réservation. 

