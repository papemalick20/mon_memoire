<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    
    /**
     * @var int|null
     */
    private $maxprice;
     /**
      * @var int|null
      * @Assert\Range(min=10, max=400)
      */
      private $minsurface;


    /**
     * Get the value of maxprice
     *
     * @return int|null
     */ 

    /**
     * @var ArrayCollection
     */
    private $options;
    
     public function __construct()
     {
      $this->options= new ArrayCollection();
     }

    public function getMaxprice()
    {
        return $this->maxprice;
    }

    /**
     * Set the value of maxprice
     *
     * @param int|null $maxprice
     *
     * @return self
     */ 
    public function setMaxprice($maxprice)
    {
        $this->maxprice = $maxprice;

        return $this;
    }

      /**
       * Get the value of minsurface
       *
       * @return int|null
       */ 
    public function getMinsurface()
    {
          return $this->minsurface;
    }

      /**
       * Set the value of minsurface
       *
       * @param int|null $minsurface
       *
       * @return self
       */ 
    public function setMinsurface($minsurface)
    {
          $this->minsurface = $minsurface;

          return $this;
    }

    /**
     * Get the value of options
     *
     * @return  ArrayCollection
     */ 
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @param  ArrayCollection  $options
     *
     * @return  self
     */ 
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }
}
