[murty.io](http://murty.io)
=======

[![](/images/brendan/brendan_murty.jpg)](http://b.murty.io) [![](/images/isla/isla_murty.jpg)](http://i.murty.io)

## About

Here's the [Murty website](http://murty.io) built with [Angular](https://angularjs.org/), [Express](https://expressjs.com/) and [Feather](http://feathericons.com) icons.

## Why

I was inspired by [Brad Frost](https://github.com/bradfrost)'s [TED talk](https://twitter.com/brad_frost/status/476515058738925568) about being open by default. If you haven't seen this talk yet, I'd recommend investing half an hour to [watch the video](https://www.youtube.com/watch?v=7rW9vTrN6OU) and read the [blog post](http://bradfrostweb.com/blog/post/creative-exhaust/).

As I'm self-taught, engaging with the [community](https://twitter.com/brendanmurty/lists/web-design/members), [listening to inspirational people](http://boagworld.com/show) and [reading about new techniques](https://signalvnoise.com/programming) helped me turn my passion in to my career.

I hope a budding web developer can learn something new from what I've done here and start their own career. Hopefully I can give back to the community that has taught me so much over the last few years.

## Setup

First you'll need to install [Node.js and NPM](https://nodejs.org/en/download/).

Then Git Clone the repo in to a suitable directory, such as `/var/www/murty.io`.

To install the required packages and configure the environment, run these commands from the cloned directory:

```
npm install -g bower gulp-cli nodemon forever && npm install
touch ~/.forever/murty-forever.log && touch ~/.forever/murty-output.log && touch ~/.forever/murty-error.log
```

Note that if you're running Ubuntu, you may have to put `sudo ` in front of the first command above.

### Logs

To view a live history of the logs, run one of these commands:

```
npm run logerror
npm run logoutput
npm run logserver
```

### Development

To update JavaScript and CSS build files run: `gulp`
To start a development web server run: `npm run startdev`

Note that if you're running Ubuntu, you may have to put `sudo ` in front of the second command above.

### Production

To start a production web server run: `npm run start`
To stop a production web server run: `npm run stop`

## Contribute

If you have an idea for a website update or have found a bug, please [submit a new issue](https://github.com/brendanmurty/website/issues/new?assignee=brendanmurty).

## License

You can view the [License](https://github.com/brendanmurty/website/blob/master/license.md) file for rights and limitations when using the code here in your own projects.

The license is based on the [CSS-Tricks License](https://css-tricks.com/license/) which was created by [Chris Coyier](https://github.com/chriscoyier/).
