<?php
/**
 * Created by PhpStorm.
 * User: Tagore·Jun
 * Date: 2017/5/31
 * Time: 10:53
 */

ini_set("display_errors","OFF");
error_reporting(E_ERROR);

const ACCESS_TOKEN = "accessToken";
const USER_INFO = "userinfo";
const OPEN_ID = "openid";

/**
 * 调试函数(打屏幕打印)
 * @param $content
 * @param bool $stop
 */
function pr($content, $stop = false)
{
    header("Content-Type:text/html;charset=utf-8");
    echo "<pre>";
    if (is_bool($content) || empty($content)){
        var_dump($content);
    }else{
        print_r($content);
    }
    echo "</pre>";
    $stop and die(0);
}

function pf($content, $coverage = false){
    $path = '/log/debug_'. date('md') .'.log';
    $dir = dirname($path);
    if(!is_dir($dir)){
        mkdir($dir);
    }
    file_put_contents($path, print_r($content, true) . "\n", $coverage ? null : FILE_APPEND);
}

function jump($url = null)
{
    if ($url) {
        header("Location: " . $url);
    } else {
        header("Location: ./home.html");
    }
    exit(0);
}

class Instance {

    private static $_instance = [];

    /**
     * @param null $cnf
     * @return static
     */
    public static function getInstance($cnf = null)
    {
        $key = md5(get_called_class());
        if (isset(self::$_instance[$key])){
            return self::$_instance[$key];
        }

        $instance =  self::$_instance[$key] = new static();
        if (!empty($cnf) && is_array($cnf)){
            foreach ($cnf as $key => $val) {
                $instance->$key = $val;
            }
        }
        return $instance;
    }
}

class Cookie  extends Instance {

    /**
     * @param string $key
     * @param $defaultValue
     * @return string
     */
    public function get($key = null, $defaultValue = '')
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : $defaultValue;
    }

    /**
     * @param $key
     * @param $value
     * @param $expire
     */
    public function set($key, $value, $expire = null)
    {
        if (is_array($value)){
            $value = json_encode($value);
        }
        setcookie($key, $value, $expire ? time() + intval($expire) : 0, '/');
    }
}

class Request extends Instance {

    public function get($key = null, $defaultValue = '')
    {
        if ($key) {
            $request = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $defaultValue;
        } else {
            $request = $_REQUEST;
        }

        return $request;
    }

    public function isTestDev()
    {
        return stripos($_SERVER["HTTP_HOST"], DOMAIN_TEST) !== false;
    }

    public function isOnLineDev()
    {
        return stripos($_SERVER["HTTP_HOST"], DOMAIN_ONLINE) !== false;
    }
}

class Http extends Instance {

    public function post($remoteServer, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remoteServer);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "qianyunlai.com's CURL Example beta");
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}


class WeChat extends Instance
{
    private $web_auth_callback='pro.cuithink.com/index.php';
    private $app_id='wx7bec172455adfdbb';
    private $app_secret='5c5e5024e8a373c160c40fee26a92beb';
    private $callback_action_url = '';   //TODO 该路径需要指向到本类中的callback方法
    private $mysql_db = '';
    private $redis = '';

    public function __construct()
    {
        $this->web_auth_callback =  $this->web_auth_callback;
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1',6379);
    }

