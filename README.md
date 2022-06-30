# Ladder Admin
> 一个简单的 v2ray 管理后台

基于 dcat-admin 编写的 v2ray 管理后台。提供 Client 管理、流量统计、配置管理等功能。  
目前仍处于前期开发状态，仅供学习、参考，不建议进行使用。  
`v0.0.2`后，流量统计模块已经单独出一个golang服务，可以直接通过docker安装使用，只需填入正确配置，简单轻便十分舒爽： https://github.com/Lichmaker/v2ray-data-stat

# WARNING!!!
本项目已停止更新， 正在使用 glang 的 gin-vue-admin 进行重写。所有功能都会在新项目里得到重生 :)

## Installation 安装

环境依赖

请确保PHP环境已安装 `redis` 扩展
```
# 查看是否已安装 php-redis
> php -m | grep redis
> redis
```

克隆仓库到本地
```
git clone https://github.com/Lichmaker/ladder-admin.git
```

修改配置文件
```
cd ladder-admin
cp .env.example .env
vim .env
```
```
# .env 示例与说明：

# application 相关信息，可根据自己需求进行填写
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

# db 信息，请确保使用mysql并填入mysql链接信息
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# QUEUE_CONNECTION使用异步队列时填入对应驱动（如使用redis则填入redis），其余按需填写
BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# redis 信息，请确保填入准确 redis 链接信息
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# 按需填写
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

# 按需填写
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

# 按需填写
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

# 按需填写
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

# v2ray 在主机中的配置文件路径
V2RAY_CONFIG_PATH="/etc/v2ray/config.json"
# v2ray 在主机中的路径
V2RAY_DAEMON_PATH="/usr/bin/v2ray/v2ray"
# v2ctl 在主机中的路径
V2RAY_CLI_PATH="/usr/bin/v2ray/v2ctl"
# 在主机中执行重启v2ray的command
V2RAY_RESTART_COMMAND="service v2ray restart"
# v2ray 所在主机的IP，用于SSH
V2RAY_SERVER_IP=""
# 用于SSH登录的用户
V2RAY_SERVER_USER=""
# 用于SSH登录的端口
V2RAY_SERVER_SSH_PORT=""
# 用于SSH登录的 RSA public key 路径
V2RAY_SERVER_RSA_PUBLIC_KEY_PATH=""
# 用于SSH登录的 RSA private key 路径
V2RAY_SERVER_RSA_PRIVATE_KEY_PATH=""

# v2ray 配置中的链接host，用于 VMESS URL的生成，目前仅支持 TSL + WSS 的设置。
V2RAY_CONFIG_HOST=""
# v2ray 配置中的链接url path，用于 VMESS URL的生成，目前仅支持 TSL + WSS 的设置。
V2RAY_CONFIG_URL_PATH=""

# 流量统计的月重置日期设置
BANDWIDTH_RESET_DATE="1"
```

执行安装
``` 
php artisan ladder-admin:install
```

安装 ` supervisor ` 并启动 ` horizon `。 请先确保 PHP 所在环境中已经安装 ` redis ` 扩展。

```
# .env
QUEUE_CONNECTION=redis

# supervisor 配置文件 horizon.ini
[program:horizon]
process_name=%(program_name)s
command=php /{$项目绝对路径}/artisan horizon
autostart=true
autorestart=true
user=wuguozhang
redirect_stderr=true
stdout_logfile=/var/log/ladder-admin-horizon.log
stopwaitsecs=3600

```

## Demo 示例

todo. Demo 链接正在准备当中。

## Release History 发布历史

* 0.1.0
    * 2021-07-12
    * 修复流量统计bug。已稳定运行一周时间，真の勉强能用的版本
* 0.0.2
    * 2021-07-05
    * 流量统计单独出golang服务，发布一个勉强能用的版本
* dev-master
    * 仍在前期开发中

## Contact

吴国章 - Guozhang Wu - Lichmaker – Twitter:[@lichmaker](https://twitter.com/lichmaker) - Weibo:[@神经考拉君](https://weibo.com/v5zhang) – Email: lich.wu2014@gmail.com


## Contributing 

因为仍在前期开发中，代码会进行频繁重构、大改，所以暂不接受 PR。如果有好的建议，欢迎提交 issue。

## Licence

Distributed under the MIT license. See ``LICENSE`` for more information.

[https://github.com/Lichmaker/ladder-admin](https://github.com/Lichmaker/ladder-admin)
