<?php

namespace Github\Endpoint;

class AppsListAccountsForPlan extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    protected $plan_id;
    /**
    * Returns user and organization accounts associated with the specified plan, including free plans. For per-seat pricing, you see the list of accounts that have purchased the plan, including the number of seats purchased. When someone submits a plan change that won't be processed until the end of their billing cycle, you will also see the upcoming pending change.
    
    GitHub Apps must use a [JWT](https://developer.github.com/apps/building-github-apps/authenticating-with-github-apps/#authenticating-as-a-github-app) to access this endpoint. OAuth Apps must use [basic authentication](https://developer.github.com/v3/auth/#basic-authentication) with their client ID and client secret to access this endpoint.
    *
    * @param int $planId plan_id parameter
    * @param array $queryParameters {
    *     @var string $sort One of `created` (when the repository was starred) or `updated` (when it was last pushed to).
    *     @var string $direction To return the oldest accounts first, set to `asc`. Can be one of `asc` or `desc`. Ignored without the `sort` parameter.
    *     @var int $per_page Results per page (max 100)
    *     @var int $page Page number of the results to fetch.
    * }
    */
    public function __construct(int $planId, array $queryParameters = array())
    {
        $this->plan_id = $planId;
        $this->queryParameters = $queryParameters;
    }
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{plan_id}'), array($this->plan_id), '/marketplace_listing/plans/{plan_id}/accounts');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    protected function getQueryOptionsResolver() : \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(array('sort', 'direction', 'per_page', 'page'));
        $optionsResolver->setRequired(array());
        $optionsResolver->setDefaults(array('sort' => 'created', 'per_page' => 30, 'page' => 1));
        $optionsResolver->setAllowedTypes('sort', array('string'));
        $optionsResolver->setAllowedTypes('direction', array('string'));
        $optionsResolver->setAllowedTypes('per_page', array('int'));
        $optionsResolver->setAllowedTypes('page', array('int'));
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Github\Exception\AppsListAccountsForPlanNotFoundException
     * @throws \Github\Exception\AppsListAccountsForPlanUnprocessableEntityException
     * @throws \Github\Exception\AppsListAccountsForPlanUnauthorizedException
     *
     * @return null|\Github\Model\MarketplacePurchase[]
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'Github\\Model\\MarketplacePurchase[]', 'json');
        }
        if (404 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \Github\Exception\AppsListAccountsForPlanNotFoundException($serializer->deserialize($body, 'Github\\Model\\BasicError', 'json'));
        }
        if (422 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \Github\Exception\AppsListAccountsForPlanUnprocessableEntityException($serializer->deserialize($body, 'Github\\Model\\ValidationError', 'json'));
        }
        if (401 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \Github\Exception\AppsListAccountsForPlanUnauthorizedException($serializer->deserialize($body, 'Github\\Model\\BasicError', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array();
    }
}