<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 会社IDを取得
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->info('会社データが存在しません。先にCompanySeederを実行してください。');
            return;
        }

        // 管理者ユーザーを取得
        $adminUser = \App\Models\User::where('role', 'admin')->first();

        // 管理者ユーザーが存在しない場合は最初のユーザーを取得
        if (!$adminUser) {
            $adminUser = \App\Models\User::first();
        }

        // ユーザーIDを設定
        $userId = $adminUser ? $adminUser->id : null;

        if (!$userId) {
            $this->command->info('ユーザーデータが存在しません。先にAdminUserSeederを実行してください。');
            return;
        }

        $contacts = [
            // 株式会社テクノソリューション
            [
                'company_id' => 1,
                'user_id' => $userId,
                'first_name' => '太郎',
                'last_name' => '鈴木',
                'email' => 'suzuki.taro@technosolution.co.jp',
                'phone' => '03-1234-5678',
                'mobile' => '090-1234-5678',
                'position' => '代表取締役社長',
                'notes' => '創業者。技術背景があり、AIと機械学習に詳しい。',
            ],
            [
                'company_id' => 1,
                'user_id' => $userId,
                'first_name' => '花子',
                'last_name' => '佐藤',
                'email' => 'sato.hanako@technosolution.co.jp',
                'phone' => '03-1234-5679',
                'mobile' => '090-2345-6789',
                'position' => '営業部長',
                'notes' => '入社5年目。主に大手企業向け営業を担当。'
            ],

            // 株式会社日本商事
            [
                'company_id' => 2,
                'user_id' => $userId,
                'first_name' => '一郎',
                'last_name' => '田中',
                'email' => 'tanaka.ichiro@nihonshouji.co.jp',
                'phone' => '06-8765-4321',
                'mobile' => '080-1111-2222',
                'position' => '取締役',
                'notes' => '海外事業部門担当。中国語と英語が堪能。'
            ],
            [
                'company_id' => 2,
                'user_id' => $userId,
                'first_name' => '次郎',
                'last_name' => '山田',
                'email' => 'yamada.jiro@nihonshouji.co.jp',
                'phone' => '06-8765-4322',
                'mobile' => '080-3333-4444',
                'position' => '営業課長',
                'notes' => '電子部品専門。技術的な知識が豊富。'
            ],

            // 株式会社グローバルトレード
            [
                'company_id' => 3,
                'user_id' => $userId,
                'first_name' => '三郎',
                'last_name' => '伊藤',
                'email' => 'ito.saburo@globaltrade.co.jp',
                'phone' => '045-2345-6789',
                'mobile' => '070-5555-6666',
                'position' => 'CEO',
                'notes' => 'タイでの駐在経験あり。東南アジア市場に強い。'
            ],
            [
                'company_id' => 3,
                'user_id' => $userId,
                'first_name' => '恵子',
                'last_name' => '高橋',
                'email' => 'takahashi.keiko@globaltrade.co.jp',
                'phone' => '045-2345-6780',
                'mobile' => '070-7777-8888',
                'position' => 'マーケティング部長',
                'notes' => '市場調査のスペシャリスト。データ分析が得意。'
            ],

            // 株式会社フードデリバリー
            [
                'company_id' => 4,
                'user_id' => $userId,
                'first_name' => '健太',
                'last_name' => '渡辺',
                'email' => 'watanabe.kenta@fooddelivery.jp',
                'phone' => '052-3456-7890',
                'mobile' => '090-8888-9999',
                'position' => 'CTO',
                'notes' => 'システム開発のリーダー。モバイルアプリ開発が専門。'
            ],
            [
                'company_id' => 4,
                'user_id' => $userId,
                'first_name' => '美咲',
                'last_name' => '加藤',
                'email' => 'kato.misaki@fooddelivery.jp',
                'phone' => '052-3456-7891',
                'mobile' => '080-9999-0000',
                'position' => '営業企画部長',
                'notes' => '飲食店との提携交渉を担当。レストラン業界での経験が豊富。'
            ],

            // 北海道自然エネルギー株式会社
            [
                'company_id' => 5,
                'user_id' => $userId,
                'first_name' => '大輔',
                'last_name' => '吉田',
                'email' => 'yoshida.daisuke@hokkaido-energy.co.jp',
                'phone' => '011-9876-5432',
                'mobile' => '090-1122-3344',
                'position' => '技術部長',
                'notes' => '風力発電の専門家。エンジニアリングバックグラウンド。'
            ],
            [
                'company_id' => 5,
                'user_id' => $userId,
                'first_name' => '直子',
                'last_name' => '山本',
                'email' => 'yamamoto.naoko@hokkaido-energy.co.jp',
                'phone' => '011-9876-5433',
                'mobile' => '080-5566-7788',
                'position' => '財務部長',
                'notes' => '再生可能エネルギー投資の専門知識あり。'
            ],

            // 九州メディカルケア株式会社
            [
                'company_id' => 6,
                'user_id' => $userId,
                'first_name' => '隆',
                'last_name' => '中村',
                'email' => 'nakamura.takashi@kyushu-medical.co.jp',
                'phone' => '092-8765-4321',
                'mobile' => '070-2233-4455',
                'position' => '代表取締役',
                'notes' => '医師の資格保持者。医療機器開発の経験あり。'
            ],
            [
                'company_id' => 6,
                'user_id' => $userId,
                'first_name' => '裕子',
                'last_name' => '小林',
                'email' => 'kobayashi.yuko@kyushu-medical.co.jp',
                'phone' => '092-8765-4322',
                'mobile' => '090-6677-8899',
                'position' => '営業部長',
                'notes' => '病院・クリニック向け営業のエキスパート。'
            ],

            // 東京建設工業株式会社
            [
                'company_id' => 7,
                'user_id' => $userId,
                'first_name' => '浩二',
                'last_name' => '松本',
                'email' => 'matsumoto.koji@tokyo-kensetsu.co.jp',
                'phone' => '03-5678-1234',
                'mobile' => '080-1212-3434',
                'position' => '専務取締役',
                'notes' => '建築士の資格保持。大規模商業施設の設計を多数手がける。'
            ],
            [
                'company_id' => 7,
                'user_id' => $userId,
                'first_name' => '真理子',
                'last_name' => '井上',
                'email' => 'inoue.mariko@tokyo-kensetsu.co.jp',
                'phone' => '03-5678-1235',
                'mobile' => '090-5656-7878',
                'position' => '人事部長',
                'notes' => '採用と社員教育を担当。建設業界での人材育成に詳しい。'
            ],

            // 関西教育システム株式会社
            [
                'company_id' => 8,
                'user_id' => $userId,
                'first_name' => '誠',
                'last_name' => '木村',
                'email' => 'kimura.makoto@kansai-edu.co.jp',
                'phone' => '06-1234-5678',
                'mobile' => '070-8989-0101',
                'position' => 'CEO',
                'notes' => '元高校教師。教育テクノロジーの先駆者。'
            ],
            [
                'company_id' => 8,
                'user_id' => $userId,
                'first_name' => '由美',
                'last_name' => '林',
                'email' => 'hayashi.yumi@kansai-edu.co.jp',
                'phone' => '06-1234-5679',
                'mobile' => '080-2323-4545',
                'position' => '開発部長',
                'notes' => 'オンライン学習システムの設計を担当。教育工学の専門家。'
            ],

            // 中部物流株式会社
            [
                'company_id' => 9,
                'user_id' => $userId,
                'first_name' => '健',
                'last_name' => '清水',
                'email' => 'shimizu.ken@chubu-logistics.co.jp',
                'phone' => '052-9876-5432',
                'mobile' => '090-3434-5656',
                'position' => '取締役社長',
                'notes' => '物流業界で30年のキャリア。効率化とコスト削減の専門家。'
            ],
            [
                'company_id' => 9,
                'user_id' => $userId,
                'first_name' => '拓也',
                'last_name' => '斎藤',
                'email' => 'saito.takuya@chubu-logistics.co.jp',
                'phone' => '052-9876-5433',
                'mobile' => '080-6767-8989',
                'position' => '運営部長',
                'notes' => '倉庫管理システムの導入と最適化を担当。'
            ],

            // 日本クリエイティブデザイン株式会社
            [
                'company_id' => 10,
                'user_id' => $userId,
                'first_name' => '千尋',
                'last_name' => '橋本',
                'email' => 'hashimoto.chihiro@creative-design.jp',
                'phone' => '03-2345-6789',
                'mobile' => '070-9090-1212',
                'position' => 'クリエイティブディレクター',
                'notes' => 'グラフィックデザインの専門家。多数の受賞歴あり。'
            ],
            [
                'company_id' => 10,
                'user_id' => $userId,
                'first_name' => '翔太',
                'last_name' => '近藤',
                'email' => 'kondo.shota@creative-design.jp',
                'phone' => '03-2345-6780',
                'mobile' => '090-2323-4545',
                'position' => 'UIデザイナー',
                'notes' => 'ユーザーインターフェースとUXデザインのスペシャリスト。'
            ]
        ];

        foreach ($contacts as $contactData) {
            Contact::create($contactData);
        }
    }
}
