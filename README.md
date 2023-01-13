# PROJECT BY CHU WUNG BERTRAND
# REASON FOR CREATION: EXAM
# PROJECT NAME: MYSHOES (ECOMMERCE)

# LANGUAGES                     # FRAMEWORKS

- JAVASCRIPT                    - BootStrap 5
- PHP 8                         - Symfony v 6.1




- Coded the normal html and css template for the website.
- Created a Private repository on github. 
- Passed the symfony command (symfony myshoes --version="6.1.*" --webapp) to create the project.
- Make home controller (symfony console make:controller)


# 05/01/2023

- Création de entité User avec `symfony console make:entity`.
- Créer le bdd avec `symfony console doctrine:database:create`
- Et fait la migration entre l'entité et le bdd.
- Faire page d'inscription
- finished the inscription page
- flushed it into the database
- Created the login page with `symfony console make:auth`

# 06/01/2023

- Created the backend office with easyAdmin using `composer require admin`
- Created a crud entity for User`symfony console make:admin:crud`
- Created the dashboard with `symfony console make:admin:dashboard`
- Create category entity `symfony console make:entity`
- Created a crud entity for Category.
- Create genrechaus entity
- Created a crud entity for genrechaus.
- Create product entity
- Created a crud entity for product.
- Did a `ManyToOne relation` between "product -> category"
- Did a `ManyToMany relation` between "product -> genrechaus"
- Displayed all the men's shoes on the vue
- Did the search bar

# 07/01/2023

