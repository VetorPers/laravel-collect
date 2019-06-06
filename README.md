[![Build Status](https://travis-ci.org/VetorPers/laravel-collect.svg?branch=master)](https://travis-ci.org/VetorPers/laravel-collect)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/VetorPers/laravel-collect/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/VetorPers/laravel-collect/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/VetorPers/laravel-collect/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/VetorPers/laravel-collect/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/VetorPers/laravel-collect/badges/build.png?b=master)](https://scrutinizer-ci.com/g/VetorPers/laravel-collect/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/VetorPers/laravel-collect/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/vetor/laravel-collect/v/stable)](https://packagist.org/packages/vetor/laravel-collect)
[![Total Downloads](https://poser.pugx.org/vetor/laravel-collect/downloads)](https://packagist.org/packages/vetor/laravel-collect)
[![Latest Unstable Version](https://poser.pugx.org/vetor/laravel-collect/v/unstable)](https://packagist.org/packages/vetor/laravel-collect)
[![License](https://poser.pugx.org/vetor/laravel-collect/license)](https://packagist.org/packages/vetor/laravel-collect)

# laravel collect


## 安装

使用 composer 安装：

```sh
$ composer require vetor/laravel-collect
```

#### 模型迁移

运行模型迁移命令：

```sh
$ php artisan migrate
```


## 使用方法

### User Model

```
use Illuminate\Foundation\Auth\User as Authenticatable;
use Vetor\Laravel\Collect\Collector\Models\Traits\Collector;
use Vetor\Contracts\Collect\Collector\Models\Collector as CollectorContract;

class User extends Authenticatable implements CollectorContract
{
    use Collector;
}
```

### Article Model

```
use Vetor\Laravel\Collect\Collectable\Models\Traits\Collectable;
use Vetor\Contracts\Collect\Collectable\Models\Collectable as CollectableContract;

class Article extends Model implements CollectableContract
{
    use Collectable;
}
```

### Available Methods

#### User

// 收藏

$user->collect($article);

// 是否收藏

$user->isCollectThis($article);

// 取消收藏

$user->cancelCollect($article);

// 用户的所有收藏记录

$user->collections;

// 用户收藏的文章记录

$user->collectionsWhereCollectable(Article::class);

#### Article

// 收藏

$article->collect();

// 是否收藏

$article->isCollection();

// 取消收藏

$article->cancelCollect();

> 注：默认为当前用户，可以把用户实例作为参数传入。


//  获取文章的收藏情况

$article->collections();

// 获取文章收藏数

$article->collections_count;

// 根据收藏数排序

Article::orderByCollectionsCount()->get();

> 注：升序 'asc'；降序 'desc'；默认为升序。

#### Collection

// 获取收藏表里所有文章

Collection::whereCollectable(Article::class)->get();

