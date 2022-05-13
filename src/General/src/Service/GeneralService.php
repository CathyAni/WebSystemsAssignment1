<?php

namespace General\Service;

use Mezzio\Helper\UrlHelper;
use Mezzio\Helper\ServerUrlHelper;

class GeneralService
{

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    /**
     * @var ServerUrlHelper
     */
    private $serverUrlHelper;

    public  function absoluteUrl(
        $routeName,
        array $routeParams = [],
        $queryParams = [],
        $fragmentIdentifier = null,
        array $options = []
    ) {
        $url = $this->urlHelper->generate($routeName, $routeParams, $queryParams, $fragmentIdentifier, $options);
        $serverUrl = $this->serverUrlHelper->generate($url);
        return $serverUrl;
    }

    

    



    /**
     * Set the value of urlHelper
     *
     * @return  self
     */
    public function setUrlHelper($urlHelper)
    {
        $this->urlHelper = $urlHelper;

        return $this;
    }

    /**
     * Set the value of serverUrlHelper
     *
     * @return  self
     */
    public function setServerUrlHelper($serverUrlHelper)
    {
        $this->serverUrlHelper = $serverUrlHelper;

        return $this;
    }
}