    public function callback(Closure $callback)
    {
        $code = $this->getParameters('code');
        $state = $this->getParameters('state');

        if ($code != '') {
            $url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
            $url .= '?appid=' . $this->app_id;
            $url .= '&secret=' . $this->app_secret;
            $url .= '&code=' . $code;
            $url .= '&grant_type=authorization_code';
            $json = $this->setCurlGet($url);
            $result = $this->jsonToArray($json, '网页授权');

            $openid = '';
            if (count($result) > 0) {
                if (isset($result['openid'])) {
                    $openid = $result['openid'];
                    setcookie('wechat_openid', $openid);
                }

                $scope = isset($result['scope']) ? $result['scope'] : 'snsapi_base';
                if ($scope == 'snsapi_base') {
                    //$this->getWebAuthBase($state, 'snsapi_base');
                    $user_info['openid'] = $result['openid'];
                    $user_info['access_token'] = $result['access_token'];
                } else {
                    $access_token = isset($result['access_token']) ? $result['access_token'] : '';

                    $url_get_user_info = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token;
                    $url_get_user_info .= '&openid=' . $openid;
                    $url_get_user_info .= '&lang=zh_CN';

                    $json = $this->setCurlGet($url_get_user_info);
                    $result_user_info = $this->jsonToArray($json, '获取网页授权用户资料');

                    $user_info = $this->regroupUserInfo($result_user_info);
                    $user_info['source'] = 'web_auth';
                    $user_info['app_id'] = 'wx7bec172455adfdbb';
                    $user_info['nickname'] = base64_encode($user_info['nickname']);
                    try {
                        call_user_func($callback, $user_info);
                        $url = $this->getParameters('url');
                        if ($url != '') {
                            if (strpos($url, "?") === false) {
                                $url = urldecode($url) . '?openid=' . $openid;
                            } else {
                                $url = urldecode($url) . '&openid=' . $openid;
                            }
                            $this->url_redirect($url);
                        }
                    }catch (\Exception $e){
                        throw  $e;
                    }
                }
            }
        } else {
            //错误页面
            echo '授权失败';
            exit;
        }
    }

    /**
     * 网页授权并获取用户资料(需要用户确认)
     * @param string $config_name
     * @return string
     */
    public function getWebAuthUserInfo($config_name = 'default')
    {
        return $this->getWebAuthBase($config_name);
    }

    /**
     * JS SDK 网页授权(微信分享设置分享参数时调用)
     * @param $web_url
     * @return array
     */
    public function getJsSdkAuth($web_url)
    {
        $access_token = $this->getToken();

        $js_auth = array();
        if ($access_token) {
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
            $json = $this->setCurlGet($url);
            $result = json_decode($json, true);

            if (count($result) > 0) {
                $noncestr = mt_rand(10000, 99999);
                $jsapi_ticket = $result['ticket'];
                $timestamp = time();

                $signature_string = 'jsapi_ticket=' . $jsapi_ticket;
                $signature_string .= '&noncestr=' . $noncestr;
                $signature_string .= '&timestamp=' . $timestamp;
                $signature_string .= '&url=' . $web_url;

                $signature = sha1($signature_string);

                $js_auth = array(
                    'jsapi_ticket' => $jsapi_ticket,
                    'timestamp' => $timestamp,
                    'noncestr' => $noncestr,
                    'signature' => $signature,
                    'app_id' => $this->app_id
                );
            }
        }

        return $js_auth;
    }

    /**
     * 获取授权信息，并记录在服务器redis中
     * @return string
     */
    public function getToken()
    {
        $base = $this->getTokenByAppId($this->app_id);

        if (count($base) > 0) {
            if ($base['expires_in'] > time()) return $base['access_token'];
        }

        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential';
        $url .= '&appid=' . $this->app_id . '&secret=' . $this->app_secret;

        $json = $this->setCurlGet($url);
        $token_array = json_decode($json, true);

        if (count($token_array) > 0) {
            $data ['expires_in'] = $token_array['expires_in'] + time() - 600;
            $data ['access_token'] = $token_array['access_token'];
            $data['app_id'] = $this->app_id;
            $this->setToken($data);
        } else {
            $data ['access_token'] = '';
        }

        return $data['access_token'];
    }

    /*-------------------------------内部方法---------------------------------------------*/

    /**
     * 保存用户信息
     * @param $user_info
     */
    private function saveUserInfo($user_info)
    {
        //TODO 需要重写以下功能
        //创建用户

        //创建用户账户
        //记录用户登录
    }

    /**
     * 检查微信ID是否注册
     * @param $openid
     * @return bool
     */
    private function checkUserOpenid($openid)
    {
        //TODO 需要重写以下功能
        //根据openid查询数据库

        //判断用户是否注册，若已经注册，则更新用户最后登录时间，返回true；若该openid没有注册，则返回false
    }

