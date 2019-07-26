<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{
    const HEAT = [
        1 => 'Electrique',
        2 => 'Gaz',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $sold = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();

    }

    /**
     * getId.
     *
     * @author	Hamza
     * @since	v0.0.1
     * @version	v1.0.0	Friday, July 26th, 2019.
     * @access	public
     * @return	int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * getTitle.
     *
     * @author	Hamza
     * @since	v0.0.1
     * @version	v1.0.0	Friday, July 26th, 2019.
     * @access	public
     * @return	string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * setTitle.
     *
     * @author	Hamza
     * @since	v0.0.1
     * @version	v1.0.0	Friday, July 26th, 2019.
     * @access	public
     * @param	string	$title	
     * 
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * getSlug.
     *
     * @author    Unknown
     * @since    v0.0.1
     * @version    v1.0.0    Friday, July 26th, 2019.
     * @access    public
     * @param    string    $title
     * @return    string
     */
    public function getSlug(): string
    {
        $slugify = new Slugify();
        return $slugify->slugify($this->getTitle());
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    /**
     * setFloor
     *
     * @param  mixed $floor
     *
     * @return self
     */
    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * getPrice.
     *
     * @author    Unknown
     * @since    v0.0.1
     * @version    v1.0.0    Thursday, July 25th, 2019.
     * @access    public
     * @return    int
     *
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * getFormattedPrice
     *
     * @return string
     */
    public function getFormattedPrice(): ?string
    {
        return number_format($this->price, 0, '', ' ');
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    /**
     * getTypeHeat.
     *
     * @author	Unknown
     * @since	v0.0.1
     * @version	v1.0.0	Friday, July 26th, 2019.
     * @access	public
     * @return	string
     */
    public function getTypeHeat(): ?string
    {
        return self::HEAT[$this->heat];
    }

    /**
     * setHeat.
     *
     * @author	Hamza
     * @since	v0.0.1
     * @version	v1.0.0	Friday, July 26th, 2019.	
     * @version	v1.0.1	Friday, July 26th, 2019.	
     * @version	v1.0.2	Friday, July 26th, 2019.	
     * @version	v1.0.3	Friday, July 26th, 2019.	
     * @version	v1.0.4	Friday, July 26th, 2019.	
     * @version	v1.0.5	Friday, July 26th, 2019.	
     * @version	v1.0.6	Friday, July 26th, 2019.	
     * @access	public
     * @param	int	$heat	
     * @return	mixed
     */
    public function setHeat(int $heat): self
    {
        /**
         * @var		mixed	$this->heat
         */
        $this->heat = $heat;

        return $this;
    }

    /**
     * getCity
     *
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}