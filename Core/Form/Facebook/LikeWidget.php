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
class LikeWidget
{
    protected $id;    
    protected $url;
    protected $send;
    protected $showFaces;
    protected $layout;   
    protected $width;   
    protected $font;  
    protected $colorscheme;
    protected $action;  
    
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
    
    public function getSend()
    {
        return $this->send;
    }

    public function setSend($v)
    {
        $this->send = (bool)$v;
    }
    
    public function getShowFaces()
    {
        return $this->showFaces;
    }

    public function setShowFaces($v)
    {
        $this->showFaces = (bool)$v;
    }
    
    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($v)
    {
        $this->layout = $v;
    }
    
    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($v)
    {
        $this->width = $v;
    }
    
    public function getColorscheme()
    {
        return $this->colorscheme;
    }

    public function setColorscheme($v)
    {
        $this->colorscheme = $v;
    }
    
    public function getFont()
    {
        return $this->font;
    }

    public function setFont($v)
    {
        $this->font = $v;
    }
    
    public function getAction()
    {
        return $this->action;
    }

    public function setAction($v)
    {
        $this->action = $v;
    }
}