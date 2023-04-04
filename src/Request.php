<?php

namespace Technodrive\Core;

use Technodrive\Core\Enumeration\Method;
use Technodrive\Core\Enumeration\ProtocolEnum;

/**
 *
 */
class Request
{
    /**
     * @var Method
     */
    protected Method $method = Method::METHOD_GET;
    /**
     * @var Uri
     */
    protected Uri $uri;
    /**
     * @var \ArrayObject
     */
    protected \ArrayObject $serverParams;
    /**
     * @var \ArrayObject
     */
    protected \ArrayObject $get;
    /**
     * @var \ArrayObject
     */
    protected \ArrayObject $post;

    /**
     * @var ProtocolEnum
     */
    protected ProtocolEnum $protocol = ProtocolEnum::https;

    /**
     *
     */
    public function __construct()
    {
        if (isset($_GET)) {
            $this->setGet(new \ArrayObject($_GET));
        }

        if (isset($_POST)) {
            $this->setPost(new \ArrayObject($_POST));
        }

        $this->setServer(new \ArrayObject($_SERVER));
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method): self
    {
        $method = strtoupper($method);

        $this->method = Method::from($method);

        return $this;
    }

    /**
     * @return Method
     */
    public function getMethod(): Method
    {
        return $this->method;
    }


    /**
     * @param Uri $uri
     * @return $this
     */
    public function setUri(Uri $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return Uri
     */
    public function getUri(): Uri
    {
        return $this->uri;
    }

    /**
     * @param \ArrayObject $params
     * @return $this
     */
    public function setServer(\ArrayObject $params): self
    {
        $this->serverParams = $params;

        if (isset($params['REQUEST_METHOD'])) {
            $this->setMethod($params['REQUEST_METHOD']);
        }

        //getting URI from server
        $uri= new Uri();

        if (
            (! empty($this->serverParams['HTTPS'])
                && strtolower($this->serverParams['HTTPS']) !== 'off')
            || (! empty($this->serverParams['HTTP_X_FORWARDED_PROTO'])
                && $this->serverParams['HTTP_X_FORWARDED_PROTO'] === 'https')
        ) {
            $uri->setProtocol(ProtocolEnum::https);
        } else {
            $uri->setProtocol(ProtocolEnum::http);
        }

        $uri->setServerName($params['SERVER_NAME']);
        $uri->setPath($params['REQUEST_URI']);
        $uri->setPort($params['SERVER_PORT']);

        $this->setUri($uri);

        return $this;
    }

    /**
     * @return \ArrayObject
     */
    public function getServer()
    {
        return $this->serverParams;
    }

    /**
     * @param \ArrayObject $get
     * @return $this
     */
    public function setGet(\ArrayObject $get): self
    {
        $this->get = $get;
        return $this;
    }

    /**
     * @return \ArrayObject
     */
    public function getGet(): \ArrayObject
    {
        return $this->get;
    }

    /**
     * @param \ArrayObject $post
     * @return $this
     */
    public function setPost(\ArrayObject $post): self
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return \ArrayObject
     */
    public function getPost(): \ArrayObject
    {
        return $this->post;
    }

}