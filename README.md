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
**. Product Registration:** Farmers can register their products.

**. Statistics:** View statistical insights on registered products.

### screenshots
<img width="1440" alt="Screenshot 2023-11-26 at 16 07 01" src="https://github.com/fab-ryan/farmer-products/assets/39263071/f9551eaa-641a-4fd6-8b93-7b00480d9be8">
<img width="1440" alt="Screenshot 2023-11-26 at 16 06 50" src="https://github.com/fab-ryan/farmer-products/assets/39263071/d7f31845-6a32-4c16-a4a4-93a3c9beab6d">
<img width="1440" alt="Screenshot 2023-11-26 at 16 06 44" src="https://github.com/fab-ryan/farmer-products/assets/39263071/5d7b4246-61bc-466f-be67-3a05a7eed8c8">
<img width="1440" alt="Screenshot 2023-11-26 at 16 06 34" src="https://github.com/fab-ryan/farmer-products/assets/39263071/50125d72-7d88-4c45-9fc8-90aa89630e93">
![Screenshot 2023-11-26 at 16 06 17](https://github.com/fab-ryan/farmer-products/assets/39263071/c2ee56bc-369c-4a78-9060-e2292cc19ce3)

