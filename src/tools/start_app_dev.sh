#!/bin/bash
cd `dirname $0`
cd ..

npm i
composer install

npm run dev-server --port=8000
