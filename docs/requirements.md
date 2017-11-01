# Herobook - Facebook for Superheroes!

Create a website that helps superheroes stay in touch with their superfriends.

## Objectives and requirements

To complete the assignment, you must:

1. Create a public repo in your personal Github account.
2. Create PHP and markdown files and add them to your project.
3. Create a local database (for development).
3. Push your code to Github.
4. Deploy your application and database to Heroku.

You may use a CSS framework for styling if you wish. You can use Facebook's styling for inspiration or develop your own look and feel.

## Data

The supplied superheroes.sql file contains create table and insert statements to get you started. You will need to customize the data a little, since image links were not provided. You can make other changes, too, if you wish.

## Application file structure

Minimally:

  index.php - menu page
  docs/
    requirements.md
  README.md
  Procfile
  composer.json

Make sure there's something to read in your README file.

It's okay if your project has more files, or if you organize your code with subdirectories, but at the least you need the ones listed above.

## Required Page

Your index.php file should list all the superheroes in your database.

Each superhero listing should contain:
  * Name
  * Thumbnail image of their profile picture
  * About Me (this is a field in the hero table)

## Remember to push to Github!

Your repo should be public so that others can see your code and comment on it.

## Remember to deploy to Heroku!

PHP projects do not need an Express server.

You will need to include a Procfile so Heroku knows how to start your server.

You will also need to add a PostgreSQL database to your Heroku app 
and duplicate your data there.

## Stretch Goals

If you complete the basic superhero roster, your next step is to make each hero's name a link that opens their profile page.

Profile pages should display:
  * Name
  * Large profile image
  * About Me
  * Biography

It would be cool if they also displayed:
  * List of the hero's allies
  * List of the hero's enemies
  * List of the hero's abilities

Each ally and enemy name should also be a profile page link.

Profile pages should include a link to return to the roster (index.php).