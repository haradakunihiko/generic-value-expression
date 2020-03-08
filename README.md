# 概要
渡されたデータを、jsonで定義された式に沿って計算を行います。

# 計算式の定義
以下の形が基本形。これを`expression`と呼ぶ。`expression`は複数の`expression`を子に持つとことができる。

```json
{
  "type": "type_name",
  "value": "value if necessary",
  "expressions": []
}
```

typeは、

- 値を示すもの
    - constant
    - variable
- 条件式
    - equals
    - and
    - or
    - morethan
- 関数
    - concat
    - if
    - multiply
    - add
- 集約
    - count
    - countif
    - exists
    - max
    - sum


`type`によって必要な`expressions`や`value`は異なる。例えば、

- 条件式`equals`は二つの値を比較するため、 2つの`expression`を指定する必要がある。
- ifは、 `条件式`、`trueの場合の返り値`、`falseの場合の返り値`　の3つの `expression`が必要。
- `constant`や`variable`の値を表す場合は `value` が必要。

# sample
sampleディレクトリも参照。

## sample1

### 計算式定義
出庫依頼に含まれる商品の合計金額に税額を加えた金額を算出して、最後に円をつける
```json
{
  "type": "concat",
  "expressions": [
    {
      "type": "multiply",
      "expressions": [
        {
          "type": "sum",
          "expressions": [
            {
              "type": "variable",
              "value": "items"
            },
            {
              "type": "multiply",
              "expressions": [
                {
                  "type": "variable",
                  "value": "quantity"
                },
                {
                  "type": "variable",
                  "value": "price"
                }
              ]
            }
          ]
        },
        1.08
      ]
    },
    "円"
  ]
}

```


```php
$engine = Parser::parse(json_decode('JSONで書いた計算式', true));
echo $engine->evaluate([
    'items' => [
        ['quantity' => 3, 'price' => 100],
        ['quantity' => 2, 'price' => 500],
    ]
]) . PHP_EOL;

> 1404円
```


## sample2
itemsに、OL001-I000001が3レコード以上かつOL001-I000002を含むという条件に当てはまるかをチェック
### 計算式
```json
{
  "type": "and",
  "expressions": [
    {
      "type": "morethan",
      "expressions": [
        {
          "type": "countif",
          "expressions": [
            {
              "type": "variable",
              "value": "items"
            },
            {
              "type": "equals",
              "expressions": [
                {
                  "type": "variable",
                  "value": "uid"
                }, "OL001-I000001"
              ]
            }
          ]
        },
        2
      ]
    },
    {
      "type": "exists",
      "expressions": [
        {
          "type": "variable",
          "value": "items"
        }, {
          "type": "equals",
          "expressions": [
            {
              "type": "variable",
              "value": "uid"
            }, "OL001-I000002"
          ]
        }
      ]
    }
  ]
}

```


```php
$engine = Parser::parse(json_decode('JSONで書いた計算式', true));

echo $engine->evaluate([
        'items' => [
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000002'],
        ]
    ]) . PHP_EOL;
> 1
```

※ `expression`をオブジェクトではなく文字列・数値で指定した場合は、`constant`として扱われる。

## sample3
CSVの変換にexpressionを用いた例

`./sample/csv_export` 参照
