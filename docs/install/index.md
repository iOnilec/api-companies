# Instalação do projeto

1) Clone o repositório:

```bash
git@github.com:iOnilec/api-companies.git
```

2) Execute o docker:

```bash
docker compose up -d
```

3) Entre na bash do php e execute o composer com a migração da tabela:

```bash
docker exec -it api-companies bash

composer install

vendor/bin/phinx migrate
```

[Acesse aqui](http:localhost:8080)

**API pronta**