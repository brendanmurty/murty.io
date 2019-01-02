# Setup the environment variables
cp .env.example .env

# Install the required binaries
sudo apt -y install php7.2 php7.2-mbstring php7.2-xml php7.2-zip nodejs npm

# Install the required global NPM packages
sudo npm install --global cross-env

# Install Composer globally
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
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
systemctl restart apache2

# Fix folder permissions
sudo chown -R www-data:www-data storage
sudo chmod -R 777 storage
