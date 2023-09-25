<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Controller\Review;

use Techshop\ProductReview\Model\ReviewFactory as CustomReviewFactory;
use Magento\Review\Controller\Product as ProductController;
use Magento\Framework\Controller\ResultFactory;

class Save extends ProductController
{
    /**
     * @var CustomReviewFactory
     */
    protected $customReviewFactory;

    public function __construct(
        CustomReviewFactory $customReviewFactory,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Review\Model\RatingFactory $ratingFactory,
        \Magento\Catalog\Model\Design $catalogDesign,
        \Magento\Framework\Session\Generic $reviewSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
    ) {
        $this->customReviewFactory = $customReviewFactory;
        parent::__construct(
            $context,
            $coreRegistry,
            $customerSession,
            $categoryRepository,
            $logger,
            $productRepository,
            $reviewFactory,
            $ratingFactory,
            $catalogDesign,
            $reviewSession,
            $storeManager,
            $formKeyValidator
        );
    }


    /**
     * Booking action
     *
     * @return void
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $product = $this->initProduct();
        $post = (array) $this->getRequest()->getPost();

        try {
            $reviewData = [
                'review_id'     => (int)$product->getId(),
                'nickname'      => $post['nickname'],
                'summary'       => $post['summary'],
                'review'        => $post['review'],
                'review_status' => 'pending',
                'product_sku'   => $product->getSku()
            ];
            $this->reviewFactory->create()->setData($reviewData)->save();
            $this->messageManager->addSuccessMessage(__('Review submitted!'));
        } catch (\Throwable $e) {
            $this->messageManager->addErrorMessage(__('Error on submit form.'));
        }

        $redirectUrl = $this->reviewSession->getRedirectUrl(true);
        $resultRedirect->setUrl($redirectUrl ?: $this->_redirect->getRedirectUrl());
        return $resultRedirect;
    }
}
