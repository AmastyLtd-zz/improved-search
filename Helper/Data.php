<?php

namespace Amasty\ImprovedSearch\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    const SKIP_DISPLAY_OUT_OF_STOCK_CHECK = 'skip_display_out_of_stock_check';

    /**
     * @var \Magento\Framework\App\ProductMetadata
     */
    protected $metaData;

    /**
     * Data constructor.
     * @param Context $context
     * @param \Magento\Framework\App\ProductMetadata $metaData
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\ProductMetadata $metaData
    ) {
        parent::__construct($context);
        $this->metaData = $metaData;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return version_compare($this->metaData->getVersion(), '2.2.0', '<')
            && $this->scopeConfig->isSetFlag(
            'amimproved_search\general\enabled',
            \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
    }
}
