# Identity Card Of China (PHP)

中华人民共和国身份证（The identity card of the people's Republic of China）

[![Build Status](https://travis-ci.com/medz/id-card-of-china.svg?branch=master)](https://travis-ci.com/medz/id-card-of-china)

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

## 疑问解答

1. 问：为什么不添加年龄、星座还有属相等信息？

   答：因为年龄需要专门的时间组件去计算，星座如果是「粗略」计算可以获得，但是没有意义，属相更加负责，负责任的转换这些属性都比简单复杂，简单转换出来的不够准确。同样也失去了包本身该有的功能，例如年龄可以交给「时间组件」等。

2. 问：这个包到底干啥的？

   答：这个包就是提取身份证号码所包含的基础信息

3. 问：可以用来验证人或者其他的吗？

   答：不基于公安部的 API 验证的身份证组件都不能叫验证组件，现在所有的 ID Card 组件都只能提取身份证号码所包含的信息，如果说验证，那唯一能验证的就是身份证号码是否是一个合法的身份证号码。

4. 问：如何获取年龄？
   答：例如在 PHP 中，获取年龄是一个很简单的时区，我用最快的例子，你依赖 `nesbot/carbon` 这个「时间工具」包，依赖代码：
   ```bash
   composer require nesbot/carbon
   ```
   然后看我下面的 PHP 代码：
   ```php
   use Carbon\Carbon;
   $birthday = new Carbon($identity->birthday());
   $age = $birthday->diffInYears();
   ```
   好了，你答应下 `$age` 试试看！

## LICENSE

This package follows the MIT open source agreement.
