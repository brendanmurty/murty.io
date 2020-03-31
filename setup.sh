# Initialise the environment configuration file
cp .env.example .env

# Fix folder permissions
if [ "$(uname -s)" == "Linux" ]; then
  sudo chown -R www-data:www-data storage
  sudo chmod -R 777 storage
fi

# Install PHP 7.3 if required
if [ "$(uname -s)" == "Linux" ]; then
  sudo apt -y install software-properties-common
  sudo add-apt-repository ppa:ondrej/php
  sudo apt-get update
  sudo apt-get upgrade
  sudo apt -y install php7.3 php7.3-mbstring php7.3-xml php7.3-zip
else
  if [ "$(which php)" == "" ]; then
    echo "Please install PHP 7.3 manually first: https://www.php.net/manual/en/install.php"
    exit 0;
  fi
fi

# Install Node 10 if required
if [ "$(uname -s)" == "Linux" ]; then
  curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
  sudo apt-get install -y nodejs
else
  if [ "$(which node)" == "" ]; then
    echo "Please install Node 10 manually first: https://nodejs.org/en/download/package-manager/"
    exit 0;
  fi
fi

# Install the required global packages
npm install --global cross-env unzip
composer global require laravel/vapor-cli

# Install Composer 1.8 globally if required
if [ "$(which composer)" == "" ]; then
  if [ "$(uname -s)" == "Linux" ]; then
    wget https://raw.githubusercontent.com/composer/getcomposer.org/d3e09029468023aa4e9dcd165e9b6f43df0a9999/web/installer -O - -q | php -- --quiet
    sudo mv composer.phar /usr/bin/composer
  else
    echo "Please install Composer 1.8 manually first: https://getcomposer.org/download/"
    exit 0;
  fi
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
