# Facebook Scraper API

The team behind PHP Scraper is working on providing commercial APIs for various common use-cases as well as platforms. These APIs are not intended to be self-hosted and will be provided on a pay-as-you-use basis.

For Facebook we are considering the implementation of an API with the following scope.

## Proposed Supported Endpoints

- User: Public User Profile
- User: Other Social Accounts
- User: Friends List
- User: Images
- User: Location Posts
- User: User Posts
- public Groups and private groups with key: Public Group Profile
- public Groups and private groups with key: Member List
- public Groups and private groups with key: Images
- public Groups and private groups with key: Location Posts
- public Groups and private groups with key: Posts
- Post: Public Post Details (incl. comments, likes, likers, etc.)

Please note that this is not final and is likely to change.

## Platform Support

With the approach to use a managed API, users are freed from worrying about rotating proxies, scaling issues, and outages. Also, a wide range of platforms is supported. You can easily integrate into NodeJS, Python (without requests or beautifulsoap), Golang, etc. Any platform that allows to execute GET requests can be programmed to request data from this service.
