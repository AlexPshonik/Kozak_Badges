<?php

namespace Kozak\Badges\Block;

use Magento\Catalog\Model\Product;

class Badges extends \Magento\Framework\View\Element\Template
{
    protected $_label = 'kozak_badges';
    /**
     *  @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    public function getProduct()
    {
        if(!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    private function badgeLabelToClass($badge)
    {
        $_badge = strtolower($badge);
        $_badge = str_replace(' ', '-', $_badge);
        return $_badge;
    }

    public function getBadge($product)
    {
        $this->_product = $product;
        $_badges = [];

        $_badgesVal = $this->_product->getAttributeText($this->_label);
        if (is_string($_badgesVal)) {
            $_badgesVal = [$_badgesVal];
        }

        for($i = 0; $i < count($_badgesVal); $i++){
            $_badges[$i]['label'] = $_badgesVal[$i];
            $_badges[$i]['class'] = $this->badgeLabelToClass($_badgesVal[$i]);
        }

        return $_badges;
    }
}