<?php
namespace app\components;

use app\models\Prices;
use app\models\ProductPage;
use yii\base\Component;

class ParserBase extends Component implements ParserInterface
{
    protected $price;
    /**
     * @var ProductPage
     */
    public $page;

    public function __construct(Prices $price, $config = [])
    {
        $this->price = $price;
        parent::__construct($config);
    }
}