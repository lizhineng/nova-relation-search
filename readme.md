## Relation search feature for Nova resource.
Currently, Nova resource doesn't support relation search out of the box, and the package is to give that ability to you.

### Installation

You can install the package to your Laravel app by using the following command via Composer.

`composer require lizhineng/nova-relation-search`

### Usage
```php
// in the App/Nova/Post.php
...

import LiZhineng\NovaRelationSearch\HandleRelationSearch;

use HandleRelationSearch;

public static $relatedSearch = [
    'user' => ['name'],
];

...
```

After the extremely easy setup, now you can go to search your resource and test it, have fun :-)