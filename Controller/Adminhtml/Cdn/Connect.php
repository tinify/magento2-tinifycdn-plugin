<?php
/**
 *
 *          ..::..
 *     ..::::::::::::..
 *   ::'''''':''::'''''::
 *   ::..  ..:  :  ....::
 *   ::::  :::  :  :   ::
 *   ::::  :::  :  ''' ::
 *   ::::..:::..::.....::
 *     ''::::::::::::''
 *          ''::''
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to servicedesk@tig.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@tig.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */

namespace TIG\TinyCDN\Controller\Adminhtml\Cdn;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use TIG\TinyCDN\Model\Config\Provider\CDN\Configuration;

class Connect extends Action
{
    /** @var Configuration */
    private $config;
    
    /**
     * Connect constructor.
     *
     * @param Configuration  $config
     * @param Action\Context $context
     */
    // @codingStandardsIgnoreLine
    public function __construct(
        Configuration $config,
        Action\Context $context
    ) {
        $this->config = $config;
        parent::__construct(
            $context
        );
    }
    
    public function execute()
    {
        $credentials = $this->config->formatCredentials();
        
        // Establish authorization using credentials.
    }
}
