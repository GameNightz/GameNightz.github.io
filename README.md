# Symfony Boilerplate

Have a look at the end of file for update instructions.

## Symfony Versions

Check branches for different versions.

## Getting started

Open [bitbucket](https://bitbucket.org/account/settings/ssh-keys/), add ur ssh key. Be sure u are using an ed25519 key. RSA is outdated.

Edit `~/.ssh/config` if u want to use multiple keys

```bash
Host bitbucket.org
  AddKeysToAgent yes
  IdentityFile ~/.ssh/id_ed25519
```

### Download

```bash
git clone git@bitbucket.org:taktzeitdigital/symfony-6.3.git symfony
```

### Install

Go into docker container (In vs code its called `Reopen in Container`). Docker container has php and latest node version. So u wont need to install it on ur computer.

```bash
cd symfony
docker compose up -d
composer install
npm install
npm run watch
```

The watcher should rebuild changes of css and js now, which r visible on reload. Hot reload is not working yet.

**Attention:** The watcher seams not working on fucking windows/WSL2. Also its some hundred times faster on MacOS. Better try on Linux.

You can start commands from **outside** the docker container:

```bash
docker compose exec symfony composer install
docker compose exec symfony npm install
docker compose exec symfony npm run watch
```

### Browser

Open http://localhost or https://localhost in your browser

## Own Bundles?

Have a look under /bundles/. Add a directory with ur vendorname. Add a bundle. Add composer.json. Add bundles/vendorname/bundlename/src/bundlename.php

```php
<?php

namespace Taktzeit\TestBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class TestBundle extends AbstractBundle
{

}
```

Run `composer install vendorname/urbundle`. Have a look into bundles/Taktzeit/TestBundle. Just copy stuff and rename it.

## Startpage

Whats happening?

- The controller `src/Controller/HomeController.php` loads `templates/base.html.twig`
- `templates/base.html.twig` loads a the vue component `assets/vue/controllers/Hello.vue`.
- `docker compose exec symfony npm run watch` should rebuild the vue component on changes.

## Update a project

We need two folders, projectname and projectname-update. The first one is the old project, the second one is the new project.

```bash
git clone git@bitbucket.org:taktzeitdigital/dockerized-symfony.git bridgestone-reifentest-update
cd bridgestone-reifentest-update
rm -rf .git
git init && git remote add origin ....
git checkout -b update/symfony-5.4
```

Open .env and change `COMPOSE_PROJECT_NAME=symfony-boilerplate` to `COMPOSE_PROJECT_NAME=$PROJECTNAME`.

```bash
docker compose up -d
docker compose exec symfony composer install
docker compose exec symfony npm i
docker compose exec symfony npm run build
```

### Get the old project

```bash
git clone $PROJECTNAME
```

### Config

- Open local/getDatabase and add live database credentials (Sorry for that)

### Start updating

Open both folders and try to copy stuff from $PROJECTNAME to $PROJECTNAME-update.

- Move Bundles from src to `/bundles/$VENDORNAME/$BUNDLENAME`
	- Add composer.json
	- Move folders inside the bundle to `/bundles/$VENDORNAME/$BUNDLENAME/src/`
- Start refactoring
- **Attention:** We prefer annotations; Get rid of yml files.