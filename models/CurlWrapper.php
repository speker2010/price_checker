<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CurlWrapper extends Model
{
    /**
    * @var string relative path on the site. Like a '/product/34234.html'
    */
    public $product_uri;
    /**
    * @var {0|1} (1) ? https : http ; 
    */
    public $protocol;
    /**
    * @var string Domain of the site. Like a 'www.google.com'
    */
    public $host;
    private $user_agent;
    private $url;
    private $curl;
    public $cookies;

    const USER_AGENT_DEFAULT = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36';


    public function execute()
    {
        $this->url = $this->genUrl();
        if ($this->url === false) return false;
        $this->curl = curl_init($this->url);
        $this->user_agent = self::USER_AGENT_DEFAULT;
        curl_setopt($this->curl, CURLOPT_USERAGENT, $this->user_agent);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($this->cookies)) {
            curl_setopt($this->curl, CURLOPT_COOKIE, $this->cookies);
        }
        $result = [];
        $result['page'] = curl_exec($this->curl);
        $result['http_code'] = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        curl_close($this->curl);
        return $result;
    }

    public function genUrl()
    {
        $result = false;
        if (!empty($this->host)) {
            $protocol = ($this->protocol === 1) ? 'https://' : 'http://';
            $result = $protocol . $this->host . $this->product_uri;
        }
        return $result;
    }
}
