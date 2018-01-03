<?php

namespace Amasty\ImprovedSearch\Plugin\Framework\App;


use Magento\Framework\App\Config as MagentoConfig;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Amasty\ImprovedSearch\Helper\Data as Helper;
/**
 * Class Config
 */
class Config
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    protected $helper;

    /**
     * Config constructor.
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\Registry $registry
    ){
        $this->registry = $registry;
    }

    /**
     * @param MagentoConfig $subject
     * @param callable $proceed
     * @param $path
     * @param string $scope
     * @param null $scopeCode
     * @return bool
     */
    public function aroundIsSetFlag(
        MagentoConfig $subject,
        callable $proceed,
        $path,
        $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeCode = null
    ) {
        if ($this->registry->registry(Helper::SKIP_DISPLAY_OUT_OF_STOCK_CHECK)
            && $path === 'cataloginventory/options/show_out_of_stock'
        ) {
            return true;
        }
        return $proceed($path, $scope, $scopeCode);
    }
}
