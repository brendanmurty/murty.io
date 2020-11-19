#!/bin/bash

git add .
git stash

composer update
npm update

git add .
git commit -m "Core: Update dependencies"
git push

git stash pop
