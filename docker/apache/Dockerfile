FROM wordpress:4.7.3-php5.6-apache
MAINTAINER ok17 <kashimura@fotome.jp>

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

## setting xdebug

## docker 利用して IDE の デバッグを機能させる場合は
## remote_connect_back=0 を設定すること
RUN { \
		echo 'xdebug.enable=1'; \
		echo 'xdebug.remote_enable=1'; \
		echo 'xdebug.remote_connect_back=0'; \
	    echo 'xdebug.remote_autostart=1'; \
        echo 'xdebug.idekey=PHPSTORM'; \
        echo 'xdebug.remote_host=10.254.254.254'; \
        echo 'xdebug.profiler_enable=0'; \
        echo 'xdebug.remote_port=9000'; \
} > "$PHP_INI_DIR/conf.d/xdebug.ini"

RUN { \
        echo 'upload_max_filesize = 32M'; \
        echo 'post_max_size = 32M'; \
} > "$PHP_INI_DIR/conf.d/fileupload.ini"