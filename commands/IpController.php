<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\PhpQueryWrapper;
use app\models\CurlWrapper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IpController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionExternalIp() {
        $parser = new PhpQueryWrapper();
        $curl = new CurlWrapper();
        $curl->host = '2ip.ru';
        $curl->protocol = 1;
        $parser->ip_selector = '.ip big#d_clip_button';
        $httpData = $curl->execute();
        $parser->page = $httpData['page'];
        $externalIp = $parser->parseIp();
        if (!empty($externalIp)) {
            $this->sendMail('spekersoft@yandex.ru', 'External ip', $externalIp);
        }
    }

    private function sendMail($address, $subject, $body) {
        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $mail_body = '<html><head><title>'.$subject.'</title></head><body><h2>'.$subject.'</h2>'.$body.'</body></html>';
        mail($address, $subject, $mail_body, $headers.'From:no-reply@gmail.com');
    }
}
