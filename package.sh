#!/bin/bash

# remove old files
rm ispring.zip ispring.tar.gz

# zip up the plugin
cp ./README.md ispring
zip -x "ispring/.env" -x "ispring/.htaccess" -x "ispring/.gitignore" -r ispring.zip ispring
rm ispring/README.md
