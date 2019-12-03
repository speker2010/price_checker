<?php
namespace app\components;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use yii\base\Component;

class PhpWebdriver extends Component
{
    public function run()
    {
        $host = 'http://webdriver:4444/wd/hub';
        $chromeOptions = new ChromeOptions();
        $options = [
            '--headless',
            '--window-size=1200,1100',
            '--no-sandbox',
            '--disable-gpu'
        ];
        $chromeOptions->addArguments($options);
        $capabilities = DesiredCapabilities::chrome();
        //$capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);
        //$capabilities->setPlatform('Linux');
        $driver = RemoteWebDriver::create($host, $capabilities);
        $driver->get('https://www.detmir.ru/product/index/id/3193097/');
        try {
            $driver->wait()->until(
                function () use ($driver) {
                    $elements = $driver->findElements(WebDriverBy::cssSelector('#app-container ._2ELT__j ._3_UcZyU'));

                    return count($elements) > 0;
                },
                'Error wait'
            );
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return;
        }
        $price = $driver->findElement(WebDriverBy::cssSelector('#app-container ._2ELT__j ._3_UcZyU'));

        $priceText = $price->getText();
        var_dump($priceText);
        $driver->quit();
    }
}