# stackoverflow-explorer
A web app that allows you to explore Stack Overflow's [data](https://data.stackexchange.com/) in a CRUD interface. Built using React, Symfony, SQL Server, Caddy, and Docker.

## `docker` Branch
I initially planned on using Docker with this app, but I realized it'd be more simple to run everything locally instead
since I'm planning on only using this on my local machine. This `docker` branch was my attempt to use Docker. It's currently
running into some issues where the PHP extensions aren't downloading correctly.