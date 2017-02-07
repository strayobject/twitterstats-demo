<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Dto;

use Strayobject\TwitterstatsBundle\Entity\Account as AccountEntity;

class Account
{
    private $id;

    private $name;

    private $screenName;

    private $description;

    private $recentFollowerCount;

    private $recentLikeCount;

    private $recentRetweetCount;

    private $createdAt;

    private $updatedAt;

    public function __construct(AccountEntity $account)
    {
        $this->id = $account->getId();
        $this->name = $account->getName();
        $this->description = $account->getDescription();
        $this->screenName = $account->getScreenName();
        $this->recentFollowerCount = $account->getRecentFollowerCount();
        $this->recentLikeCount = $account->getRecentLikeCount();
        $this->recentRetweetCount = $account->getRecentRetweetCount();
        $this->createdAt = $account->getCreatedAt();
        $this->updatedAt = $account->getUpdatedAt();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getScreenName(): string
    {
        return $this->screenName;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getRecentFollowerCount(): int
    {
        return $this->recentFollowerCount;
    }

    /**
     * @return int
     */
    public function getRecentLikeCount(): int
    {
        return $this->recentLikeCount;
    }

    /**
     * @return int
     */
    public function getRecentRetweetCount(): int
    {
        return $this->recentRetweetCount;
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
