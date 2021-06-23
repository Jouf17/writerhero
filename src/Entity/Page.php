<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choice_1_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choice_2_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choice_3_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choice_4_text;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class)
     */
    private $choice_1_target;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class)
     */
    private $choice_2_target;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class)
     */
    private $choice_3_target;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class)
     */
    private $choice_4_target;

    public function __toString()
    {
        return 'Page ' . $this->getNumber() . ' - ' . ((!empty($this->getName())) ? $this->getName() : '');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getChoice1Text(): ?string
    {
        return $this->choice_1_text;
    }

    public function setChoice1Text(string $choice_1_text): self
    {
        $this->choice_1_text = $choice_1_text;

        return $this;
    }

    public function getChoice2Text(): ?string
    {
        return $this->choice_2_text;
    }

    public function setChoice2Text(string $choice_2_text): self
    {
        $this->choice_2_text = $choice_2_text;

        return $this;
    }

    public function getChoice3Text(): ?string
    {
        return $this->choice_3_text;
    }

    public function setChoice3Text(string $choice_3_text): self
    {
        $this->choice_3_text = $choice_3_text;

        return $this;
    }

    public function getChoice4Text(): ?string
    {
        return $this->choice_4_text;
    }

    public function setChoice4Text(string $choice_4_text): self
    {
        $this->choice_4_text = $choice_4_text;

        return $this;
    }

    public function getChoice1Target(): ?self
    {
        return $this->choice_1_target;
    }

    public function setChoice1Target(?self $choice_1_target): self
    {
        $this->choice_1_target = $choice_1_target;

        return $this;
    }

    public function getChoice2Target(): ?self
    {
        return $this->choice_2_target;
    }

    public function setChoice2Target(?self $choice_2_target): self
    {
        $this->choice_2_target = $choice_2_target;

        return $this;
    }

    public function getChoice3Target(): ?self
    {
        return $this->choice_3_target;
    }

    public function setChoice3Target(?self $choice_3_target): self
    {
        $this->choice_3_target = $choice_3_target;

        return $this;
    }

    public function getChoice4Target(): ?self
    {
        return $this->choice_4_target;
    }

    public function setChoice4Target(?self $choice_4_target): self
    {
        $this->choice_4_target = $choice_4_target;

        return $this;
    }

}
