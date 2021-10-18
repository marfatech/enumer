Enumer
======

Введение
--------

Компонент предоставляет возможность управлять enum.

Установка
---------

Откройте консоль и, перейдя в директорию проекта, выполните следующую команду для загрузки наиболее подходящей
стабильной версии этого компонента:
```bash
    composer require marfatech/enumer
```
*Эта команда подразумевает что [Composer](https://getcomposer.org) установлен и доступен глобально.*

Пример использования
--------------------

```php
<?php

use MarfaTech\Component\Enumer\Enumer;
use MarfaTech\Component\Enumer\EnumRegistry;
use MarfaTech\Component\Enumer\Example\GenderEnum;

$enumRegistry = new EnumRegistry();
$enumRegistry->addEnum(GenderEnum::class);

$enumer = new Enumer($enumRegistry);

// Нормализация значения
$enumer->normalize(GenderEnum::class, 'male');

// Получеие списка 
$enumer->getList(GenderEnum::class);

// Получеие списка с ключами 
$enumer->getCombineList(GenderEnum::class);
```

Лицензия
--------

[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](./LICENSE)
