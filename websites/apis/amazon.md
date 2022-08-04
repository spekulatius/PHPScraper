# Amazon Scraper API

The team behind PHP Scraper is working on providing commercial APIs for various common use-cases as well as platforms. These APIs are not intended to be self-hosted and will be provided on a pay-as-you-use basis.

For Amazon we are considering the implementation of an API with the following scope.

## Proposed Supported Endpoints

- Get Product Information
- Get Recommendations
- Get Review Information
- Get Seller Information
- Get all Seller Prices
- Search Products by Keyword or SellerID

Please note that this is not final and is likely to change.

## Platform Support

With the approach to use a managed API, users are freed from worrying about rotating proxies, scaling issues, and outages. Also, a wide range of platforms is supported. You can easily integrate into NodeJS, Python (without requests or beautifulsoap), Golang, etc. Any platform that allows to execute GET requests can be programmed to request data from this service.
