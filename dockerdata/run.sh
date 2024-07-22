#!/bin/bash

HOST="php-fpm"
PORT=9000
MAX_RETRY=90
PHP_CONNECTION=0
function check_php_connection() {
    >&2 echo "Testing connection to host $HOST and port $PORT."

    count=0
    while [ $count -lt $MAX_RETRY ]
    do
        count=$((count+1))
        nc -z $HOST $PORT
        result=$?
        if [ $result -eq 0 ]; then
            >&2 echo "Connection is available after $count second(s)."
    	    echo "100"
    	    exit
        fi
        >&2 echo "Retrying..."
        sleep 1
    done

    >&2 echo "Timeout occurred after waiting $MAX_RETRY seconds for $HOST:$PORT."
}


set -e

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
#    find ./storage/logs -type f -name "*.log" -delete
    chown -R www-data:www-data storage
    chmod -R 755 vendor
    chmod -R 644 bootstrap/cache
    chmod -R 777 storage
    chmod -R 777 storage/*
    chmod -R 777 /tmp
    chmod -R 777 bootstrap/cache
    permissions=$(stat -c%a storage/logs/.gitignore)
    chmod "$permissions" storage/logs/.gitignore
    composer install --no-interaction
    php artisan migrate --force
#    php artisan optimize
    php artisan queue:restart
    php artisan optimize:clear
    php artisan config:clear
    if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate
    fi
    php-fpm
elif [ "$role" = "nginx" ]; then
    PHP_CONNECTION=$(check_php_connection)
    nginx -g 'daemon off;'
    if [ "$PHP_CONNECTION" = "100" ]; then
        echo "Running the nginx ..."
        nginx -g 'daemon on;'
    fi
elif [ "$role" = "redis" ]; then
    echo never > /sys/kernel/mm/transparent_hugepage/enabled
    echo never > /sys/kernel/mm/transparent_hugepage/defrag
    sysctl -w net.core.somaxconn=512
    sysctl vm.overcommit_memory=1
    redis-server /usr/local/etc/redis/redis.conf --bind 0.0.0.0
elif [ "$role" = "nodewatch" ]; then
    npm install
    npm run watch
elif [ "$role" = "node" ]; then
    npm install
    npm run prod
else

    echo "Niezdefiniowane \"$role\""
    exit 1
fi

