# twitter-said-what

A web-enabled twitter query-bot thingy. 

# About

The aim of this project is to create a web based twitter query tool that is simple to deploy on a typical web server.

# Release Notes

- Basic function achieved, not much beyond basic functionality.
- The front end runs a little PHP script to hand the form GET data.
- The PHP script converts the GET data to a jSON string and stores that to a temporary file on the server.
- The php session id is recorded and used to compose the output file name.
- The 'tweets' python script is then called with the input and output filenames.
- The jSON string contains all the input parameters, and is used to construct the query.
- After the query runs, the output CSV file is generated using the php session id generated filename.
- The output folder is "csv" folder, and must have write permission for your web server to be able to write there.

# jSON input file format

```
{
  "username": "elonmusk",
  "limit": "100",
  "query": "filter:verified",
  "since": "2010-01-01",
  "until": "2020-01-01"
}

```

# To do on some later rainy day...

- Include a CSS URL for styling
- Remove dependency on PHP and make the front-end purely AJAX driven.
- Better error detection.
- Increase the output record limit.
- Option to compress (.zip) the csv file.

# Fetch and Setup
```
sudo apt-get install python3
sudo apt install python-is-python3
sudo apt-get install apache2
sudo apt-get install php
sudo pip3 install pandas
sudo pip3 install snscrape
git clone https://github.com/8bitgeek/twitter-said-what.git
cp -arvf twitter-said-what/* <some-web-directory>

```
# Demo

http://8bitgeek.ddns.net/~mike/tweets.php

# Other Sources of Information

https://pypi.org/project/snscrape/


