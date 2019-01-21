# Symfony app

## Routes:

```
/product/list
```

- See all the Products
- Search products by name

```
/product/create
```

- Create a new product

```
/product/{id}
```

- See product with id

```
/product/{id}/edit
```

- Edit product with id

```
/product/{id}/delete
```

- Delete product with id

# Setup

1. Clone repository
```
git clone git@github.com:nicoladl/symfony-app.git
```

2. Install project's dependences
```
cd symfony-app && composer install
```

3. Copy file .env to .env.local and update with your db info on the line
```
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```

4. Create database and import migrations
```
php bin/console doctrine:database:create
```
```
php bin/console doctrine:migrations:migrate
```

5. Install the dipendences and compile assets
```
yarn install && yarn encore dev
```

6. Run the application
```
php bin/console server:run
```

7. Open http://127.0.0.1:8000 to start