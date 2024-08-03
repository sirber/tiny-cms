# Tiny CMS

Tiny Content Management System. It's almost a static web site!
There is no database. Navigation is generated on available content.

## Content

Content is in [Twig format](https://twig.symfony.com/), using [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/). It is located in
the `content/routes` folder. The file `index.twig` will be the default
page, and will not be shown in nav. Other files will be shown in the nav.
You can create folders to create sub menus.

Exemple:
- index.twig
- about.twig
- test/hello.twig

## Development

1. Install docker (or podman!)
2. Build the docker image and start it

```bash
make build
make up
```

3. Visit: http://localhost

## Production

Production image will cache templates for increased performance. 

1. Build the production image.
2. Add your content:
    - Mount your content folder to `content/routes`.
    - Extend the base image with your content.
3. Start the thing!