<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Review extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('techshop_productreview_reviews', 'review_id');
    }
}