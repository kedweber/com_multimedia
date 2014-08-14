# Moyo Multimedia Manager

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

```json
{
    "name": "cta/multimedia",
    "type": "vcs",
    "url": "https://github.com/cta-int/multimedia.git"
}
```

The require section should contain the following line:

```json
    "cta/multimedia": "1.0.*",
```

Afterward, just run `composer update` from the root of your Joomla project.

### jsymlinker

Another option, currently only available for Moyo developers, is by using the jsymlink script from the [Moyo Git
Tools](https://github.com/derjoachim/moyo-git-tools).

## Usage - Administrator

The video manager resides in `Components > Multimedia`. Each multimedia item has the following configurable properties:

* **Title** self-explanatory
* **Slug** Auto-generated slug
* **Source** Chooses the source of the multimedia item, e.g. Vimeo or Youtube
* **Preview** Auto-generated from source
* **Description** Enables the content manager to enter a description to show on the frontend view.

## Usage - Frontend

All that needs to be done, is create a menu item of the type Multimedia >> Videos .
