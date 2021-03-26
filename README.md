Git global setup
git config --global user.name "ITSL-Admin"
git config --global user.email "git@yeshostings.com"

Create a new repository
git clone git@git.yeshostings.com:laravel/halal-deals.git
cd halal-deals
touch README.md
git add README.md
git commit -m "add README"
git push -u origin master

Push an existing folder
cd existing_folder
git init
git remote add origin git@git.yeshostings.com:laravel/halal-deals.git
git add .
git commit -m "Initial commit"
git push -u origin master

Push an existing Git repository
cd existing_repo
git remote rename origin old-origin
git remote add origin git@git.yeshostings.com:laravel/halal-deals.git
git push -u origin --all
git push -u origin --tags