    /**
     * 微信网页授权
     * @param $config_name
     * @param string $scope
     * @return string
     */
    private function getWebAuthBase($config_name, $scope = 'snsapi_base')
    {
        $openid = $this->getParameters('openid');
        $state = $this->getParameters('state');

        if ($openid == ''){
            $openid = $this->getCookie('wechat_openid');
        }

        if (($openid == '' && $state == '') || $scope == 'snsapi_userinfo') {
            $domain = 'http://' . $this->web_auth_callback;
            $original_url = $domain . $_SERVER['REQUEST_URI'];
            //以下的变量必须实现如此的效果：$domain . '/mobileqq/wechat/callback?url=' . urlencode($original_url);
//            $redirect_url = $domain .$this->callback_action_url. '?url=' . urlencode($original_url);
            $redirect_url = $domain .$this->callback_action_url;

            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize';
            $url .= '?appid=' . $this->app_id;
            $url .= '&redirect_uri=' . urlencode($redirect_url);
            $url .= '&response_type=code';
            $url .= '&scope=' . $scope;
            $url .= '&state=' . $config_name;
            $url .= '#wechat_redirect';
            $this->url_redirect($url);
            exit;
        }

        return $openid;
    }



    /**
     * 根据APPID获取TOKEN
     * @param $app_id
     * @return array
     */
    private function getTokenByAppId($app_id)
    {
       //TODO 从redis中取出对应app_id的access_token
        $redis_key = "access_token_" . $app_id ;
        $access_token=json_decode($this->redis->get($redis_key), true);
        return $access_token;
    }

    /**
     * 设置TOKEN
     * @param $data
     * @return mixed
     */
    private function setToken($data)
    {
        //TODO 将access_token存入redis中
        $redis_key = "access_token_" . $data['app_id'];
        unset($data['app_id']);
        $this->redis->set($redis_key, json_encode($data), 21600);
    }

    /**
     * 返回REQUEST参数
     * @param string $key
     * @param string $default_value
     * @return string
     */
    private function getParameters($key = '', $default_value = '')
    {
        if ($key) {
            $request = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default_value;
        } else {
            $request = $_REQUEST;
        }

        return $request;
    }

    /**
     * 返回COOKIE参数
     * @param string $key
     * @return string
     */
    private function getCookie($key = '')
    {
        if (!isset($_COOKIE)) return '';

        if ($key) {
            $cookie = isset($_COOKIE[$key]) ? $_COOKIE[$key] : '';
        } else {
            $cookie = $_COOKIE;
        }

        return $cookie;
    }

    /**
     * 重定向路径
     * @param $url
     * @param string $message
     */
    private function url_redirect($url, $message = '')
    {
        if ($message) echo "<script>alert('" . $message . "')</script>";

        echo "<script>window.location='" . $url . "'</script>";
    }

    /**
     * 模拟GET提交
     * @param $url
     * @param string $type
     * @return mixed
     */
    private function setCurlGet($url, $type = '')
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        if ($type == 'http') {
            $http_info = curl_getinfo($ch);        //HTTP头

            $data['data'] = $output;
            $data['http'] = $http_info;

            $output = $data;
        }

        curl_close($ch);

