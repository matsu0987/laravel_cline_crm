<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => '株式会社テクノソリューション',
                'email' => 'info@technosolution.co.jp',
                'phone' => '03-1234-5678',
                'website' => 'https://technosolution.co.jp',
                'address' => '東京都渋谷区神宮前5-52-2',
                'postal_code' => '150-0001',
                'city' => '東京都',
                'industry' => 'IT',
                'description' => 'クラウドソリューションとAIを専門とするITサービス企業',
                'notes' => '年間売上：10億円、従業員数：120名'
            ],
            [
                'name' => '株式会社日本商事',
                'email' => 'contact@nihonshouji.co.jp',
                'phone' => '06-8765-4321',
                'website' => 'https://nihonshouji.co.jp',
                'address' => '大阪府大阪市北区梅田3-1-3',
                'postal_code' => '530-0001',
                'city' => '大阪府',
                'industry' => '商社',
                'description' => '電子部品と半導体の輸出入を行う総合商社',
                'notes' => '年間売上：50億円、従業員数：300名、海外拠点：5カ所'
            ],
            [
                'name' => '株式会社グローバルトレード',
                'email' => 'info@globaltrade.co.jp',
                'phone' => '045-2345-6789',
                'website' => 'https://globaltrade.co.jp',
                'address' => '神奈川県横浜市西区みなとみらい2-3-5',
                'postal_code' => '220-0012',
                'city' => '神奈川県',
                'industry' => '貿易',
                'description' => 'アジア地域を中心とした輸出入ビジネスを展開',
                'notes' => '年間取引額：30億円、主要取引国：中国、タイ、ベトナム'
            ],
            [
                'name' => '株式会社フードデリバリー',
                'email' => 'support@fooddelivery.jp',
                'phone' => '052-3456-7890',
                'website' => 'https://fooddelivery.jp',
                'address' => '愛知県名古屋市中区栄3-15-27',
                'postal_code' => '460-0008',
                'city' => '愛知県',
                'industry' => 'フードサービス',
                'description' => '飲食店向けデリバリーサービスとシステム開発',
                'notes' => '契約店舗数：2000店、月間配達数：10万件'
            ],
            [
                'name' => '北海道自然エネルギー株式会社',
                'email' => 'info@hokkaido-energy.co.jp',
                'phone' => '011-9876-5432',
                'website' => 'https://hokkaido-energy.co.jp',
                'address' => '北海道札幌市中央区北1条西2丁目',
                'postal_code' => '060-0001',
                'city' => '北海道',
                'industry' => 'エネルギー',
                'description' => '風力・太陽光発電を中心とした再生可能エネルギー事業',
                'notes' => '発電容量：50MW、CO2削減量：年間2万トン'
            ],
            [
                'name' => '九州メディカルケア株式会社',
                'email' => 'contact@kyushu-medical.co.jp',
                'phone' => '092-8765-4321',
                'website' => 'https://kyushu-medical.co.jp',
                'address' => '福岡県福岡市博多区博多駅前2-1-1',
                'postal_code' => '812-0011',
                'city' => '福岡県',
                'industry' => '医療',
                'description' => '医療機器の開発・販売および介護サービス事業',
                'notes' => '取扱製品数：200種類、介護施設運営：10施設'
            ],
            [
                'name' => '東京建設工業株式会社',
                'email' => 'info@tokyo-kensetsu.co.jp',
                'phone' => '03-5678-1234',
                'website' => 'https://tokyo-kensetsu.co.jp',
                'address' => '東京都新宿区西新宿1-7-1',
                'postal_code' => '160-0023',
                'city' => '東京都',
                'industry' => '建設',
                'description' => '商業施設・オフィスビルの設計・施工を手がける総合建設会社',
                'notes' => '創業：1975年、完工実績：年間30件'
            ],
            [
                'name' => '関西教育システム株式会社',
                'email' => 'support@kansai-edu.co.jp',
                'phone' => '06-1234-5678',
                'website' => 'https://kansai-edu.co.jp',
                'address' => '大阪府大阪市中央区本町4-2-12',
                'postal_code' => '541-0053',
                'city' => '大阪府',
                'industry' => '教育',
                'description' => 'オンライン学習システムと教材開発を行う教育サービス企業',
                'notes' => '導入学校数：500校、登録生徒数：10万人'
            ],
            [
                'name' => '中部物流株式会社',
                'email' => 'info@chubu-logistics.co.jp',
                'phone' => '052-9876-5432',
                'website' => 'https://chubu-logistics.co.jp',
                'address' => '愛知県名古屋市港区港町1-1-1',
                'postal_code' => '455-0033',
                'city' => '愛知県',
                'industry' => '物流',
                'description' => '中部地方を中心とした物流・倉庫サービスを提供',
                'notes' => '倉庫面積：5万平方メートル、車両保有数：100台'
            ],
            [
                'name' => '日本クリエイティブデザイン株式会社',
                'email' => 'contact@creative-design.jp',
                'phone' => '03-2345-6789',
                'website' => 'https://creative-design.jp',
                'address' => '東京都目黒区中目黒3-10-13',
                'postal_code' => '153-0061',
                'city' => '東京都',
                'industry' => 'デザイン',
                'description' => 'ブランディングとUIデザインを専門とするデザイン事務所',
                'notes' => '受賞歴：グッドデザイン賞5回、クライアント数：年間50社'
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
