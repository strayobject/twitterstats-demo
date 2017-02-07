<?php

namespace Strayobject\TwitterstatsBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="twitter_account")
 * @ORM\Entity(repositoryClass="Strayobject\TwitterstatsBundle\Repository\AccountRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Account
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="screenName", type="string", length=255, unique=true)
     */
    private $screenName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, unique=false)
     */
    private $description = '';

    /**
     * @var int
     *
     * @ORM\Column(name="recentFollowerCount", type="integer")
     */
    private $recentFollowerCount = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="recentLikeCount", type="integer")
     */
    private $recentLikeCount = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="recentRetweetCount", type="integer")
     */
    private $recentRetweetCount = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * Account constructor.
     */
    public function __construct()
    {
        $this->setCreatedAtValue();
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Account
     */
    public function setCreatedAt(DateTime $createdAt): Account
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return Account
     */
    public function setUpdatedAt(DateTime $updatedAt): Account
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
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
     * @param string $name
     * @return Account
     */
    public function setName(string $name): Account
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getScreenName(): string
    {
        return $this->screenName;
    }

    /**
     * @param string $screenName
     * @return Account
     */
    public function setScreenName(string $screenName): Account
    {
        $this->screenName = $screenName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Account
     */
    public function setDescription(string $description): Account
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getRecentFollowerCount(): int
    {
        return $this->recentFollowerCount;
    }

    /**
     * @param int $recentFollowerCount
     * @return Account
     */
    public function setRecentFollowerCount(int $recentFollowerCount): Account
    {
        $this->recentFollowerCount = $recentFollowerCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getRecentLikeCount(): int
    {
        return $this->recentLikeCount;
    }

    /**
     * @param int $recentLikeCount
     * @return Account
     */
    public function setRecentLikeCount(int $recentLikeCount): Account
    {
        $this->recentLikeCount = $recentLikeCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getRecentRetweetCount(): int
    {
        return $this->recentRetweetCount;
    }

    /**
     * @param int $recentRetweetCount
     * @return Account
     */
    public function setRecentRetweetCount(int $recentRetweetCount): Account
    {
        $this->recentRetweetCount = $recentRetweetCount;

        return $this;
    }
}

