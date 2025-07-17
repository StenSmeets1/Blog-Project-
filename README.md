# Setup


## Fedora
```
sudo dnf install php php-cli php-mbstring php-xml php-curl php-sqlite3 composer nodejs npm sqlite
```

## Arch
```
sudo pacman -S php composer nodejs npm sqlite
```







## All

```
git clone https://github.com/StenSmeets1/Blog-Project-.git
cd Blog-Project
```


```
cp .env.example .env
```


Ensure .env has
```
DB_CONNECTION=sqlite
```


```
composer install
npm install
```

```
php artisan key:generate
```

```
php artisan serve
npm run dev
```


