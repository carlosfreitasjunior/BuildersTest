<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Model;

use Techshop\ProductReview\Api\Data\ReviewInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Review extends AbstractExtensibleModel implements ReviewInterface, IdentityInterface
{
    const CACHE_TAG = 'techshop_productreview_review';
    protected function _construct()
    {
        $this->_init(ResourceModel\Review::class);
        $this->setIdFieldName('review_id');
    }
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getReviewId()];
    }
    public function getReviewId(): int
    {
        return $this->getData(self::REVIEW_ID);
    }
    public function getNickname(): string
    {
        return $this->getData(self::NICKNAME);
    }
    public function getSummary(): string
    {
        return $this->getData(self::SUMMARY);
    }
    public function getReview(): string
    {
        return $this->getData(self::REVIEW);
    }
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED);
    }
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED);
    }
    public function setReviewId(int $reviewId): ReviewInterface
    {
        return $this->setData(self::REVIEW_ID, $reviewId);
    }
    public function setNickname(string $nickname): ReviewInterface
    {
        return $this->setData(self::NICKNAME, $nickname);
    }
    public function setSummary(string $summary): ReviewInterface
    {
        return $this->setData(self::SUMMARY, $summary);
    }
    public function setReview(string $review): ReviewInterface
    {
        return $this->setData(self::REVIEW, $review);
    }
    public function setCreatedAt(string $createdAt): ReviewInterface
    {
        return $this->setData(self::CREATED, $createdAt);
    }
    public function setUpdatedAt(string $updatedAt): ReviewInterface
    {
        return $this->setData(self::UPDATED, $updatedAt);
    }
    public function getReviewStatus(): string
    {
        return $this->getData(self::REVIEW_STATUS);
    }
    public function setReviewStatus(string $reviewStatus): ReviewInterface
    {
        return $this->setData(self::REVIEW_STATUS, $reviewStatus);
    }
    public function getProductSku(): string
    {
        return $this->getData(self::PRODUCT_SKU);
    }
    public function setProductSku(string $productSku): ReviewInterface
    {
        return $this->setData(self::PRODUCT_SKU, $productSku);
    }
    /**
     * Prepare data before saving
     *
     * @return ReviewInterface
     */
    public function beforeSave(): ReviewInterface
    {
        if ($this->isObjectNew() && !$this->getCreatedAt()) {
            $this->setCreatedAt(date("Y-m-d H:i:s"));
        }
            $this->setUpdatedAt(date("Y-m-d H:i:s"));
        return parent::beforeSave();
    }
}
