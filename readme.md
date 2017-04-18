[murty.io](http://murty.io)
=======

[![](/images/brendan/brendan_murty.jpg)](http://b.murty.io) [![](/images/isla/isla_murty.jpg)](http://i.murty.io)

## About

Here's the contents of the [Murty website](http://murty.io) built with [AngularJS](https://angularjs.org/), served with [Apache 2](https://httpd.apache.org/), coded with [Atom](http://atom.io) and hosted by [Digital Ocean](http://digitalocean.com).

## Why

I was inspired by [Brad Frost](https://github.com/bradfrost)'s [TED talk](https://twitter.com/brad_frost/status/476515058738925568) about being open by default. If you haven't seen this talk yet, I'd recommend investing half an hour to [watch the video](https://www.youtube.com/watch?v=7rW9vTrN6OU) and read the [blog post](http://bradfrostweb.com/blog/post/creative-exhaust/).

As I'm self-taught, engaging with the [community](https://twitter.com/brendanmurty/lists/web-design/members), [listening to inspirational people](http://boagworld.com/show) and [reading about new techniques](https://signalvnoise.com/programming) helped me turn my passion in to my career.

I hope a budding web developer can learn something new from what I've done here and start their own career. Hopefully I can give back to the community that has taught me so much over the last few years.

## Setup

Requires [Node.js and NPM](https://nodejs.org/en/download/).

To install development tools:

```
npm install --global bower
npm install --global gulp-cli
```

To install required packages, run this command from the repository folder:

`npm install`

To update JavaScript and CSS build files, run this command from the repository folder:

`gulp`

Depending on your server setup, you may need to run this command in the website folder:

`chown -R www-data:www-data content`

File paths in the *api* folder may also need to be updated in other server configurations.

## Contribute

If you have an idea for a website update or have found a bug, please [submit a new issue](https://github.com/brendanmurty/website/issues/new?assignee=brendanmurty).

## License

You can view the [License](https://github.com/brendanmurty/website/blob/master/license.md) file for rights and limitations when using the code here in your own projects.

The license is based on the [CSS-Tricks License](https://css-tricks.com/license/) which was created by [Chris Coyier](https://github.com/chriscoyier/).
