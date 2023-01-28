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

# Using the `tweets` script

```
  $ tweets -i <input-json-file> -o <output-file-name>
  example:
     $ tweets -i /tmp/1234abc.json -o csv/tdel49pq54drsjavk2ar76ho6g.csv
```

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

# Using the `clean` script

```
  $ clean -m <minutes-old>
```

Where all files in the cvs/ folder older than 'minutes-old' will be moreved.

# To do on some later rainy day...

- Enable other sites besides twitter, such as facebook, etc...
- Include a CSS URL for styling
- Remove dependency on PHP and make the front-end purely AJAX driven.
- Better error detection.
- Increase the output record limit.
- Option to compress (.zip) the csv file.
- Alternative output formats (jSON,XML,etc..)
- HTTP GET Option to supress the form data and emit the output data.

# Fetch and Setup
```
sudo apt-get install python3
sudo apt-get install python-is-python3
sudo apt-get install apache2
sudo apt-get install php
sudo pip3 install pandas
sudo pip3 install snscrape
git clone https://github.com/8bitgeek/twitter-said-what.git
cp -arvf twitter-said-what/* <some-web-directory>
```
# Demo

http://tweets.8bitgeek.net/

# Other Sources of Information

https://pypi.org/project/snscrape/


