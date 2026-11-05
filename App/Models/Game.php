<?php

namespace App\Models;

use Framework\Core\Model;

class Game extends Model
{
    protected ?int $id = null;

    protected ?string $name = null;
    protected ?int $release_date = null;
    protected ?string $cover_image = null;
    protected ?Developer $developer_id = null;
    protected ?string $description = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getReleaseDate(): ?int
    {
        return $this->release_date;
    }

    public function setReleaseDate(?int $release_date): void
    {
        $this->release_date = $release_date;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(?string $cover_image): void
    {
        $this->cover_image = $cover_image;
    }

    public function getDeveloperId(): ?Developer
    {
        return $this->developer_id;
    }

    public function setDeveloperId(?Developer $developer_id): void
    {
        $this->developer_id = $developer_id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}