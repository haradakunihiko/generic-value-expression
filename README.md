# 概要
渡されたデータを、jsonで定義された式に沿って計算を行います。

# 計算式の定義
以下の形が基本形。これをexpressionと呼ぶ。

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
- 計算式
    - max
    - count
    - if

などがある。`expressions`には、配列で`expression`を格納する。`type`によって必要な`expressions`や`value`は異なる。
例えば条件式`equals`は二つの`expression`が必要で、ifは3つの`expression`が必要。
また、`constant`や`variable`は`expressions`は不要だが、`value`を必要とする。

# sample
sampleディレクトリも参照。

## sample1

```php
$engine = Parser::parse(json_decode('JSONで書いた計算式（後述）', true));
$engine->evaluate([
    "prefecture" => "東京",
    "city" => "杉並"
]);
> '東京都杉並区のデータだよ'

$engine->evaluate([
    "prefecture" => "東京",
    "city" => "豊島"
]);
> '東京都杉並区のデータじゃないよ'
```

計算式定義
```json
{
	"type": "if",
	"expressions": [
		{
			"type": "and",
			"expressions": [
				{
					"type": "equals",
					"expressions": [
						{
							"type": "variable",
							"value": "prefecture"
						},
						{
							"type": "constant",
							"value": "東京"
						}
					]
				},
				{
					"type": "equals",
					"expressions": [
						{
							"type": "variable",
							"value": "city"
						},
						{
							"type": "constant",
							"value": "杉並"
						}
					]
				},

			]
		}, {
			"type": "constant",
			"value": "東京都杉並区のデータだよ"
		}, {
			"type": "constant",
			"value": "東京都杉並区のデータじゃないよ"
		}
	]
}

```

## sample2


```php
$engine = createExpressionEvaluateEngine(
    '{"type":"if","expressions":[{"type":"morethan","expressions":[{"type":"count","expressions":[{"type":"variable","value":"items"}]},3]},"many!","less!"]}'
);

echo $engine->evaluate([
    'items' => [
        [],
        [],
        [],
    ]
]);
> few!

echo $engine->evaluate([
    'items' => [
        [],
        [],
        [],
        [],
    ]
]) . PHP_EOL;
> many!
```

```json
{
  "type": "if",
  "expressions": [
    {
      "type": "morethan",
      "expressions": [
      	{
      		"type": "count",
      		"expressions": [
      			{
      				"type": "variable",
      				"value": "items"
      			}
      		]
      	},
      	3
      ]
    },
    "many!",
    "few!"
  ]
}
```

`expression`をオブジェクトではなく文字列・数値で指定した場合は、`constant`として扱われる。