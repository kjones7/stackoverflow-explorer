<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'Users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $reputation = null;

    #[ORM\Column(type: 'sqlserver_datetime')]
    #[Groups(['user:read'])]
    private ?\DateTime $creationDate = null;

    #[ORM\Column(length: 40)]
    #[Groups(['user:read'])]
    private ?string $displayName = null;

    // Datetime user last loaded a page; updated every 30 min at most
    #[ORM\Column(type: 'sqlserver_datetime')]
    #[Groups(['user:read'])]
    private ?\DateTime $lastAccessDate = null;

    #[ORM\Column(length: 200, nullable: true)]
    #[Groups(['user:read'])]
    private ?string $websiteUrl = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['user:read'])]
    private ?string $location = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['user:read'])]
    private ?string $aboutMe = null;

    // Number of times the profile is viewed
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $views = null;

    // How many upvotes the user has cast
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $upVotes = null;

    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $downVotes = null;

    // Now always blank
    #[ORM\Column(length: 40, nullable: true)]
    private ?string $emailHash = null;

    // User's Stack Exchange Network profile ID
    #[ORM\Column(nullable: true)]
    #[Groups(['user:read'])]
    private ?int $accountId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReputation(): ?int
    {
        return $this->reputation;
    }

    public function setReputation(int $reputation): self
    {
        $this->reputation = $reputation;

        return $this;
    }

    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getLastAccessDate(): ?\DateTime
    {
        return $this->lastAccessDate;
    }

    public function setLastAccessDate(\DateTime $lastAccessDate): self
    {
        $this->lastAccessDate = $lastAccessDate;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getAboutMe(): ?string
    {
        return $this->aboutMe;
    }

    public function setAboutMe(?string $aboutMe): self
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getUpVotes(): ?int
    {
        return $this->upVotes;
    }

    public function setUpVotes(int $upVotes): self
    {
        $this->upVotes = $upVotes;

        return $this;
    }

    public function getDownVotes(): ?int
    {
        return $this->downVotes;
    }

    public function setDownVotes(int $downVotes): self
    {
        $this->downVotes = $downVotes;

        return $this;
    }

    public function getProfileImageUrl(): ?string
    {
        return $this->profileImageUrl;
    }

    public function setProfileImageUrl(?string $profileImageUrl): self
    {
        $this->profileImageUrl = $profileImageUrl;

        return $this;
    }

    public function getEmailHash(): ?string
    {
        return $this->emailHash;
    }

    public function setEmailHash(?string $emailHash): self
    {
        $this->emailHash = $emailHash;

        return $this;
    }

    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    public function setAccountId(?int $accountId): self
    {
        $this->accountId = $accountId;

        return $this;
    }
}
