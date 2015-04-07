#!/bin/sh

rsync -rav --progress --exclude=extra-config.php --exclude=wp-config.php * root@70.32.112.75:/home/randomnerds/public_html/wp-content/themes/random-nerds
