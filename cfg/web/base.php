<?php
/**
 * Ar default public config file.
 *
 */
return array(
    // 用户登陆有效时长 一个月
    'USER_VALID_TIME' => 60 * 60 * 24 * 365,

    // 组件配置
    'components' => array(
        // 依赖懒加载组件
       'lazy' => true,
       'rpc' => array(
            'service' => array(
                'config' => array(
                    // 服务地址 改为自己的地址
                    'wsFile' => 'http://localhost/task/server/arws.php',
                    // 使用线上的API
                    //'wsFile' => 'http://120.24.7.188:8082',
                    // 'wsFile' => 'http://127.0.0.1:8082',
                    'authSign' => array(
                        'AUTH_SERVER_OPKEY' => 'seraagaldnialaldshgadl12312lasdfaaa',
                    )
                ),
            ),
        ),
    ),

    // 核心模块域名映射
    'moduleLists' => [
        'www.angpy.com' => 'coop'
    ],

    // 非编译模板
    'TPL_NOT_PARSE_LIST' => ['jquery-3.3.1.min.js' , 'layui.js', 'font-awesome.min.css', 'layui.css', 'jquery.color.js'],


);
