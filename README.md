run following comands 
gulp
cd src
npm install -g browser-sync
php -S localhost:8000
browser-sync start --proxy "localhost:8000" --files "**/*.php, **/*.html, **/*.css, **/*.js"
