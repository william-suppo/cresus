# Cresus

Cette application est une solution de comptabilité en partie double.

### Comment lancer l'application ?

```bash
# dev
docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d

# prod
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

### Comment construire son projet ?

```bash
# composer
docker-compose exec app composer up
# assets
docker-compose exec app yarn install
docker-compose exec app yarn run dev
```
