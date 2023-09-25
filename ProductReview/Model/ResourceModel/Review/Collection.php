<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Model\ResourceModel\Review;

use Techshop\ProductReview\Model\Review as ReviewModel;
use Techshop\ProductReview\Model\ResourceModel\Review as ReviewResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    
    /**
     * Define model / resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ReviewModel::class, ReviewResourceModel::class);
    }
}