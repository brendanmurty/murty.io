# Setup the environment variables
cp .env.example .env

# Install the required binaries
sudo apt -y install php7.2 php7.2-mbstring php7.2-xml php7.2-zip nodejs npm

# Install the required global NPM packages
sudo npm install --global cross-env

# Install Composer globally
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
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
