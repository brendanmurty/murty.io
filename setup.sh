# Initialise the environment configuration file
cp .env.example .env

# Fix folder permissions
if [ "$(uname -s)" == "Linux" ]; then
  sudo chown -R www-data:www-data storage
fi
sudo chmod -R 777 storage

# Install PHP 7.3 if required
if [ "$(uname -s)" == "Linux" ]; then
  sudo apt -y install software-properties-common
  sudo add-apt-repository ppa:ondrej/php
  sudo apt-get update
  sudo apt-get upgrade
  sudo apt -y install php7.3 php7.3-mbstring php7.3-xml php7.3-zip
else
  if [ "$(which php)" == "" ]; then
    echo "Please install PHP 7.3 manually: https://www.php.net/manual/en/install.php"
  fi
fi

# Install Node 10 if required
if [ "$(uname -s)" == "Linux" ]; then
  curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
  sudo apt-get install -y nodejs
else
  if [ "$(which node)" == "" ]; then
    echo "Please install Node 10 manually: https://nodejs.org/en/download/package-manager/"
    echo "Exiting."
    exit 0;
  fi
fi

# Install the required global NPM packages
sudo npm install --global cross-env unzip

# Install Composer 1.8 globally if required
if [ "$(which composer)" == "" ]; then
  wget https://raw.githubusercontent.com/composer/getcomposer.org/d3e09029468023aa4e9dcd165e9b6f43df0a9999/web/installer -O - -q | php -- --quiet
  sudo mv composer.phar /usr/bin/composer
fi

# Install the site's dependencies
composer install
npm install

# Setup the random key to use for this environment
php artisan key:generate

# Configure the required Apache modules
if [ "$(uname -s)" == "Linux" ]; then
  sudo a2enmod headers
  sudo service apache2 restart
fi

# Compile the front-end assets
npm run production
