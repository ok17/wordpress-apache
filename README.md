## README


## xdebug with docker 


`apache/Dockerfile`にある下記の記載はxdebugを使用するための設定

```Dockerfile:apache/Dockerfile
		echo 'xdebug.enable=1'; \
		echo 'xdebug.remote_enable=1'; \
		echo 'xdebug.remote_connect_back=0'; \
    	echo 'xdebug.remote_autostart=1'; \
        echo 'xdebug.idekey=PHPSTORM'; \
        echo 'xdebug.remote_host=10.254.254.254'; \
        echo 'xdebug.profiler_enable=0'; \
        echo 'xdebug.remote_port=9000'; \
```

--

あらかじめ下記コマンドを実行し、NICを生成

`sudo ifconfig en0 alias 10.254.254.254 255.255.255.0`

この設定はDocker for Mac でデバックをする時の設定としてわすれないように

`xdebug.remote_connect_back=0`

`xdebug.remote_host=10.254.254.254`

xdebugからの通信先を設定している。

[参照](https://gist.github.com/chadrien/c90927ec2d160ffea9c4)

--


## PhpStorm Xdebug 

Languages & Frameworks > PHP > Debug > DBGp Proxy

`IDE key: PHPSTORM`

`Host: 10.254.254.254`

`Port: 9000`




### hoge
### hoge
