<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Ui\Component\Review\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Review\Model\ResourceModel\Review\Status\CollectionFactory;

class Status extends Column
{
    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * RegionLabel constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CollectionFactory $collection
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $collection,
        array $components = [],
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Replace region_id value with its label in each row of the grid
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $statusId = $item[$this->getData('name')];
                $status = $this->collection->create()->getItemById($statusId);
                $statusLabel = $status->getStatusCode();
                $item[$this->getData('name')] = $statusLabel;
            }
        }

        return $dataSource;
    }
}
