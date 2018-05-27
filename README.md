# Identity Card Of China (PHP)

中华人民共和国身份证（The identity card of the people's Republic of China）

>  JavaScript 版本：https://githu.com/medz/id-card-of-china-js

`id-card-of-china` 是一个基于「身份证号码」规则获取身份证号码中包含的基础信息组件。

## 安装

- 你的 PHP 版本应该 `>= 7.0`

我们使用 Composer 安装：

```bash
composer require medz/id-card-of-china
```

## 使用

遵循 PHP-MD 原则，这个工具不提供静态调用，所以使用需要进行对象实例化：

```php
use Medz\IdentityCard\China\Identity;

$peopleIDNumber = '350301198906180060';
$peopleIdentity = new Identity($peopleIDNumber);
```

## APIs

> 基于 `Medz\IdentityCard\China\IdentityInterface` 实例

- `legal`：检查身份证号码是否合法
- `birthday`：获取身份证号码中包含的生日信息
- `gender`：获取身份证包含的性别信息
- `region`: 获取身份证包含的地区信息，返回 `Medz\IdentityCard\China\Region\RegionInterface` 实例

### `region` 对象 APIs

- `code`： 获取 GB/T 2260 的地区行政代码
- `province`：获取省份名称或者直辖市名称
- `city`：获取城市名称，如果是直辖市则返回 `''`
- `county`：获取区县名称
- `tree`：获取地区层级数组
- `treeString`：获取地区完整字符串，支持传递一个参数作为省市区的分隔符

### 演示

```php
use Medz\IdentityCard\China\Identity;

$peopleIDNumber = '350302198906180060';
$peopleIdentity = new Identity($peopleIDNumber);
$peopleRegion = $peopleIdentity->region();

var_dump(
    $peopleIdentity->legal(),    // true | false
    $peopleIdentity->birthday(), // 1989-06-18
    $peopleIdentity->gender(),   // 女 | 男
    $peopleRegion->code(),       // 350302
    $peopleRegion->province(),   // 福建省
    $peopleRegion->city(),       // 莆田市
    $peopleRegion->county(),     // 城厢区
    $peopleRegion->tree(),       // ["福建省", "莆田市", "城厢区"]
    $peopleRegion->treeString(' ') // 福建省 莆田市 城厢区
);
```

## LICENSE

This package follows the MIT open source agreement.
