<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Block;

use Techshop\ProductReview\Model\Config;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Url\EncoderInterface;
use Magento\Review\Helper\Data;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Review\Model\RatingFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Customer\Model\Url;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Customer\Model\Session;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Sales\Model\Order\Config as OrderConfig;
use Magento\Framework\Serialize\Serializer\Json;

class Form extends \Magento\Review\Block\Form
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var ProductMetadataInterface
     */
    protected $productMetadata;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * @var OrderConfig
     */
    protected $orderConfig;

    /**
     * Form constructor.
     * @param Context $context
     * @param EncoderInterface $urlEncoder
     * @param Data $reviewData
     * @param ProductRepositoryInterface $productRepository
     * @param RatingFactory $ratingFactory
     * @param ManagerInterface $messageManager
     * @param HttpContext $httpContext
     * @param Url $customerUrl
     * @param ProductMetadataInterface $productMetadata
     * @param Session $customerSession
     * @param CollectionFactory $orderCollectionFactory
     * @param OrderConfig $orderConfig
     * @param array $data
     * @param Json|null $serializer
     * @param Config $config
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Config $config,
        Context $context,
        EncoderInterface $urlEncoder,
        Data $reviewData,
        ProductRepositoryInterface $productRepository,
        RatingFactory $ratingFactory,
        ManagerInterface $messageManager,
        HttpContext $httpContext,
        Url $customerUrl,
        ProductMetadataInterface $productMetadata,
        Session $customerSession,
        CollectionFactory $orderCollectionFactory,
        OrderConfig $orderConfig,
        array $data = []
    ) {
        $this->config = $config;
        $this->productMetadata = $productMetadata;
        $this->_customerSession = $customerSession;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_orderConfig = $orderConfig;
        parent::__construct(
            $context,
            $urlEncoder,
            $reviewData,
            $productRepository,
            $ratingFactory,
            $messageManager,
            $httpContext,
            $customerUrl,
            $data
        );
    }

    protected function _construct()
    {
        parent::_construct();

        $this->setTemplate('Techshop_ProductReview::review.phtml');
    }

    /**
     * Get product info
     *
     * @return \Magento\Catalog\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductInfo()
    {
        return $this->productRepository->getById(
            $this->getProductId(),
            false,
            $this->_storeManager->getStore()->getId()
        );
    }

    /**
     * Get review product post action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getUrl(
            'techshop_productreview/review/save',
            [
                '_secure' => $this->getRequest()->isSecure(),
                'id' => $this->getProductId(),
            ]
        );
        
    }

    /**
     * Get review product is enabled
     *
     * @return bool
     */
    public function getReviewProductIsEnabled()
    {
        return $this->config->isProductReviewEnabled();
    }
}
