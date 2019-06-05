<h1 align="center">INVOICEME</h1>

[![Build Status](https://travis-ci.org/orobogenius/invoice-me.svg?branch=master)](https://travis-ci.org/orobogenius/invoice-me)
<a href="https://codecov.io/gh/orobogenius/invoice-me">
  <img src="https://img.shields.io/codecov/c/github/orobogenius/invoice-me.svg?style=flat-square" />
</a>
<a href="https://github.styleci.io/repos/190352202" rel="nofollow"><img src="https://camo.githubusercontent.com/59d352dbd8a27e9c12057c37743c50e6777616fe/68747470733a2f2f7374796c6563692e696f2f7265706f732f3136343239323139362f736869656c64" data-canonical-src="https://styleci.io/repos/190352202/shield" style="max-width:100%;"></a>
![Maintained](https://img.shields.io/maintenance/yes/2019.svg)

Send personalized invoices to your customers and get paid faster.

### 🛠 INSTALLATION
##### REQUIREMENTS
- [PHP 7.1.3](https://www.php.net/downloads.php) - PHP Binary
- [Composer](https://getcomposer.org/download/) - Composer Dependency Manager
- [MySQL](https://www.mysql.com/downloads/) Database management system

##### STEPS
- Clone the repository
    ```bash
    git clone https://github.com/orobogenius/invoice-me.git
    ```
- Create and configure database
- Install dependencies
    ```bash
    composer install
    ```
- Run migrations
    ```bash
    php artisan migrate
    ```
- Serve app
    ```bash
    php artisan serve
    ```
- Visit ```localhost:8000``` on your browser

### ✅ TEST
```bash
composer test
```

 ⚙ Configuration

 Copy ```.env.example``` to ```.env``` and configure the following keys:

 - RAVE_PKEY - [RavePay](https://developer.flutterwave.com/docs/api-keys) Public Key
 - RAVE_SECRET - [RavePay](https://developer.flutterwave.com/docs/api-keys) Secret Key
 - NEXMO_KEY - [Nexmo](https://dashboard.nexmo.com/getting-started-guide) Key
 - NEXMO_SECRET - [Nexmo](https://dashboard.nexmo.com/getting-started-guide) Secret
 - NEXMO_SENDER - InvoiceMe

To verify RavePay payment, you may setup a webhook url using [ngrok.io](https://ngrok.com/) and set the ```APP_URL``` in the env file to the ngrok tunnel.

## 🐳 Dockerize
### Configure the database


```bash
DB_HOST=database
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### Spin up the containers

```bash
docker-compose up -d
```

- Visit http://localhost:8080 to see the app.

## 🤝 License

MIT license (MIT) - Check out the [License File](LICENSE) for more.