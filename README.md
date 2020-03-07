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

などがある。expressionsには、配列でexpressionを格納する。typeによって必要なexpressionsやvalueは異なる。
例えば条件式equalsは二つのexpressionが必要で、ifは3つのexpressionが必要。
また、constantやvariableはexpressionsは不要だが、valueを必要とする。

# sample

## sample1

```php
$engine = Parser::parse(json_decode('JSONで書いた計算式（後述）', true));
$engine->evaluate([
    "ken" => "東京",
    "city" => "杉並"
]);
> '東京都杉並区のデータだよ'

$engine->evaluate([
    "ken" => "東京",
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
							"value": "ken"
						},
						{
							"type": "constant",
							"value": "tokyo"
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
							"value": "suginami"
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
    "less!"
  ]
}
```

expressionを文字列で指定した場合は、constantとして扱われる。