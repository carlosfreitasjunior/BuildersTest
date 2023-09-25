<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Api;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /** @var string */
    public const PATH_TECHSHOP_CONFIG = 'techshop/product_review_general_settings/';

    /** @var string */
    public const PATH_PRODUCTREVIEW_IS_ENABLE = 'enabled_module';

    /**
     * Is Customer Firstname Trim Enabled
     *
     * @param string|null $scopeCode
     * @return bool
     */
    public function isProductReviewEnabled(?string $scopeCode = null): bool;
}
