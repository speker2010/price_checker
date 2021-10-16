<?php
namespace app\components;

use app\models\CurlWrapper;
use app\models\PhpQueryWrapper;
use app\models\Prices;

class PhpQueryParser extends ParserBase implements ParserInterface
{
    private $_phpQuery;
    private $_curl;

    public function __construct(Prices $price, PhpQueryWrapper $phpQuery, CurlWrapper $curl, $config = [])
    {
        $this->_phpQuery = $phpQuery;
        $this->_curl = $curl;
        parent::__construct($price, $config);
    }

    public function parse()
    {

    }
}