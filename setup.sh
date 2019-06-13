# Setup the environment variables
cp .env.example .env

# Install PHP 7.3
sudo apt -y install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get upgrade
sudo apt -y install php7.3 php7.3-mbstring php7.3-xml php7.3-zip

# Install Node 10
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
sudo apt-get install -y nodejs

# Install the required global NPM packages
sudo npm install --global cross-env

# Install Composer 1.8 globally
wget https://raw.githubusercontent.com/composer/getcomposer.org/d3e09029468023aa4e9dcd165e9b6f43df0a9999/web/installer -O - -q | php -- --quiet
sudo mv composer.phar /usr/bin/composer

# Install the site's dependencies
composer install
npm install

# Setup the random key to use for this environment
php artisan key:generate

# Configure the required Apache modules
sudo a2enmod headers
sudo service apache2 restart

# Fix folder permissions
sudo chown -R www-data:www-data storage
sudo chmod -R 777 storage

# Compile the front-end assets
npm run production
