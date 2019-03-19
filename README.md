## Installation instructions

1. Clone the project using git `git clone github@...`

1. Navigate into the project and run 

    1. `composer install`
    
    1. `cp .env.example .env`
    
        1. Modify `.env` to match you DB credentials (username, password, database)

    1. `php artisan key:generate`

    1. `php artisan migrate`
    
    
    
    
## Mailchip API
1. Change URL in public/js/js.js to point to your server
1. Code to use is placed in resources/views/test/layout.blade.php - line 76-81 or you can use
```javascript
    (function(){
        var a=document, b=a.createElement("script"); b.type="text/javascript";
        b.async=!0; b.src=('https:'==document.location.protocol ? 'https://' :
            'http://') + 'technicaltest.localhost/js/js.js';
        a=a.getElementsByTagName("script")[0]; a.parentNode.insertBefore(b,a);
    })();
```
