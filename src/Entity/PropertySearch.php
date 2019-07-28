<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch
{

    /**
     *
     *
     * @var int | null
     */
    private $maxPrice;

    /**
     *
     *
     * @var int | null
     */

    private $minSurface;

    /**
     *
     *
     * @var ArrayCollection
     */
    private $infoOptions;

    public function __construct()
    {
        $this->infoOptions = new ArrayCollection();
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }


    /**
     * Get the value of infoOptions
     *
     * @return  ArrayCollection
     */ 
    public function getInfoOptions()
    {
        return $this->infoOptions;
    }

    /**
     * Set the value of infoOptions
     *
     * @param  ArrayCollection  $infoOptions
     *
     * @return  self
     */ 
    public function setInfoOptions(ArrayCollection $infoOptions)
    {
        $this->infoOptions = $infoOptions;

        return $this;
    }
}
