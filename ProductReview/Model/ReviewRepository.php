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
use Techshop\ProductReview\Api\Data\ReviewInterfaceFactory;
use Techshop\ProductReview\Api\Data\ReviewSearchResultsInterface;
use Techshop\ProductReview\Api\Data\ReviewSearchResultsInterfaceFactory;
use Techshop\ProductReview\Api\ReviewRepositoryInterface;
use Techshop\ProductReview\Model\ResourceModel\Review as ResourceReview;
use Techshop\ProductReview\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Post repository
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ReviewRepository implements ReviewRepositoryInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var ResourceReview
     */
    private $resource;
    /**
     * @var ReviewCollectionFactory
     */
    private $collectionFactory;
    /**
     * @var ReviewFactory
     */
    private $reviewFactory;
    /**
     * @var ReviewInterfaceFactory
     */
    private $reviewInterfaceFactory;
    /**
     * @var ReviewSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;
    /**
     * @param ResourceReview $resource
     * @param ReviewFactory $reviewFactory
     * @param ReviewInterfaceFactory $reviewInterfaceFactory
     * @param ReviewCollectionFactory $collectionFactory
     * @param ReviewSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceReview                      $resource,
        ReviewFactory                       $postFactory,
        ReviewInterfaceFactory              $postInterfaceFactory,
        ReviewCollectionFactory             $collectionFactory,
        ReviewSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface      $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->reviewFactory = $postFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->reviewInterfaceFactory = $postInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }
    /**
     * @param int $reviewId
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $reviewId): bool
    {
        return $this->delete($this->getById($reviewId));
    }
    /**
     * @param ReviewInterface $review
     * @return bool
     */
    public function delete(ReviewInterface $review): bool
    {
        try {
            $this->resource->delete($review);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the post: %1', $exception->getMessage())
            );
        }
        return true;
    }
    /**
     * @param int $reviewId
     * @return ReviewInterface
     */
    public function getById(int $reviewId): ReviewInterface
    {
        $review = $this->reviewFactory->create();
        $this->resource->load($review, $reviewId);
        if (!$review->getId()) {
            throw new NoSuchEntityException(__('The review with the "%1" ID doesn\'t exist.', $reviewId));
        }
        return $review;
    }
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReviewSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
    /**
     * @param ReviewInterface $review
     * @return ReviewInterface
     * @throws CouldNotSaveException
     */
    public function save(ReviewInterface $review): ReviewInterface
    {
        try {
            $this->resource->save($review);
        } catch (LocalizedException $exception) {
            throw new CouldNotSaveException(
                __('Could not save the post: %1', $exception->getMessage()),
                $exception
            );
        } catch (\Throwable $exception) {
            throw new CouldNotSaveException(
                __('Could not save the review: %1', __('Something went wrong while saving the review.')),
                $exception
            );
        }
        return $review;
    }
}