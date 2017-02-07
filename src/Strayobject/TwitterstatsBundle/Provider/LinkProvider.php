<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Provider;

class LinkProvider
{
    /**
     * @var string
     */
    private $selfUrl;
    /**
     * @var string
     */
    private $nextUrl;
    /**
     * @var string
     */
    private $prevUrl;
    /**
     * @var string
     */
    private $firstUrl;
    /**
     * @var string
     */
    private $lastUrl;

    public function __construct(
        string $selfUrl = '',
        string $nextUrl = '',
        string $prevUrl = '',
        string $firstUrl = '',
        string $lastUrl = ''
    ) {
        $this->selfUrl = $selfUrl;
        $this->nextUrl = $nextUrl;
        $this->prevUrl = $prevUrl;
        $this->firstUrl = $firstUrl;
        $this->lastUrl = $lastUrl;
    }

    /**
     * @return string
     */
    public function getSelfUrl(): string
    {
        return $this->selfUrl;
    }

    /**
     * @return string
     */
    public function getNextUrl(): string
    {
        return $this->nextUrl;
    }

    /**
     * @return string
     */
    public function getPrevUrl(): string
    {
        return $this->prevUrl;
    }

    /**
     * @return string
     */
    public function getFirstUrl(): string
    {
        return $this->firstUrl;
    }

    /**
     * @return string
     */
    public function getLastUrl(): string
    {
        return $this->lastUrl;
    }
}
