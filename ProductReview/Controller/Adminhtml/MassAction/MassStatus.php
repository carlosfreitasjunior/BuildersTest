<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Controller\Adminhtml\MassAction;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Techshop\ProductReview\Model\ResourceModel\Review\CollectionFactory;

class MassStatus extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;
    /**
     * Dependency Initilization
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    /**
     * Provides content
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $status = $this->getRequest()->getParam('status');
            $statusLabel = $status ? "approved" : "not_approved";

            $count = 0;
            foreach ($collection as $model) {
                $model->setReviewStatus($status);
                $model->save();
                $count++;
            }
            $this->messageManager->addSuccess(__('A total of %1 review(s) have been %2.', $count, $statusLabel));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('techshop/products/review');
    }
}
