<h1 align="center">
  <br>
  <br>
  AppCakeNews
  <br>
</h1>

<h4 align="center">A news parsing app.</h4>

## Key Features

- Parsing service from a news resource
- A page displaying the list of downloaded news
- A CLI command to start parsing
- Parsing features:
  - title
  - short description
  - picture
  - date added
  - checks the presence of the title in the database
  - makes note of last update if the news is already in the database,
  - database queries are optimized for heavy load
- Page for viewing news from the database should be available only after authorization in the system (registration is not required)
- Authorized users can be with one of two roles: admin or moderator (the administrator can delete articles)
- there must be pagination at the end of the list of articles

- Stack:
  - Symfony 5.4
  - Php 8.0
  - Postgres
  - Bootstrap 5.1
  - Docker (docker-compose)
  - RabbitMQ

### Getting Started

```bash
# Unzip the file appcake-news
# Go into the directory
$ cd appcake-news

# Run the bash script to setup the project
$ ./docker-local.sh build 

- Follow the terminal instruction to select yes/no for while setting up the project automatically.

```

### Login Details

Admin:
Email: admin@appcake.com
Password: test123

Moderator:
Email: moderator@appcake.com
Password: test123

### News Source

[CTV News RSS Feed](https://www.ctvnews.ca/rss/world/ctvnews-ca-world-public-rss-1.822289)
