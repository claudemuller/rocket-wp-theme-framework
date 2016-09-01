# Rocket WordPress Theme Framework

* Author: Claude Müller
* Tags: wordpress, foundation, theme
* Stable tag: master

---

## Description

This is the very basic framework for a WordPress theme using [Zurb's Foundation](http://foundation.zurb.com/) css framework along with [SASS](http://sass-lang.com/); [NPM](https://www.npmjs.org/) and [Bower](http://bower.io/) for package management; and [Gulp](http://gulpjs.com/) as a task runner.


## Installation

1. Install all bower dependencies via the cli: `bower install`
2. Then install all npm dependencies via the cli: `npm install`


## Usage

1. To run Gulp issue the following in the cli: `gulp` and the plugin _watch_ will watch your theme for any changes and gulp will run the appropriate task.
2. Put all unoptimised images into the `images/src` directory
3. Put all uncompressed .js into the `js/src` directory
4. Livereload is enabled on this theme, so if you'd like to make use of it, install the appropriate [plugin](http://feedback.livereload.com/knowledgebase/articles/86242-how-do-i-install-and-use-the-browser-extensions-) for your browser


## Dependencies

1. Node Package Manager (npm)
    - download and install Node.js from [http://nodejs.org/](http://nodejs.org/)
2. Bower
    - install Bower via npm `npm install -g bower` if this fails on a \*nix system try prepending the command with `sudo`
3. Gulp
    - install Gulp via npm: `npm install -g gulp` if this fails on a \*nix system try prepending the command with `sudo`


## ChangeLog

See [CHANGES.md](CHANGES.md).
