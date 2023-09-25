<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 *
 * @author Carlos Freitas Junior <cafreitasjunior@gmail.com>
 * @link   https://github.com/carlosfreitasjunior
 */

declare(strict_types=1);

namespace Techshop\ProductReview\Model;

use Techshop\ProductReview\Api\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 *
 * Class to config module
 */
class Config implements ConfigInterface
{
    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Class constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Is Product Review Enabled
     *
     * @param string|null $scopeCode
     * @return bool
     */
    public function isProductReviewEnabled(?string $scopeCode = null): bool
    {
        if (empty($scopeCode)) {
            return $this->scopeConfig->isSetFlag(self::PATH_TECHSHOP_CONFIG . self::PATH_PRODUCTREVIEW_IS_ENABLE);
        }

        return $this->scopeConfig->isSetFlag(
            self::PATH_TECHSHOP_CONFIG . self::PATH_PRODUCTREVIEW_IS_ENABLE,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }
}
