<?php

namespace Technodrive\Core;

use Technodrive\Core\Enumeration\ProtocolEnum;

/**
 *
 */
class Uri
{
    /**
     * @var ProtocolEnum
     */
    protected ProtocolEnum $protocol;

    /**
     * @var int|null
     */
    protected ?int $port;

    /**
     * @var string|null
     */
    protected ?string $path;

    /**
     * @var string|null
     */
    protected ?string $serverName;

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @return ProtocolEnum
     */
    public function getProtocol(): ProtocolEnum
    {
        return $this->protocol;
    }

    /**
     * @param ProtocolEnum $protocol
     * @return Uri
     */
    public function setProtocol(ProtocolEnum $protocol): Uri
    {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @param int|null $port
     * @return Uri
     */
    public function setPort(?int $port): Uri
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     * @return Uri
     */
    public function setPath(?string $path): Uri
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getServerName(): ?string
    {
        return $this->serverName;
    }

    /**
     * @param string|null $serverName
     * @return Uri
     */
    public function setServerName(?string $serverName): Uri
    {
        $this->serverName = $serverName;
        return $this;
    }


}