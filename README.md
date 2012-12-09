Add the Facebook Like button App-Block to AlphaLemon CMS
========================================================

The Facebook Like button App-Block adds both the facebook like button to your website and
the Open Graph metatags.

Installation
------------

You can add the **Facebook Like button App-Block** to the application managed by AlphaLemon 
CMS, adding it to the **composer.json** of your Symfony2 application:

.. code-block:: text

    {
        "name": "alphalemon/alphalemon-cms-sandbox",

        [...]

        "require": {

            [...]        

            "alphalemon/app-facebook-like-button-bundle": "dev-master",        
        }
    }

Be sure that there is declared the reference to **http://apps.alphalemon.com** repository,
under the **repositories** option:

.. code-block:: text

    "repositories": [

        [...]

        {
            "type": "composer",
            "url": "http://apps.alphalemon.com/"
        }
    ],

then run the composer's update command:

.. code-block:: text

    php composer.phar update alphalemon/app-facebook-like-button-bundle

To have the new block available in the AlphaLemon CMS' add blocks menu, you have to 
clear the cache as follows:

.. code-block:: text

    app/console cache:clear --env=alcms


Usage
-----
The block's editor is tabbed. The first tab contains a form that requires you to choose 
the aspect of the button, the second contains another form where you can define the 
Open Graph options.

While the options are pretty intuitive, you might want to learn more at `facebook`_

.. note::

    Open Graph require you to specify the **admins** options: you can retrieve this
    information at `facebook`_, in the **Step 2 - Get Open Graph Tags** section.


.. _`facebook`: http://developers.facebook.com/docs/reference/plugins/like/