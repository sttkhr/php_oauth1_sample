<?php
/**
 * APIの利用者 Comsumer は APIを提供する Service Provider に
 * あらかじめ Consumer として登録します。
 * Service Providerは Consumer に Consumer Key と Consumer Secret を発行します。
 * 
 * ※ 複数Consumer になることが多いため 、DBで Comsumer情報を管理することが多い。
 */ 
//Consumer 識別子
const CONSUMER_KEY = 'consumerkeyconsumerkeyconsumerkeyconsumerkey';
//Consumer 共有鍵
const CONSUMER_SECRET = 'consumersecretconsumersecretconsumersecret';



define('PATH_LOG_DIR_PROVIDER' , dirname(__FILE__) . '/../log');
define('PATH_LOG_MODULE_PROVIDER' , dirname(__FILE__) . '/../module');

include_once(PATH_LOG_MODULE_PROVIDER . '/sample_oauth_provider.php');
