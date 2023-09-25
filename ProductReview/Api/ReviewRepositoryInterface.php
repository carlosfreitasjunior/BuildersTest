<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Api;

use Techshop\ProductReview\Api\Data\ReviewInterface;
use Techshop\ProductReview\Api\Data\ReviewSearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ReviewRepositoryInterface
{
    /**
     * Delete review.
     *
     * @param ReviewInterface $review
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(ReviewInterface $review): bool;
    /**
     * Delete review by ID.
     *
     * @param int $reviewId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $reviewId): bool;
    /**
     * Retrieve review.
     *
     * @param int $reviewId
     * @return ReviewInterface
     * @throws LocalizedException
     */
    public function getById(int $reviewId): ReviewInterface;
    /**
     * Retrieve review matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReviewSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
    /**
     * Save review.
     *
     * @param ReviewInterface $review
     * @return ReviewInterface
     * @throws LocalizedException
     */
    public function save(ReviewInterface $review): ReviewInterface;
}