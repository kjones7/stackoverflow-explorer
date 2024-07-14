<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDto
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    public ?int $reputation = null;

    #[Assert\NotBlank]
    public ?\DateTime $creationDate = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 40)]
    public ?string $displayName = null;

    #[Assert\NotBlank]
    public ?\DateTime $lastAccessDate = null;

    #[Assert\Url(requireTld: true)]
    #[Assert\Length(max: 200)]
    public ?string $websiteUrl = null;

    #[Assert\Length(max: 100)]
    public ?string $location = null;

    public ?string $aboutMe = null;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    public ?int $views = null;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    public ?int $upVotes = null;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    public ?int $downVotes = null;

    #[Assert\Type('integer')]
    public ?int $accountId = null;
}