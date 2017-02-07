<?php

namespace Strayobject\TwitterstatsBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Follower
 *
 * @ORM\Table(name="twitter_follower")
 * @ORM\Entity(repositoryClass="Strayobject\TwitterstatsBundle\Repository\FollowerRepository")
 */
class Follower
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
     * @var int
     *
     * @ORM\Column(name="followerCount", type="integer")
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
     * Follower constructor.
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
     * @return Follower
     */
    public function setCreatedAt(DateTime $createdAt): Follower
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
     * @return Follower
     */
    public function setUpdatedAt(DateTime $updatedAt): Follower
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
     * @return Follower
     */
    public function setAccount(Account $account): Follower
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
     * @return Follower
     */
    public function setCount(int $count): Follower
    {
        $this->count = $count;

        return $this;
    }

}

