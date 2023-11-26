# Farmer Product Registration and Statistics

## Overview

This Laravel project facilitates the registration of farmer products and provides statistical insights. It utilizes Laravel Sail for easy development and deployment.

## Prerequisites

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)

## Getting Started

```bash
git clone https://github.com/your-username/farmer-product-registration.git
cd farmer-product-registration
composer install
cp .env.example .env
# Update .env with your settings
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed


# To stop the containers
./vendor/bin/sail down
```

Visit http://localhost in your browser to access the application.

## Features
. ** Product Registration:** Farmers can register their products.
. ** Statistics: ** View statistical insights on registered products.
