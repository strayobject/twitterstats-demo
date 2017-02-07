<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Dto;

use Strayobject\TwitterstatsBundle\Entity\Retweet as RetweetEntity;

class Retweet
{
    private $id;

    private $tweetId;

    private $tweetDate;

    private $count;

    private $createdAt;

    private $updatedAt;


    public function __construct(RetweetEntity $retweet)
    {
        $this->id = $retweet->getId();
        $this->tweetId = $retweet->getTweetId();
        $this->tweetDate = $retweet->getTweetDate();
        $this->count = $retweet->getCount();
        $this->createdAt = $retweet->getCreatedAt();
        $this->updatedAt = $retweet->getUpdatedAt();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTweetId(): string
    {
        return $this->tweetId;
    }

    /**
     * @return \DateTime
     */
    public function getTweetDate(): \DateTime
    {
        return $this->tweetDate;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

}
