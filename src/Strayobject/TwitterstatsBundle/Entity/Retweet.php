<?php

namespace Strayobject\TwitterstatsBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Retweet
 *
 * @ORM\Table(name="twitter_retweet")
 * @ORM\Entity(repositoryClass="Strayobject\TwitterstatsBundle\Repository\RetweetRepository")
 */
class Retweet
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
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(name="accountId", referencedColumnName="id")
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="tweetId", type="string", length=48, unique=true)
     */
    private $tweetId = '';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="tweetDate", type="datetime")
     */
    private $tweetDate;

    /**
     * @var int
     *
     * @ORM\Column(name="retweetCount", type="integer")
     */
    private $count = 0;

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
     * Retweet constructor.
     */
    public function __construct()
    {
        $this->setCreatedAtValue();
        $this->tweetDate = new DateTime();
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
     * @return Retweet
     */
    public function setCreatedAt(DateTime $createdAt): Retweet
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
     * @return Retweet
     */
    public function setUpdatedAt(DateTime $updatedAt): Retweet
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
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @param Account $account
     * @return Retweet
     */
    public function setAccount(Account $account): Retweet
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return Retweet
     */
    public function setCount(int $count): Retweet
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return string
     */
    public function getTweetId(): string
    {
        return $this->tweetId;
    }

    /**
     * @param string $tweetId
     * @return Retweet
     */
    public function setTweetId(string $tweetId): Retweet
    {
        $this->tweetId = $tweetId;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getTweetDate(): DateTime
    {
        return $this->tweetDate;
    }

    /**
     * @param DateTime $tweetDate
     * @return Retweet
     */
    public function setTweetDate(DateTime $tweetDate): Retweet
    {
        $this->tweetDate = $tweetDate;

        return $this;
    }

}

