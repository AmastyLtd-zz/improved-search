<?php

namespace Amasty\ImprovedSearch\Plugin\CatalogSearch\Model\Search;

use Magento\CatalogSearch\Model\Search\IndexBuilder as MagentoIndexBuilder;
use Magento\Framework\Search\RequestInterface;

class IndexBuilder
{
    /**
     * @var \Amasty\ImprovedSearch\Model\IndexBuilder
     */
    protected $improvedSearchIndexBuilder;

    /**
     * @var \Amasty\ImprovedSearch\Helper\Data
     */
    protected $helper;

    /**
     * IndexBuilder constructor.
     * @param \Amasty\ImprovedSearch\Model\IndexBuilder $indexBuilder
     * @param \Amasty\ImprovedSearch\Helper\Data $helper
     */
    public function __construct(
        \Amasty\ImprovedSearch\Model\IndexBuilder $indexBuilder,
        \Amasty\ImprovedSearch\Helper\Data $helper
    ) {
        $this->improvedSearchIndexBuilder = $indexBuilder;
        $this->helper = $helper;
    }

    /**
     * Build index query
     *
     * @param RequestInterface $request
     * @return Select
     * @throws \LogicException
     */
    public function aroundBuild(MagentoIndexBuilder $subject, callable $proceed, RequestInterface $request)
    {
        if ($this->helper->isEnabled()) {
            return $this->improvedSearchIndexBuilder->build($request);
        }
        return $proceed($request);
    }
}
