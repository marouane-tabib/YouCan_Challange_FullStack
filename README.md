
# Junior Software Engineer - Fullstack (Laravel/VueJS)
This project aims to create a product catalog with the ability to sort and filter by category or price. Each product has a name, description, price, image, and belongs to one or more categories. Categories have a name and can have a parent category. The system allows for product creation via web and command-line interfaces and ensures automated testing for product creation.

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Getting start](#getting-start)
- [Author](#author) 

## Features
Create products via Laravel Artisan CLI. Filter by category and sort by price via view.

- Ability to create a product (from web and cli)
- A listing products with ability to sort by price, or/and filter by a category (from web)

## Requirements
- [Git](https://git-scm.com/) : Git is a free and open source distributed version control system.
- [Composer](https://getcomposer.org/) : is a tool for dependency management.
- [Node.js](https://nodejs.org/en/) :  is a cross-platform, open-source server environment.

> **Note**
> You can check requirements for laravel 10 and its versions using this [link](https://laravel.com/docs/10.x/upgrade#updating-dependencies).

## Installation
To install the project, first open to your work directory and use `git clone` clone it to your local machine. Then, use `composer install` to download the necessary PHP packages and `npm install` to download the required JavaScript packages. Once installed, run the `npm run build` command to bundle your application's assets, making them ready for production deployment.

## Getting Start
- [Quick Start](#quick-start)
- [Usage](#usage) 


## Quick Start
Next steps after installing the project, Start Laravel's local development server using the Laravel's Artisan CLI serve command `php artisan serve`, Once you have started the Artisan development server, your application will be accessible in your web browser at `http://127.0.0.1:8000`.

Ability to create a product using the laravel Artisan CLI:

```command
  php artisa product:create [arguments] [options]
```
```command
  php artisan product:create <name> <description> <price> <category_id>
```

> **Note**
> In the event that no argument is not included, you will be taken to a asking about it.

With the aim of disrupting `ask` option, You must using the next option:

```command
  php artisa product:create <name> <description> <price> <category_id> [-a|--ask=false]
```
 
In cases you want to interact with the Laravel Artisan CLI product create, use command:
```command
  php artisan product:create
```
#### Inputs:
| Ask | Input |
| :-------- | :------------------------- |
| product name | `string, min:3, max:55`| 
| product description | `required, string, min:10, max:5000`| 
| product price | `required, numeric, min:1`| 
| product category_id | `required, numeric, id is exists in categories table`|
 
## Usage 
### Testing
Artisan command to run your tests:
```command
  php artisan test
```
#### Route Testing
In [tests\Feature\RouteTest.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/74199186ab53df738fdfe9f4aa46d9b64940d2ff/tests/Feature/RouteTest.php) write test for route.
```command
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReouteTest extends TestCase
{
    public function test_home_screen_shows_welcome()
    {
        $response = $this->get('/');
        $response->assertViewIs('product.index');
        $response->assertOk();
    }

    public function test_create_new_product(){
        $response = $this->post('/',  [
            'name' => "Testing fake name",
            'description' => "Testing fake description...",
            'price' => 443,
            'category_id' => 4
        ]);
        $response->assertRedirect('/');
    }
}
```
#### Validation Testing
In [tests\Feature\ValidationTest.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/74199186ab53df738fdfe9f4aa46d9b64940d2ff/tests/Feature/ValidationTest.php) write test for validation form.
```command
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    public function test_simple_validation_rules()
    {
        $response = $this->post('/');
        $response->assertSessionHasErrors('name')->assertStatus(302);
        $response->assertSessionHasErrors('description')->assertStatus(302);
        $response->assertSessionHasErrors('price')->assertStatus(302);
        $response->assertSessionHasErrors('category_id')->assertStatus(302);
    }

    public function test_validation_errors_shown_in_blade()
    {
        $response = $this->followingRedirects()->post('/');
        $response->assertStatus(200);
        $response->assertSee('The image field is required.');
        $response->assertSee('The name field is required.');
        $response->assertSee('The description field is required.');
        $response->assertSee('The price field is required.');
        $response->assertSee('The category id field is required.');
    }

    public function test_old_value_stays_in_form_after_validation_error()
    {
        $response = $this->followingRedirects()->post('/',  [
            'description' => "Testing fake description...",
            'price' => 443,
            'category_id' => 4
        ]);
        $response->assertStatus(200);
        $response->assertSee('The name field is required.');
        $response->assertSee('Testing fake description...');
        $response->assertSee(443);
    }

    public function test_form_request_validation()
    {
        $response = $this->post('/');
        $response->assertStatus(302);

        $response = $this->post('/',  [
            'image' => "default-img.jpg",
            'name' => "Testing fake name",
            'description' => "Testing fake description...",
            'price' => 443,
            'category_id' => 4
        ]);
        $response->assertRedirect('/');
    }
}
```
#### Console Testing
In [tests\Feature\Console\Product\ProductCreateTest.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/74199186ab53df738fdfe9f4aa46d9b64940d2ff/tests/Feature/Console/Product/ProductCreateTest.php) write test for console.
```command
<?php

namespace Tests\Feature\Console\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_product(): void
    {
        $this->artisan('product:create')
        ->expectsQuestion('Product Name?', 'Testing Red T-shirt')
        ->expectsQuestion('Product Description?', 'She held up the bowl to the window light and smiled her fakest smile yet')
        ->expectsQuestion('Product Price?', 200)
        ->expectsOutput('Show All Categories.')
        ->expectsQuestion('Choise Product Category With Id?', 2)
        ->expectsOutput('Product Created Successfully.')
        ->assertExitCode(0);
    }
}
```

#### Artisan CLI
Command to run Laravel Artisan CLI to create product with arguments:

```command
  php artisan product:create <name> <description> <price> <category_id>
```

##### EX:
```command
  php artisan product:create t-shirt "Bold, vibrant and comfortable - make a statement with our unique t-shirt designs" 200 3
```

Command to run Laravel Artisan CLI to create product with asking method:

```command
  php artisan product:create 
```

##### Ex:
```command
 Product Name?:
 > t-shirt
 Product Description?:
 > Bold, vibrant and comfortable - make a statement with our unique t-shirt designs
 Product Price?:
 > 200
 Show All Categories.
+----+--------------------------+
| id | name                     |
+----+--------------------------+
| 1  | Brielle Morissette       |
| 2  | Trey Nienow              |
| 3  | Prof. Clemens Raynor Jr. |
| 4  | Mr. Jordan Halvorson II  |
| 5  | Dewitt Shields           |
+----+--------------------------+
 Choise Product Category With Id?:
 > 3
```

##### Result:
```command
  Product Created Successfully.
```

##### Or Validation Error:
```command
   Exception 

  The price field must be a number.

  at app\Traits\CliValidator.php:23
     19▕             $attribute => $validation
     20▕         ]);
     21▕
  ➜  23▕             throw new Exception($validator->errors()->first($attribute));
     24▕         }
     25▕
     26▕         return $value;
     27▕     }
 // ...
```

#### View
Command to run Artisan development server:
```bash
  php artisan serve
```
Once you have started the Artisan development server, your application will be accessible in your web browser at `http://127.0.0.1:8000`.
After this you can interact with the application.

## Author
- [@marwan-tabib](https://github.com/marwan-tabib)



