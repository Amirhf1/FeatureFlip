# FeatureToggle

![Packagist](https://img.shields.io/packagist/v/amirhf1/feature-toggle.svg)
![License](https://img.shields.io/packagist/l/amirhf1/feature-toggle.svg)
![PHP Version](https://img.shields.io/packagist/php-v/amirhf1/feature-toggle.svg)
![Total Downloads](https://img.shields.io/packagist/dt/amirhf1/feature-toggle.svg)

**FeatureToggle** is a Laravel package that provides a simple and flexible way to manage feature flags within your application. Enable or disable features on the fly without deploying new code, enhancing your application's flexibility and allowing for better control over feature releases.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Checking Feature Status](#checking-feature-status)
  - [Enabling/Disabling Features](#enablingdisabling-features)
  - [Middleware](#middleware)
  - [Blade Directives](#blade-directives)
- [Database Setup](#database-setup)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Easy Integration**: Seamlessly integrates with Laravel applications.
- **Database-Driven**: Store feature flags in the database for dynamic control.
- **Facade & Helper Functions**: Access feature toggles effortlessly throughout your application.
- **Middleware Support**: Protect routes based on feature flags.
- **Blade Directives**: Conditionally display content in Blade templates.
- **Extensible**: Easily extendable to fit your application's needs.

## Installation

You can install the package via Composer:

```bash
composer require amirhf1/feature-toggle
```

## Configuration

After installation, publish the configuration and migration files:

```bash
php artisan vendor:publish --provider="amirhf1\FeatureToggle\FeatureToggleServiceProvider" --tag="config"
php artisan vendor:publish --provider="amirhf1\FeatureToggle\FeatureToggleServiceProvider" --tag="migrations"
```

Then, run the migrations to create the `features` table:

```bash
php artisan migrate
```

> **Note:** For Laravel versions >=5.5, the package uses [Package Auto-Discovery](https://laravel.com/docs/10.x/packages#package-discovery), so manual registration of the service provider and facade is not required. For older versions, refer to the [Installation](#installation) section.

## Usage

### Checking Feature Status

Use the `FeatureToggle` facade to check if a feature is enabled:

```php
use FeatureToggle;

if (FeatureToggle::isEnabled('comments')) {
    // Show comments section
} else {
    // Hide comments section
}
```

### Enabling/Disabling Features

Enable or disable features programmatically:

```php
use FeatureToggle;

// Enable a feature
FeatureToggle::enable('new_dashboard');

// Disable a feature
FeatureToggle::disable('registration');
```

### Middleware

Protect your routes based on feature flags by using the provided middleware.

1. **Register Middleware:**

   The middleware is automatically registered by the package. If not, ensure it's registered in your `FeatureToggleServiceProvider`.

2. **Apply Middleware to Routes:**

   ```php
   Route::get('/new-dashboard', function () {
       // New Dashboard Logic
   })->middleware('feature:new_dashboard');
   ```

   If the feature is disabled, accessing `/new-dashboard` will result in a 404 error or a custom response as defined.

### Blade Directives

Conditionally display content in your Blade templates using the `@feature` directive.

```blade
@feature('comments')
    <!-- Comments section -->
@else
    <!-- Comments are disabled -->
@endfeature
```

## Database Setup

The package uses a `features` table to store feature flags. After publishing and running the migrations, you can manage features via Eloquent models or directly through the database.

### Seeding Default Features

Optionally, you can create a seeder to populate default features:

```php
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureToggleSeeder extends Seeder
{
    public function run()
    {
        DB::table('features')->insert([
            ['name' => 'registration', 'enabled' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'comments', 'enabled' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'new_dashboard', 'enabled' => false, 'created_at' => now(), 'updated_at' => now()],
            // Add more features as needed
        ]);
    }
}
```

Run the seeder:

```bash
php artisan db:seed --class=FeatureToggleSeeder
```

## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. **Fork the Repository**
2. **Create a Feature Branch**

   ```bash
   git checkout -b feature/YourFeature
   ```

3. **Commit Your Changes**

   ```bash
   git commit -m "Add your feature"
   ```

4. **Push to the Branch**

   ```bash
   git push origin feature/YourFeature
   ```

5. **Open a Pull Request**

Please ensure your code adheres to the project's coding standards and includes appropriate tests.

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.