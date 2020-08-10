# Drupal Test

## Background
This repository contains a Drupal project, which have 2 customizations – We have a module `tinyurl` and a profile `tinyurlprofile`.

The profile `tinyurlprofile` just creates and enables required modules & content structure to make the development quicker and easier.

The module `tinyurl` (located in `web/modules/tinyurl`) contains the default GraphQL query definition for the `url` node.

The default supplied `url` node contains 2 fields `slug` and `url`.
By default the slug field can be empty and the url field is required.

## Mission
Your goal is to extend the current TinyUrl module with functionality for automatically generating the slug if none as been supplied.
Ensure that a call to `/s/<slug>` redirects the user to the supplied url.
If time allows also add GraphQL mutations for the already defined GraphQL Query of `Url`.

## Test requirements
* `slug` functionality
  * If no `slug` have been given one is auto generated.
  * On route `/s/<slug>` we should be redirected to corresponding url.
* Bonus if you have additional time
  * Implement mutation in GraphQL for the Url query type – allowing for create and delete of url nodes.

---

## Installation
Please feel free to use any development environment which is most convenient to you.

### Environment requirements
* `PHP ^7.4`
* `MySQL or any compatible server`

### Installation
We have included a [DDEV](https://ddev.readthedocs.io/) (See Useful resources for more info about DDEV) based configuration for the project to get up and running very quickly – if you already have another local development setup jump to next section.

```
ddev start && ddev install
```

The first commands (`ddev start`) boots up the docker containers and adds them to the local routing layer – the second command is a prebundle set of commands that run all commands listed in the next section.

Default login is username `admin` and pass `admin`

Configuration comes from the Installation profile `tinyurlprofile`.

#### Alternative
If you do it your self you will need to run - assuming you have configured your settings file with credentials for MySQL

```
composer install
drush si --account-pass=admin tinyurlprofile -y
```

## Development
This is a standard Drupal project, with minimal configuration/changes to it.

**Note** the GraphQL version used here is 4.x

For ease of Drupal console or Drush execution these have been hooked into DDEV, so you can make use of them as this
```
ddev drush <command>
# or
ddev drupal <command>
```

## Useful resources
* GraphQL for Drupal
  * [github.com/drupal-graphql/graphql](https://github.com/drupal-graphql/graphql)
  * [Drupal project page](https://www.drupal.org/project/graphql)
  * [Documentation](https://drupal-graphql.gitbook.io/graphql/v/8.x-4.x/)
* DDEV - Local docker based PHP Development environment
  * [Documentation](https://ddev.readthedocs.io/en/stable/)
  * [Step-debugging setup](https://ddev.readthedocs.io/en/stable/users/step-debugging/)
