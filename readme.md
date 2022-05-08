Projet "LMS" sous symfony 5.4 (Plateforme E-learning). Lien: https://lms.sigmaformations.fr
Lien du theme utilisé: https://demo.dashboardpack.com/architectui-html-pro/index.html

INSTALLATION LOCAL:

1) lancer xamp ou wamp
2) se mettre dans le dossier htdocs de xamp et lancer la commande "git clone https://github.com/MehdiBoumediene/LMS.git"
3) "composer install"
4) "npm install"
5) "npm run build"
6) le fichier ".env" est requis

Base de données:
1) php bin/console doctrine:database:create
2) php bin/console doctrine:migrations:migrate

Lancer le serveur web de l'application:
3) lancer la commande: .\symfony.exe local:server:start 

Adresse local (index):
http://localhost:80000/public/

Créer utilisateur admin pour se connecter:
http://localhost:80000/public/register
