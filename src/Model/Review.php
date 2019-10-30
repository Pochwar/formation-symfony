<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Review
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max=1024)
     */
    private $content;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Range(min="2018", max="2022")
     */
    private $year;

    /**
     * Review constructor.
     * @param string $content
     * @param int $year
     */
    public function __construct(string $content, int $year)
    {
        $this->content = $content;
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }


}
