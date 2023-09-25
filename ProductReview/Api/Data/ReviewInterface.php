<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Api\Data;

interface ReviewInterface
{
    /**
     * Constants
     */
    const REVIEW_ID = 'review_id';
    const NICKNAME = 'nickname';
    const SUMMARY = 'sumarry';
    const REVIEW = 'review';
    const CREATED = 'created';
    const UPDATED = 'updated';
    const REVIEW_STATUS = 'review_status';
    const PRODUCT_SKU = 'product_sku';
    /**
     * @return int
     */
    public function getReviewId(): int;
    /**
     * @return string
     */
    public function getNickname(): string;
    /**
     * @return string
     */
    public function getSummary(): string;
    /**
     * @return string
     */
    public function getReview(): string;
    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt(): string;
    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt(): string;
    /**
     * @param int $reviewId
     * @return ReviewInterface
     */
    public function setReviewId(int $reviewId): ReviewInterface;
    /**
     * @param string $nickname
     * @return ReviewInterface
     */
    public function setNickname(string $nickname): ReviewInterface;
    /**
     * @param string $summary
     * @return ReviewInterface
     */
    public function setSummary(string $summary): ReviewInterface;
    /**
     * @param string $review
     * @return ReviewInterface
     */
    public function setReview(string $review): ReviewInterface;
    /**
     * Set created at
     *
     * @param string $createdAt
     * @return ReviewInterface
     */
    public function setCreatedAt(string $createdAt): ReviewInterface;
    /**
     * Set updated at
     *
     * @param string $updatedAt
     * @return ReviewInterface
     */
    public function setUpdatedAt(string $updatedAt): ReviewInterface;
    /**
     * @return string
     */
    public function getReviewStatus(): string;
    /**
     * @param string $updateStatus
     * @return ReviewInterface
     */
    public function setReviewStatus(string $updateStatus): ReviewInterface;
    /**
     * @return string
     */
    public function getProductSku(): string;
    /**
     * @param string $productSku
     * @return ReviewInterface
     */
    public function setProductSku(string $productSku): ReviewInterface;
}
