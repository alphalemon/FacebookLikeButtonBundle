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

namespace AlphaLemon\Block\FacebookLikeButtonBundle\Core\Block;

use AlphaLemon\AlphaLemonCmsBundle\Core\Content\Block\AlBlockManager;
use AlphaLemon\AlphaLemonCmsBundle\Core\Content\Block\JsonBlock\AlBlockManagerJsonBlock;

/**
 * Description of AlBlockManagerFacebookLikeButton
 */
class AlBlockManagerFacebookLikeButton extends AlBlockManager
{
    public function getDefaultValue()
    {
        $value =
            '{
                "like" : {
                    "url" : "",
                    "send" : false,
                    "layout" : "standard",
                    "width" : 450,
                    "show_faces" : true,
                    "font" : "arial",
                    "colorscheme" : "light",
                    "action" : "like"
                 },
                 "graph" : {
                    "url" : "",
                    "title" : "",
                    "type" : "",
                    "image" : "",
                    "site_name" : "",
                    "admins" : ""
                }
            }';
        
        return array('Content' => $value);
    }
    
    public function getHtml()
    {
        $items = AlBlockManagerJsonBlock::decodeJsonContent($this->alBlock->getContent());
        $options = $items["like"]; 
        
        if ($options['url'] == "") {
            $options['url'] = "{{ app.request.uri }}";
        }
        
        if ( !array_key_exists('send', $options)) {
            $options['send'] = 0;
        }
     
        if ( !array_key_exists('show_faces', $options)) {
            $options['show_faces'] = 0;
        }
        
        return sprintf('<div class="fb-like" data-href="%s" data-send="%s" data-layout="%s" data-width="%s" data-show-faces="%s" data-font="%s" data-colorscheme="%s" data-action="%s"></div>', $options['url'], $options["send"], $options["layout"], $options["width"], $options["show_faces"], $options["font"], $options["colorscheme"], $options["action"]);        
    }
    
    public function getMetaTags()
    {
        $items = AlBlockManagerJsonBlock::decodeJsonContent($this->alBlock->getContent());
        
        $result = "";
        $metatags = $items["graph"]; 
        foreach ($metatags as $metatag => $value) {
            if ($metatag == 'url' && empty($value)) {
                $value = "{{ app.request.uri }}";
            } 
            
            if ($metatag == 'title' && empty($value) && null !== $this->pageTree) {                
                $value = $this->pageTree->getMetaTitle();
            } 
            
            if (empty($value)) {
                continue;
            }
            
            $prefix = ($metatag != 'admins') ? 'ob' : 'fb';            
            $result .= sprintf('<meta property="%s:%s" content="%s" />' . PHP_EOL, $prefix, $metatag, $value);
        }
        
        return $result;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function edit(array $values)
    {
        if (array_key_exists('Content', $values)) {
            $unserializedData = array();
            $serializedData = $values['Content'];
            parse_str($serializedData, $unserializedData);
                        
            $like = $unserializedData["al_like"];
            unset($like["id"]);
            
            $graph = $unserializedData["al_open_graph"];
            unset($graph["id"]);
            
            $content = array(
                "like" => $like,
                "graph" => $graph,
            );

            $values['Content'] = json_encode($content);
        }

        return parent::edit($values);
    }
    
    public function getHideInEditMode()
    {
        return true;
    }
    
    protected function getEditorWidth()
    {
        return 400;
    }    
    
    protected function replaceHtmlCmsActive()
    {
        return "Like button not renderable when editor is active";
    }
}