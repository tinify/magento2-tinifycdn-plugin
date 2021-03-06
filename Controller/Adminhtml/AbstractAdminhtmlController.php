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

namespace Tinify\TinifyCDN\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\Session\SessionManagerInterface;
use Tinify\TinifyCDN\Client\Provider\TinifyProvider;
use Tinify\TinifyCDN\Client\Provider\TinifyProviderFactory;
use Tinify\TinifyCDN\Model\Config\Provider\CDN\Configuration;

abstract class AbstractAdminhtmlController extends Action
{
    const TINIFYCDN_OAUTH_CREDENTIALS_PARAM = 'o_auth_credentials';

    const SYSTEM_CONFIG_TINIFY_TINIFYCDN_SECTION = 'adminhtml/system_config/edit/section/tinify_tinifycdn';

    /** @var SessionManagerInterface $session */
    private $session;

    /** @var Configuration $config */
    private $config;

    /** @var TinifyProviderFactory $tinifyFactory */
    private $tinifyFactory;

    /**
     * AbstractAdminhtmlController constructor.
     *
     * @param Action\Context          $context
     * @param SessionManagerInterface $session
     * @param Configuration           $config
     * @param TinifyProviderFactory   $tinifyFactory
     */
    public function __construct(
        Action\Context $context,
        SessionManagerInterface $session,
        Configuration $config,
        TinifyProviderFactory $tinifyFactory
    ) {
        $this->session       = $session;
        $this->config        = $config;
        $this->tinifyFactory = $tinifyFactory;
        parent::__construct($context);
    }

    /**
     * @return TinifyProvider;
     */
    public function createTinifyProviderInstance()
    {
        return $this->tinifyFactory->create($this->retrieveOAuthCredentials());
    }

    /**
     * Credentials are stored in the session, so they can be used later on. They
     * are unset after authorization is completed.
     *
     * @return array
     */
    private function retrieveOAuthCredentials()
    {
        $oAuthCredentials = $this->getSessionData(static::TINIFYCDN_OAUTH_CREDENTIALS_PARAM);

        if (!$oAuthCredentials) {
            $oAuthCredentials = $this->config->formatCredentials();
            $this->addSessionData(static::TINIFYCDN_OAUTH_CREDENTIALS_PARAM, $oAuthCredentials);
        }

        return ['options' => $oAuthCredentials];
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getSessionData($name)
    {
        return $this->session->getData($name);
    }

    /**
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function addSessionData($name, $value)
    {
        return $this->session->setData($name, $value);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function unsetSessionData($name)
    {
        return $this->session->unsetData($name);
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }
}
