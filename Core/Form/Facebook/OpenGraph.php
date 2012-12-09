<?php
/*
 * This file is part of the BusinessDropCapBundle and it is distributed
 * under the MIT LICENSE. To use this application you must leave intact this copyright 
 * notice.
 *
 * Copyright (c) AlphaLemon <webmaster@alphalemon.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For extra documentation and help please visit http://www.alphalemon.com
 * 
 * @license    MIT LICENSE
 * 
 */

namespace AlphaLemon\Block\FacebookLikeButtonBundle\Core\Form\Facebook;

/**
 * Defines the pages form fields
 *
 * @author alphalemon <webmaster@alphalemon.com>
 */
class OpenGraph
{
    protected $id; 
    protected $url;   
    protected $title;   
    protected $type;  
    protected $image;
    protected $siteName;    
    protected $admins;    

    public function getId()
    {
        return $this->id;
    }

    public function setId($v)
    {
        $this->id = $v;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($v)
    {
        $this->url = $v;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($v)
    {
        $this->title = $v;
    }
    
    public function getType()
    {
        return $this->type;
    }

    public function setType($v)
    {
        $this->type = $v;
    }
    
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($v)
    {
        $this->image = $v;
    }
    
    public function getSiteName()
    {
        return $this->siteName;
    }

    public function setSiteName($v)
    {
        $this->siteName = $v;
    }
    
    public function getAdmins()
    {
        return $this->admins;
    }

    public function setAdmins($v)
    {
        $this->admins = $v;
    }
}