## FS Sample Application

Please use the @TODO to find the things we are wanting you to complete

#### Tasks
- Make an area where someone can add books they've bought.
    - Books need a title, author, blurb, status (not started, started, finished, retired).
    - Need a list of current books paginated, and a way to add/edit/remove books
- Make an api route where someone can get their books (needs to be filtered by current status only)
- Make an api route where someone can get the details of 1 book by id

### Installation
- Update composer, as I've added a package for Enum's.
- Run `php artisan migrate --seed`. This will generate dummy/fake data for Books.

### TODO
- [ ] Add tests
- [ ] Using of token guard needs registration and login. Check below my suggestion:

#### My suggestion
Instead of using User credentials, if we use request params to generate authorization key, then the API will be accessible publicly.
- Create an endpoint
    - for auth key generation based on request params. This also stores the request params in serialised format
    along with the generated token in database.
    - By default we store the token validity in the above table as well,
    which means the generated token has a expiry of certain time. Once it's expired, then any
    requests will get a new token.

#### References
- https://laravel.com/docs/6.x/api-authentication - use the token guard here
