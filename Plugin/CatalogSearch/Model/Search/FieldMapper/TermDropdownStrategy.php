<?php

namespace Amasty\ImprovedSearch\Plugin\CatalogSearch\Model\Search\FieldMapper;

use Magento\CatalogSearch\Model\Search\FilterMapper\TermDropdownStrategy as MagentoTermDropdownStrategy;

class TermDropdownStrategy
{
    /**
     * @var \Amasty\ImprovedSearch\Model\TermDropdownStrategy
     */
    protected $dropDownStrategy;

    /**
     * @var \Amasty\ImprovedSearch\Helper\Data
     */
    protected $helper;

    /**
     * TermDropdownStrategy constructor.
     * @param \Amasty\ImprovedSearch\Model\TermDropdownStrategy $dropdownStrategy
     * @param \Amasty\ImprovedSearch\Helper\Data $helper
     */
    public function __construct(
        \Amasty\ImprovedSearch\Model\TermDropdownStrategy $dropdownStrategy,
        \Amasty\ImprovedSearch\Helper\Data $helper
    ) {
        $this->dropDownStrategy = $dropdownStrategy;
        $this->helper = $helper;
    }

    /**
     * @param MagentoTermDropdownStrategy $subject
     * @param callable $proceed
     * @param \Magento\Framework\Search\Request\FilterInterface $filter
     * @param \Magento\Framework\DB\Select $select
     * @return bool
     */
    public function aroundApply(
        MagentoTermDropdownStrategy $subject,
        callable $proceed,
        \Magento\Framework\Search\Request\FilterInterface $filter,
        \Magento\Framework\DB\Select $select
    ) {
        if ($this->helper->isEnabled()) {
            return $this->dropDownStrategy->apply($filter, $select);
        }
        return $proceed($filter, $select);
    }
}
