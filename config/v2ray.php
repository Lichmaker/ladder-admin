<?php
return [

    /**
     * v2ctl 路径
     */
    'cli_path' => env('V2RAY_CLI_PATH', '/usr/bin/v2ray/v2ctl'),

    /**
     * v2ray 路径
     */
    'daemon_path' => env('V2RAY_DAEMON_PATH', '/usr/bin/v2ray/v2ray'),

    /**
     * v2ray 配置文件路径
     */
    'config_path' => env('V2RAY_CONFIG_PATH', '/etc/v2ray/config.json'),

    /**
     * v2ray 重启命令
     */
    'restart_command' => env('V2RAY_RESTART_COMMAND', 'service v2ray restart'),

    /**
     * v2ray 所在机器IP
     */
    'server_ip' => env('V2RAY_SERVER_IP', '127.0.0.1'),

    /**
     * 操作 v2ray 的用户
     */
    'server_user' => env('V2RAY_SERVER_USER', 'root'),

    /**
     * v2ray 所在机器ssh端口
     */
    'server_ssh_port' => env('V2RAY_SERVER_SSH_PORT', 22),

    /**
     * 登录到 v2ray 所在服务器需要的 rsa 公、私钥
     */
    'server_rsa_public_key' => env('V2RAY_SERVER_RSA_PUBLIC_KEY_PATH', ''),
    'server_rsa_private_key' => env('V2RAY_SERVER_RSA_PRIVATE_KEY_PATH', ''),

    /**
     * v2ray 配置中的主域名 host
     */
    'config_host' => env('V2RAY_CONFIG_HOST', 'localhost'),

    /**
     * v2ray 配置中的 wss path
     */
    'config_url_path' => env('V2RAY_CONFIG_URL_PATH', '/'),

    /**
     * vmess 配置名称，主要用于GUI显示
     */
    'config_name' => env('V2RAY_CONFIG_NAME', 'my_config'),

    /**
     * v2ray 的 grpc host，用于流量统计
     */
    'grpc_host' => env('V2RAY_GPRC_HOST', '127.0.0.1:80'),

    /**
     * 每月流量统计重制日期
     */
    'bandwidth_reset_date' => env('BANDWIDTH_RESET_DATE', '01'),
];
