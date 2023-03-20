
# Junior Software Engineer - Fullstack (Laravel/VueJS)
This project aims to create a product catalog with the ability to sort and filter by category or price. Each product has a name, description, price, image, and belongs to one or more categories. Categories have a name and can have a parent category. The system allows for product creation via web and command-line interfaces and ensures automated testing for product creation.

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Getting start](#getting-start)
- [Project Structure](#project-structure)
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
 
## Project Structure
```Structure
app/
├── Console/
│   ├── Commands.php
│   │   └── Product
│   │       └──ProductCreateCommand.php
├── Http/
│   ├── Controllers/
│   │   ├── ProductController.php
│   │   └── ...
│   ├── Interfaces/
│   │   ├── CategoryRepositoryInterface.php
│   │   ├── ProductRepositoryInterface.php
│   │   ├── SubCategoryRepositoryInterface.php
│   │   └── ...
│   ├── Requests/
│   │   ├── CreateProductRequest.php
│   │   └── ...
│   └── ...
├── Models/
│   ├── Category.php
│   ├── Product.php
│   ├── SubCategory.php
│   └── ...
├── Providers/
│   ├── RepositoryServiceProvider.php
│   └── ...
├── Repositories/
│   ├── CategoryRepository.php
│   ├── ProductRepository.php
│   ├── SubCategoryRepository.php
│   └── ...
├── Services/
│   ├── CategoryService.php
│   ├── ProductService.php
│   ├── SubCategoryService.php
│   └── ...
└── ...
```
## Usage 

- [Interfaces](#interfaces) 
- [Repositories](#repositories) 
- [Providers](#providers) 
- [Services](#services) 
- [Controller](#controller) 
- [View](#view)
- [Artisan CLI](#artisan-cli) 
- [Testing](#testing)

### Interfaces
- [ProductRepositoryInterface](#productrepositoryinterface) 
- [CategoryRepositoryInterface](#categoryrepositoryinterface) 
- [SubCategoryRepositoryInterface](#subcategoryrepositoryinterface) 

#### ProductRepositoryInterface
in [app\Http\Interfaces\ProductRepositoryInterface.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Http/Interfaces/ProductRepositoryInterface.php) can you config it:
```productInterface
<?php

namespace App\Http\Interfaces;

interface ProductRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function filter(array $filter);
}
```
#### CategoryRepositoryInterface
in [app\Http\Interfaces\CategoryRepositoryInterface.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Http/Interfaces/CategoryRepositoryInterface.php) can you config it:
```categoryInterface
<?php

namespace App\Http\Interfaces;

interface CategoryRepositoryInterface
{
    public function all(array $select);
}
```
#### SubCategoryRepositoryInterface
in [app\Http\Interfaces\SubCategoryRepositoryInterface.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Http/Interfaces/SubCategoryRepositoryInterface.php) can you config it:
```subcategoryInterface
<?php

namespace App\Http\Interfaces;

interface SubCategoryRepositoryInterface
{
    public function all();
}
```

### Repositories
- [ProductRepository](#productrepository) 
- [CategoryRepository](#categoryrepository) 
- [SubCategoryRepository](#subcategoryrepository)

#### ProductRepository 
in [app\Repositories\ProductRepository.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Repositories/ProductRepository.php) can you config it:
```productrepository
<?php

namespace App\Repositories;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    public function all(){
        return $this->product::all();
    }

    public function create(array $data){
        return $this->product::create($data);
    }

    public function filter(array $filter)
    {
        return $this->product::when(
                        $filter['category_filter'] != '', function($query) use ($filter){
                            $query->where('category_id', $filter['category_filter']);
                        }
                    )->orderBy($filter['sort_by'] ?? 'id' , $filter['order_by'] ?? 'desc')
                    ->get();
    }
}

```
#### CategoryRepository 
in [app\Repositories\CategoryRepository.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Repositories/CategoryRepository.php) can you config it:
```categoryrepository
<?php

namespace App\Repositories;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all(array $select = []){
        return $this->category::all($select);
    }
}

```

#### SubCategoryRepository 
in [app\Repositories\SubCategoryRepository.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Repositories/SubCategoryRepository.php) can you config it:
```subcategoryrepository
<?php

namespace App\Repositories;

use App\Http\Interfaces\SubCategoryRepositoryInterface;
use App\Models\SubCategory;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    protected SubCategory $subCategory;

    public function __construct(SubCategory $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    public function all(array $select = []){
        return $this->subCategory::all($select);
    }
}

```
### Providers
#### RepositoryServiceProvider 
in [app\Providers\RepositoryServiceProvider.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Providers/RepositoryServiceProvider.php) can you config it:
```repositoryServiceProvider
<?php

namespace App\Providers;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
use App\Http\Interfaces\SubCategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

```
### Services
- [ProductService](#productservice) 
- [Categoryservice](#categoryservice) 
- [SubCategoryService](#subcategoryservice) 

#### ProductService
in [app\Services\ProductService.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Services/ProductService.php) can you config it:
```productservice
<?php

namespace App\Services;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Traits\ImageUploaderTrait;

class ProductService
{
    use ImageUploaderTrait;

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function filter(array $data)
    {
        return $this->productRepository->filter($data);
    }

    public function create(array $data)
    {
        if (isset($data['image'])) { 
            $data['image'] = $this->uploadImage($data['image']);
        }
        $this->productRepository->create($data);
        return redirect()->back();
    }
}

```
#### CategoryService
in [app\Services\CategoryService.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Services/CategoryService.php) can you config it:
```categoryservice
<?php

namespace App\Services;

use App\Http\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all(array $select = ['*'])
    {
        return $this->categoryRepository->all($select);
    }
}

```
#### SubCategoryService
in [app\Services\SubCategoryService.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/14bd4763a72c7dfc84be23c2ab4bcba70aaf0002/app/Services/SubCategoryService.php) can you config it:
```subcategoryservice
<?php

namespace App\Services;

use App\Http\Interfaces\SubCategoryRepositoryInterface;

class SubCategoryService
{
    protected SubCategoryRepositoryInterface $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function all(array $select = ['*'])
    {
        return $this->subCategoryRepository->all($select);
    }
}

```

#### Controllers - ProductController
in [app\Http\Controllers\ProductController.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/42ba367dac3f0bbd90493a5ab67d7f7242273a69/app/Http/Controllers/ProductController.php) can you config it:
```controller
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\CategoryService;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(ProductRequest $request)
    {
        $product = $request->filter ? $this->productService->filter($request->toArray()) : $this->productService->all();
        $categories = $this->categoryService->all();
        return view('product.index', ['products' => $product, 'categories' => $categories]);
    }

    public function create(ProductRequest $request)
    {
        return $this->productService->create($request->toArray());
    }
}

```
### Testing
- [Route Testing](#route-testing)
- [Validation Testing](#validation-testing)
- [Console Testing](#console-testing)

Artisan command to run your tests:
```command
  php artisan test
```
#### Route Testing
In [tests\Feature\RouteTest.php](https://github.com/marwan-tabib/YouCan_Challange_FullStack/blob/74199186ab53df738fdfe9f4aa46d9b64940d2ff/tests/Feature/RouteTest.php) write test for route.
```routetesting
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
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
```validationtesting
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
```consoletesting
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
    public function test_product_create(): void
    {
        $this->artisan('product:create')
        ->expectsQuestion('Add Your Product name', 'Testing Red T-shirt')
        ->expectsQuestion('Add Your Product description', 'She held up the bowl to the window light and smiled her fakest smile yet')
        ->expectsQuestion('Add Your Product price', 200)
        ->expectsOutput('Show All Categories.')
        ->expectsQuestion('Add Your Product category_id', 2)
        ->expectsOutput('Product created successfully!')
        ->assertExitCode(0);
    }
}

```

### View
Command to run Artisan development server:
```bash
  php artisan serve
```
Once you have started the Artisan development server, your application will be accessible in your web browser at `http://127.0.0.1:8000`.
After this you can interact with the application.


### Artisan CLI
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

## Author
- [@marwan-tabib](https://github.com/marwan-tabib)

