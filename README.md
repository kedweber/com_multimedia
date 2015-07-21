# Moyo Multimedia Manager \(com_multimedia\)

## Introduction

Provides a frontend to links to cloud-based videos. The frontend displays a mixed channel of video sites, like [Vimeo]
(http://vimeo.com/) and [Youtube](http://youtube.com). In the backend, these videos can be added by the content manager.

Com_multimedia was developed by [Moyo Web Architects](http://www.moyoweb.nl).

## Requirements

* Joomla 3.X . Untested in Joomla 2.5.
* Koowa 0.9 or 1.0 (as yet, Koowa 2 is not supported)
* PHP 5.3.10 or better
* Composer
* Moyo Components
    * com_cck

## Installation

### Composer

Installation is done through composer. In your `composer.json` file, you should add the following lines to the repositories
section:

from the local repository;

```json
{
    "name": "moyo/com_multimedia",
    "type": "vcs",
    "url": "https://github.com/kedweber/com_multimedia.git"
}
```

and from the official repository;

```json
{
    "name": "moyo/com_multimedia",
    "type": "vcs",
    "url": "https://github.com/moyoweb/com_multimedia.git"
}
```

The require section should contain the following line:

```json
    "moyo/com_multimedia": "1.2.*",
```

Afterwards, one just needs to run the command `composer update` from the root of your Joomla project. This will 
effectively create a `composer.lock` file which will contain the collected dependencies and the hash codes for 
each latest release \(depending on the require section's format\) for each particular repo. Should installations 
problems occur due to a bad ordering of the dependencies, one may need to go into the lock file and manualy change 
the order of the components. Running `composer update` again will again cause a reordering of the lock file, beware of this factor when running an update. Thereafter, you can run the command `composer install`. 

If you have not setup an alias to use the command composer, then you will need to replace the word composer in the previous commands with the commands with `php composer.phar` followed by the desired action \(eg. update or install\).

### jsymlinker

Another option is to run the [jsymlink script](https://github.com/derjoachim/moyo-git-tools) in the root folder, available via the original Moyo developer, Joachim van de Haterd's repository, under 
the [Moyo Git Tools](https://github.com/derjoachim/moyo-git-tools).

#### License jsymlinker

The joomlatools/installer plugin is free and open-source software licensed under the [GPLv3 license](https://github.com/derjoachim/joomla-composer/blob/develop/gplv3-license).


## Usage - Administrator

The video manager resides in `Components > Multimedia`. Each multimedia item has the following configurable properties:

* **Title** self-explanatory
* **Slug** Auto-generated slug
* **Source** Chooses the source of the multimedia item, e.g. Vimeo or Youtube
* **Preview** Auto-generated from source
* **Description** Enables the content manager to enter a description to show on the frontend view.

## Usage - Frontend

All that needs to be done, is create a menu item of the type Multimedia >> Videos .
