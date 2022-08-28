# Facebook Scraper API

The team behind PHP Scraper is working on providing commercial APIs for various common use-cases as well as platforms. These APIs aren't self-hosted. You won't need to worry about rotating IPs/proxies, running a headless browser such as Puppeteer. A simple API call will get you all information required. The services will be provided on a attractive usage-dependent fee-structure basis.

For Facebook we are considering the implementation of an API with the following scope.

## Proposed Supported Endpoints

- User: Public User Profile
- User: Other Social Accounts
- User: Friends List
- User: Images
- User: Location Posts
- User: User Posts
- Public Groups and private groups with key: Public Group Profile
- Public Groups and private groups with key: Member List
- Public Groups and private groups with key: Images
- Public Groups and private groups with key: Location Posts
- Public Groups and private groups with key: Posts
- Post: Public Post Details (incl. comments, likes, likers, etc.)

::: tip
Please note this list of API endpoints is *not* final is likely going to change.
:::

## Platform Support

With the approach to use a managed API, users are freed from worrying about rotating proxies, scaling issues, and outages. Also, a wide range of platforms is supported. You can easily integrate into NodeJS, Python (without requests or beautifulsoap), Golang, etc. Any platform that allows to execute GET requests can be programmed to request data from this service.
