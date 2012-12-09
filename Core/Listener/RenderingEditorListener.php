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

namespace AlphaLemon\Block\FacebookLikeButtonBundle\Core\Listener;

use AlphaLemon\AlphaLemonCmsBundle\Core\Listener\JsonBlock\RenderingItemEditorListener;
use AlphaLemon\AlphaLemonCmsBundle\Core\Event\Actions\Block\BlockEditorRenderingEvent;

/**
 * Manipulates the block's editor response when the editor has been rendered
 *
 * @author alphalemon <webmaster@alphalemon.com>
 */
class RenderingEditorListener extends RenderingItemEditorListener
{
    protected function configure()
    {
        return array(
            'blockClass' => '\AlphaLemon\Block\FacebookLikeButtonBundle\Core\Block\AlBlockManagerFacebookLikeButton',
            'formClass' => '\AlphaLemon\Block\FacebookLikeButtonBundle\Core\Form\Facebook\LikeWidgetType',
            'embeddedClass' => '\AlphaLemon\Block\FacebookLikeButtonBundle\Core\Form\Facebook\LikeWidget',
        );
    }
    
    protected function renderEditor(BlockEditorRenderingEvent $event, array $params)
    {
        if (!array_key_exists('formClass', $params)) {
            throw new \InvalidArgumentException(sprintf('The array returned by the "configure" method of the class "%s" method must contain the "formClass" option', get_class($this)));
        }

        if (!class_exists($params['formClass'])) {
            throw new \InvalidArgumentException(sprintf('The form class "%s" defined in "%s" does not exists', $params['formClass'], get_class($this)));
        }

        try {
            $alBlockManager = $event->getBlockManager();
            if ($alBlockManager instanceof $params['blockClass']) {
                $container = $event->getContainer();
                $block = $alBlockManager->get();
                $className = $block->getType();
                $content = json_decode($block->getContent(), true);      
                $likeContent = $content['like'];
                $likeContent = $this->formatContent($likeContent);
                $likeContent['id'] = 0;
                
                $embeddedClass = new \AlphaLemon\Block\FacebookLikeButtonBundle\Core\Form\Facebook\LikeWidget(); 
                $formLike = $container->get('form.factory')->create(new \AlphaLemon\Block\FacebookLikeButtonBundle\Core\Form\Facebook\LikeWidgetType(), $embeddedClass);
                $formLike->bind($likeContent);
                
                $openGraphContent = $content['graph'];
                $openGraphContent = $this->formatContent($openGraphContent);
                $openGraphContent['id'] = 0;
                $embeddedClass = new \AlphaLemon\Block\FacebookLikeButtonBundle\Core\Form\Facebook\OpenGraph(); 
                $formOpenGraph = $container->get('form.factory')->create(new \AlphaLemon\Block\FacebookLikeButtonBundle\Core\Form\Facebook\OpenGraphType(), $embeddedClass);
                $formOpenGraph->bind($openGraphContent);
                
                $template = sprintf('%sBundle:Block:%s_item.html.twig', $className, strtolower($className));
                $editor = $container->get('templating')->render($template, array("form_like" => $formLike->createView(), "form_open_graph" => $formOpenGraph->createView()));
                $event->setEditor($editor);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}