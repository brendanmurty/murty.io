# Setup the environment variables
cp .env.example .env

# Install the required binaries
sudo apt -y install php7.2 php7.2-mbstring php7.2-xml php7.2-zip nodejs npm

# Install the required global NPM packages
sudo npm install --global cross-env

# Install Composer 1.8 globally
wget https://raw.githubusercontent.com/composer/getcomposer.org/d3e09029468023aa4e9dcd165e9b6f43df0a9999/web/installer -O - -q | php -- --quiet
sudo mv composer.phar /usr/bin/composer

# Install the site's required packages
composer install
sudo npm install

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
