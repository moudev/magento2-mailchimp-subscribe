# magento2-mailchimp-subscribe
Module of Magento 2. You can add subscribers to a MailChimp email list, a send campaings for
email to people in the list. For example create in your store a list of clients to send promotions.

## Configuration

You need change the API_KEY, ID_LIST_MAILCHIMP and SERVER that MailChimp provide you. You can get more info in their [official documentation](https://mailchimp.com/es/help/about-api-keys/).

- API_KEY: [Model/View/Request.php #L21](https://github.com/moudev/magento2-mailchimp-subscribe/blob/b38b24877c4ecf27a057a27196c30866922d2703/Model/View/Request.php#L21
)
```php
protected $KEY = "<KEY_MAILCHIMP>"; 
// After - example
protected $KEY = "459d667871186d19bd0322c35623178d-us20"; 

```

- SERVER: [Model/View/Request.php #L27](https://github.com/moudev/magento2-mailchimp-subscribe/blob/b38b24877c4ecf27a057a27196c30866922d2703/Model/View/Request.php#L27)
```php
protected $URL = "https://<SERVER>.api.mailchimp.com/3.0/lists/";
// After - example
protected $URL = "https://us20.api.mailchimp.com/3.0/lists/";
```

## Demo

![Luma](https://user-images.githubusercontent.com/13499566/59899794-4eae8500-93b3-11e9-81ca-7ccc346e3386.gif)

---
### Module made with purpose to learn Magento 2
Practice about development of a module from scratch. Probably the code and some practices aren't the corrects,
but I excuse me, I'm process of learning, also Magento 2 have a large curve of learning and I don't know all
standars of development in this great framework , so, I includeds a few common tasks

In the process of development this module I learned;
- Workflow of modules in Magento 2.
- Structure of folders.
- Add custom routes in a module.
- Add custom JS in a module.
- Add custom CSS in a module.
- Create an API call, Mailchimp in this case.

---
_Sorry for the redaction, I'm trying to improve my english. So, is now or never._
