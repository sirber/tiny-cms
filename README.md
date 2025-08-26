# Tiny CMS

Tiny Content Management System. It's almost a static web site! There is no database. Navigation is generated on available content.

## Content

Content is in [Twig format](https://twig.symfony.com/), using [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/). It is located in the `data/user_content/views` folder. The file `index.twig` will be the default page, and will not be shown in nav. Other files will be shown in the nav. You can create folders to create sub menus. To use a space in a name, you can use an underscore (_).

Exemple:
- index.twig
- about_me.twig
- test/hello.twig

### Static files

It is possible to host and refer to static files. They are located in `data/user_content/static`. The url is `/static/`. Those file are served directly by the HTTP server.

## Development

### Develop the CMS

1. Install docker
2. Build the docker image and start it

```bash
make build
make up
```

### Develop your website

1. Install docker
2. Create a new folder and use this doceker-compose

```yaml
services:
  php:
    image: ghcr.io/sirber/tiny-cms:latest
    environment:
      - APP_ENV=dev
    volumes:
      - ./site:/app/data/user_content/:rw
    ports:
      - 80:80
```
3. Run: `docker compose up -d`
4. start your site in `./site/views/index.twig`

## Production

Production image will cache templates for increased performance. You can use this `docker-compose.yml`:

```yaml
services:
  cms:
    image: ghcr.io/sirber/tiny-cms:latest
    environment:
      - APP_ENV=prod
    volumes:
      - ./site:/app/data/user_content/:r
    ports:
      - 80:80
```

Add your site to `./site`.