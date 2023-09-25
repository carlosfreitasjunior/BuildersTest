<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ReviewSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get reviews list.
     *
     * @return ReviewInterface[]
     */
    public function getItems(): array;
    
    /**
     * Set reviews list.
     *
     * @param ReviewInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
