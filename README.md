# MotorStore

BASE DE DONNEES : 
    Une copie est présente dans le dossier sous le nom : motoproject.sql

PAIEMENT : 
    Pour faire des tests de paiement, le code de la carte est le 4242 4242 4242 4242. 
    Tout autre code devrait mener à une erreur

TESTS : 
    1 -> php bin/console doctrine:database:create --env=test
    2 -> Transférer la base de données sur la base tests
    3 -> Pour lancer les tests : php bin/phpunit