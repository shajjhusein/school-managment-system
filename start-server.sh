#!/bin/bash
cd src
php -S localhost:8000 &
browser-sync start --proxy "localhost:8000" --files "**/*.php, **/*.html, **/*.css, **/*.js"
