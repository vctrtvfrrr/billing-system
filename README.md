# Billing System

[![Coverage Status](https://coveralls.io/repos/github/vctrtvfrrr/billing-system/badge.svg?branch=master)](https://coveralls.io/github/vctrtvfrrr/billing-system?branch=master)

PoC de um sistema de cobranças baseado em disparos de e-mails com boletos.

## Instalando

Para instalar o app, clone este repositório em seu ambiente local:

```bash
git clone git@github.com:vctrtvfrrr/billing-system.git
```

Em seguida, instale as dependências do projeto com o Composer e NPM:

```bash
composer install
npm install
```

O NPM é utilizado para instalar o Husky, usado para executar alguns hooks do Git. Prepare o ambiente com o Husky executando o seguinte comando:

```bash
npm run prepare
```

## Executando

Para executar o app em ambiente de desenvolvimento, você deve executar estes comandos:

```bash
composer start
```

Ou você pode usar o `docker compose` para executar o app com `Docker`:

```bash
docker compose up -d
```

Depois disso, abra `http://localhost:8080` em seu navegador.

## Testando

Execute este comando no diretório raiz do app para executar a suíte de testes:

```bash
composer test
```
