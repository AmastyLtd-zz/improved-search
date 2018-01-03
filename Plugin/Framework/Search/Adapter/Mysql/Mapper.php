<?php

namespace Amasty\ImprovedSearch\Plugin\Framework\Search\Adapter\Mysql;

use Magento\Framework\Search\Adapter\Mysql\Mapper as MagentoMysqlMapper;
use Magento\Framework\Search\RequestInterface;
use Amasty\ImprovedSearch\Helper\Data as Helper;

class Mapper
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var Helper
     */
    protected $helper;

    /**
     * Mapper constructor.
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Amasty\ImprovedSearch\Helper\Data $helper
    ) {
        $this->registry = $registry;
        $this->helper = $helper;
    }

    /**
     * @param MagentoMysqlMapper $subject
     * @param callable $proceed
     * @param RequestInterface $request
     * @return mixed
     */
    public function aroundBuildQuery(MagentoMysqlMapper $subject, callable $proceed, RequestInterface $request)
    {
        if ($this->helper->isEnabled()) {
            if ($this->registry->registry(Helper::SKIP_DISPLAY_OUT_OF_STOCK_CHECK) === null) {
                $this->registry->register(Helper::SKIP_DISPLAY_OUT_OF_STOCK_CHECK, true);
            }

            $result = $proceed($request);
            $this->registry->unregister(Helper::SKIP_DISPLAY_OUT_OF_STOCK_CHECK);
            return $result;
        }
        return $proceed($request);
    }
}
