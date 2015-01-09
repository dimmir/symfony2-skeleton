Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

## Requirements

### LESS

    npm install -g less

## Installation

First you need install application assets:

    app/console assets:install web --env --no-debug --symlink --relative
    app/console assetic:dump --env=prod --no-debug
    app/console mopa:bootstrap:install:font