        return $output;
    }

    /**
     * 模拟POST提交
     * @param $url
     * @param $data
     * @return mixed
     */
    private function setCurlPost($url,$data)
    {
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_POST,1);				//POST提交
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);		//POST的内容

        $output = curl_exec($ch);	//返回值
        curl_close($ch);

        return $output;
    }

    /**
     * 重新拼装用户信息,避免API字段有更新导致错误
     * @param $result
     * @return mixed
     */
    private function regroupUserInfo($result)
    {
        $user_info['openid'] = isset($result['openid']) ? $result['openid'] : '';
        $user_info['unionid'] = isset($result['unionid']) ? $result['unionid'] : '';
        $user_info['app_id'] = isset($result['app_id']) ? $result['app_id'] : 'wx89cd201e97ee740c';
        $user_info['nickname'] = isset($result['nickname']) ? $result['nickname'] : '';
        $user_info['sex'] = isset($result['sex']) ? $result['sex'] : '0';
        $user_info['groupid'] = isset($result['groupid']) ? $result['groupid'] : '0';
        $user_info['city'] = isset($result['city']) ? $result['city'] : '';
        $user_info['province'] = isset($result['province']) ? $result['province'] : '';
        $user_info['country'] = isset($result['country']) ? $result['country'] : '';
        $user_info['language'] = isset($result['language']) ? $result['language'] : 'zh_CN';
        $user_info['headimgurl'] = isset($result['headimgurl']) ? $result['headimgurl'] : '';
        $user_info['subscribe'] = isset($result['subscribe_time']) ? $result['subscribe_time'] : 0;
        $user_info['remark'] = isset($result['remark']) ? $result['remark'] : '';
        $user_info['source'] = isset($result['source']) ? $result['source'] : '';
        $user_info['remark_custom'] = isset($result['remark_custom']) ? $result['remark_custom'] : '';
        $user_info['last_interact'] = isset($result['last_interact']) ? $result['last_interact'] : 0;

        return $user_info;
    }

    /**
     * 将返回的json字符串转成数组，请求API错误时记录错误日志
     * @param $json :请求API返回的json字符串
     * @param $msg :当前进行的操作信息
     * @return mixed
     */
    private function jsonToArray($json, $msg)
    {
        $array = json_decode($json, true);

        if (isset($array['errcode']) && $array['errcode'] != 0) {
            $array = array();
        }

        return $array;
    }
}

class Session extends Instance {
    private $data;

    public function __construct()
    {

        if(!session_id()){
            session_start();
        }
        $this->data = $_SESSION;
    }
    
    public function get($key, $default = '') {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    public function set($key, $val = null)
    {
        if (is_string($key)){
            $this->data[$key] = $_SESSION[$key] = $val;
        } elseif (is_array($key)) {
            foreach ($key as $k => $v){
                $this->set($k, $v);
            }
        }
    }

    public function remove($key)
    {
        if(isset($this->data[$key])){
            unset($this->data[$key]);
            unset($_SESSION[$key]);
        }
    }

    public function flashGet($key)
    {
        $val = $this->get($key);
        if ($val && is_array($val) && (array_pop($val) === 'flashSet')) {
            $v = $val[0];
            $this->remove($key);
            return $v;
        }
    }

    public function flashSet($key, $val)
    {
        $this->set($key, [$val, 'flashSet']);
    }
}

$cookie = Cookie::getInstance();
$weChat = WeChat::getInstance();
$request = Request::getInstance();
$session = Session::getInstance();


define("GO_BACK_URL", '_go_back_url_');
/*
 * 先判断本地是否用户登录的cookie信息,如果没有的话，去获取用户的openid
 *
 */

if (!$cookie->get(ACCESS_TOKEN)){

    //先取access_token
    //$access_token = $weChat->getToken();
    $type = $request->get('type');
    if (!$request->get('code') && !$request->get('state')){
        $href = $request->get('href');
        //获取code 和 state
        $weChat->getWebAuthUserInfo($href ? urlencode($href) : null);
    } else {
        $weChat->callback(function($userInfo) use ($cookie, $request){
            $login_url = 'http://produce.cuithink.com/index.php/common/open_id_is_exist';
            if ($userInfo) {
                $openid = $userInfo['openid'];
                $jsonStr = json_encode($userInfo);
                $result = Http::getInstance()->post($login_url, array(
                    'open_id' => $openid,
                    'thirdInfo' => $jsonStr
                ));

                if ($result) {
                    $json = json_decode($result, true);
                    if ($json['errCode'] == 0) {
                        $data = $json['data'];
                        $accessToken = $data['accessToken'];
                        $timeOut = $data['expire_time'];
                        $cookie->set(ACCESS_TOKEN, $accessToken, $timeOut);
                        $cookie->set(OPEN_ID, $data['open_id'], $timeOut);
//                        $cookie->set(USER_INFO, ['name' => $data['nickname'], 'figureurl' => $data['avatar']], $timeOut);
                        jump($request->get('state'));
                    } else {
                        throw new \Exception($json['errMsg']);
                    }
                }
                else {
                    throw new \Exception('网络错误');
                }
            }
        });
    }
} elseif (isset($_COOKIE[ACCESS_TOKEN]) &&  $_COOKIE[ACCESS_TOKEN]) {
    jump($request->get('state'));
}