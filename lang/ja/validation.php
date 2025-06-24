<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeを承諾してください。',
    'accepted_if' => ':otherが:valueの場合、:attributeを承諾してください。',
    'active_url' => ':attributeに正しいURLを指定してください。',
    'after' => ':attributeには:dateより後の日付を指定してください。',
    'after_or_equal' => ':attributeには:date以降の日付を指定してください。',
    'alpha' => ':attributeには文字のみ使用できます。',
    'alpha_dash' => ':attributeには文字、数字、ダッシュ、アンダースコアのみ使用できます。',
    'alpha_num' => ':attributeには文字と数字のみ使用できます。',
    'array' => ':attributeには配列を指定してください。',
    'ascii' => ':attributeには半角英数字および記号のみ使用できます。',
    'before' => ':attributeには:dateより前の日付を指定してください。',
    'before_or_equal' => ':attributeには:date以前の日付を指定してください。',
    'between' => [
        'array' => ':attributeの項目数は:min〜:max個の間で指定してください。',
        'file' => ':attributeのファイルサイズは:min〜:maxキロバイトの間で指定してください。',
        'numeric' => ':attributeには:min〜:maxの数値を指定してください。',
        'string' => ':attributeには:min〜:max文字の文字列を指定してください。',
    ],
    'boolean' => ':attributeにはtrueかfalseを指定してください。',
    'confirmed' => ':attributeの確認が一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeに正しい日付を指定してください。',
    'date_equals' => ':attributeには:dateと同じ日付を指定してください。',
    'date_format' => ':attributeの形式が:formatと一致しません。',
    'decimal' => ':attributeには:decimal桁の小数を指定してください。',
    'declined' => ':attributeを拒否してください。',
    'declined_if' => ':otherが:valueの場合、:attributeを拒否してください。',
    'different' => ':attributeと:otherには異なる値を指定してください。',
    'digits' => ':attributeには:digits桁の数字を指定してください。',
    'digits_between' => ':attributeには:min〜:max桁の数字を指定してください。',
    'dimensions' => ':attributeの画像サイズが正しくありません。',
    'distinct' => ':attributeに重複した値があります。',
    'doesnt_end_with' => ':attributeは:valuesで終わってはいけません。',
    'doesnt_start_with' => ':attributeは:valuesで始まってはいけません。',
    'email' => ':attributeに正しいメールアドレスを指定してください。',
    'ends_with' => ':attributeは:valuesのいずれかで終わる必要があります。',
    'enum' => '選択された:attributeは正しくありません。',
    'exists' => '選択された:attributeは正しくありません。',
    'file' => ':attributeにはファイルを指定してください。',
    'filled' => ':attributeに値を指定してください。',
    'gt' => [
        'array' => ':attributeの項目数は:value個より多い必要があります。',
        'file' => ':attributeのファイルサイズは:valueキロバイトより多い必要があります。',
        'numeric' => ':attributeには:valueより大きい数値を指定してください。',
        'string' => ':attributeには:value文字より多い文字列を指定してください。',
    ],
    'gte' => [
        'array' => ':attributeの項目数は:value個以上である必要があります。',
        'file' => ':attributeのファイルサイズは:valueキロバイト以上である必要があります。',
        'numeric' => ':attributeには:value以上の数値を指定してください。',
        'string' => ':attributeには:value文字以上の文字列を指定してください。',
    ],
    'image' => ':attributeには画像ファイルを指定してください。',
    'in' => '選択された:attributeは正しくありません。',
    'in_array' => ':attributeは:otherに存在しません。',
    'integer' => ':attributeには整数を指定してください。',
    'ip' => ':attributeに正しいIPアドレスを指定してください。',
    'ipv4' => ':attributeに正しいIPv4アドレスを指定してください。',
    'ipv6' => ':attributeに正しいIPv6アドレスを指定してください。',
    'json' => ':attributeに正しいJSON文字列を指定してください。',
    'lowercase' => ':attributeには小文字を指定してください。',
    'lt' => [
        'array' => ':attributeの項目数は:value個より少ない必要があります。',
        'file' => ':attributeのファイルサイズは:valueキロバイトより少ない必要があります。',
        'numeric' => ':attributeには:valueより小さい数値を指定してください。',
        'string' => ':attributeには:value文字より少ない文字列を指定してください。',
    ],
    'lte' => [
        'array' => ':attributeの項目数は:value個以下である必要があります。',
        'file' => ':attributeのファイルサイズは:valueキロバイト以下である必要があります。',
        'numeric' => ':attributeには:value以下の数値を指定してください。',
        'string' => ':attributeには:value文字以下の文字列を指定してください。',
    ],
    'mac_address' => ':attributeに正しいMACアドレスを指定してください。',
    'max' => [
        'array' => ':attributeの項目数は:max個以下である必要があります。',
        'file' => ':attributeのファイルサイズは:maxキロバイト以下である必要があります。',
        'numeric' => ':attributeには:max以下の数値を指定してください。',
        'string' => ':attributeには:max文字以下の文字列を指定してください。',
    ],
    'max_digits' => ':attributeには:max桁以下の数字を指定してください。',
    'mimes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'mimetypes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'min' => [
        'array' => ':attributeの項目数は:min個以上である必要があります。',
        'file' => ':attributeのファイルサイズは:minキロバイト以上である必要があります。',
        'numeric' => ':attributeには:min以上の数値を指定してください。',
        'string' => ':attributeには:min文字以上の文字列を指定してください。',
    ],
    'min_digits' => ':attributeには:min桁以上の数字を指定してください。',
    'missing' => ':attributeフィールドは存在しない必要があります。',
    'missing_if' => ':otherが:valueの場合、:attributeフィールドは存在しない必要があります。',
    'missing_unless' => ':otherが:valueでない場合、:attributeフィールドは存在しない必要があります。',
    'missing_with' => ':valuesが存在する場合、:attributeフィールドは存在しない必要があります。',
    'missing_with_all' => ':valuesが存在する場合、:attributeフィールドは存在しない必要があります。',
    'multiple_of' => ':attributeは:valueの倍数である必要があります。',
    'not_in' => '選択された:attributeは正しくありません。',
    'not_regex' => ':attributeの形式が正しくありません。',
    'numeric' => ':attributeには数値を指定してください。',
    'password' => 'パスワードが正しくありません。',
    'present' => ':attributeフィールドが存在している必要があります。',
    'prohibited' => ':attributeフィールドは禁止されています。',
    'prohibited_if' => ':otherが:valueの場合、:attributeフィールドは禁止されています。',
    'prohibited_unless' => ':otherが:valuesにない場合、:attributeフィールドは禁止されています。',
    'prohibits' => ':attributeフィールドは:otherの存在を禁止します。',
    'regex' => ':attributeの形式が正しくありません。',
    'required' => ':attributeフィールドは必須です。',
    'required_array_keys' => ':attributeフィールドには:valuesのエントリが含まれている必要があります。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_if_accepted' => ':otherが承諾された場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesにない場合、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesのいずれも存在しない場合、:attributeフィールドは必須です。',
    'same' => ':attributeと:otherには同じ値を指定してください。',
    'size' => [
        'array' => ':attributeには:size個の項目を含める必要があります。',
        'file' => ':attributeのファイルサイズは:sizeキロバイトである必要があります。',
        'numeric' => ':attributeには:sizeを指定してください。',
        'string' => ':attributeには:size文字の文字列を指定してください。',
    ],
    'starts_with' => ':attributeは:valuesのいずれかで始まる必要があります。',
    'string' => ':attributeには文字列を指定してください。',
    'timezone' => ':attributeに正しいタイムゾーンを指定してください。',
    'unique' => ':attributeの値は既に存在しています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'uppercase' => ':attributeには大文字を指定してください。',
    'url' => ':attributeに正しいURLを指定してください。',
    'ulid' => ':attributeに正しいULIDを指定してください。',
    'uuid' => ':attributeに正しいUUIDを指定してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'カスタムメッセージ',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
        'current_password' => '現在のパスワード',
        'phone' => '電話番号',
        'mobile' => '携帯電話',
        'address' => '住所',
        'website' => 'ウェブサイト',
        'industry' => '業界',
        'position' => '役職',
        'notes' => '備考',
        'title' => 'タイトル',
        'amount' => '金額',
        'status' => 'ステータス',
        'expected_closing_date' => '見込み成約日',
        'probability' => '確率',
        'description' => '説明',
        'type' => 'タイプ',
        'scheduled_at' => '予定日時',
        'company_id' => '会社',
        'contact_id' => '連絡先',
        'deal_id' => '商談',
        'first_name' => '名',
        'last_name' => '姓',
    ],
];