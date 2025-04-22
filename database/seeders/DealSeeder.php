<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 会社、担当者、ユーザーデータを取得
        $companies = Company::all();
        $contacts = Contact::all();
        $users = User::all();

        if ($companies->isEmpty()) {
            $this->command->info('会社データが存在しません。先にCompanySeederを実行してください。');
            return;
        }

        if ($contacts->isEmpty()) {
            $this->command->info('担当者データが存在しません。先にContactSeederを実行してください。');
            return;
        }

        if ($users->isEmpty()) {
            $this->command->info('ユーザーデータが存在しません。先にUserSeederを実行してください。');
            return;
        }

        // 管理者ユーザーを取得（存在しない場合は最初のユーザー）
        $adminUser = $users->firstWhere('role', 'admin') ?? $users->first();

        $deals = [
            // 株式会社テクノソリューション
            [
                'company_id' => 1,
                'user_id' => $adminUser->id,
                'contact_id' => 1, // 鈴木太郎
                'title' => 'クラウドAIソリューション導入案件',
                'amount' => 5000000,
                'status' => 'proposal',
                'expected_closing_date' => now()->addDays(30),
                'probability' => 70,
                'description' => '顧客の業務効率化のためのAIを活用したクラウドソリューションの提案。',
                'notes' => '競合他社も提案中。価格と導入スピードが決め手になる可能性が高い。'
            ],
            [
                'company_id' => 1,
                'user_id' => $adminUser->id,
                'contact_id' => 2, // 佐藤花子
                'title' => '保守契約更新',
                'amount' => 1200000,
                'status' => 'closed_won',
                'expected_closing_date' => now()->subDays(15),
                'probability' => 100,
                'description' => '既存システムの年間保守契約の更新。',
                'notes' => '前年比10%アップで契約更新に成功。追加サポートオプションも採用された。'
            ],

            // 株式会社日本商事
            [
                'company_id' => 2,
                'user_id' => $adminUser->id,
                'contact_id' => 3, // 田中一郎
                'title' => '中国向け輸出拡大プロジェクト',
                'amount' => 20000000,
                'status' => 'negotiation',
                'expected_closing_date' => now()->addDays(60),
                'probability' => 60,
                'description' => '半導体部品の中国市場向け輸出拡大のためのパートナーシップ構築。',
                'notes' => '現地代理店との条件交渉中。関税の問題で調整が必要。'
            ],
            [
                'company_id' => 2,
                'user_id' => $adminUser->id,
                'contact_id' => 4, // 山田次郎
                'title' => '新規取引先開拓',
                'amount' => 3000000,
                'status' => 'needs_analysis',
                'expected_closing_date' => now()->addDays(90),
                'probability' => 30,
                'description' => '国内電機メーカーとの新規取引開始に向けた提案。',
                'notes' => '先方の調達部門と初回ミーティングを実施。要件のヒアリング段階。'
            ],

            // 株式会社グローバルトレード
            [
                'company_id' => 3,
                'user_id' => $adminUser->id,
                'contact_id' => 5, // 伊藤三郎
                'title' => 'ベトナム進出支援コンサルティング',
                'amount' => 8500000,
                'status' => 'closed_won',
                'expected_closing_date' => now()->subDays(30),
                'probability' => 100,
                'description' => 'ベトナム市場への進出を検討している企業向けのコンサルティングサービス。',
                'notes' => '3年契約で合意。現地視察ツアーも含めたパッケージで提供。'
            ],
            [
                'company_id' => 3,
                'user_id' => $adminUser->id,
                'contact_id' => 6, // 高橋恵子
                'title' => 'アジア市場調査レポート販売',
                'amount' => 1500000,
                'status' => 'qualification',
                'expected_closing_date' => now()->addDays(45),
                'probability' => 50,
                'description' => '東南アジア市場の最新動向に関する調査レポートの販売。',
                'notes' => 'サンプルレポートを提供済み。経営企画部での検討中。'
            ],

            // 株式会社フードデリバリー
            [
                'company_id' => 4,
                'user_id' => $adminUser->id,
                'contact_id' => 7, // 渡辺健太
                'title' => 'デリバリーシステム刷新プロジェクト',
                'amount' => 15000000,
                'status' => 'proposal',
                'expected_closing_date' => now()->addDays(60),
                'probability' => 75,
                'description' => '既存のデリバリー管理システムの刷新と機能拡張。',
                'notes' => 'モバイルアプリの開発も含めた包括的な提案を実施。技術的な詳細を詰めている段階。'
            ],
            [
                'company_id' => 4,
                'user_id' => $adminUser->id,
                'contact_id' => 8, // 加藤美咲
                'title' => '飲食店向けPOSシステム導入',
                'amount' => 2800000,
                'status' => 'closed_lost',
                'expected_closing_date' => now()->subDays(10),
                'probability' => 0,
                'description' => '提携飲食店向けのPOSシステム導入プロジェクト。',
                'notes' => '競合他社の提案が採用された。価格面での競争力が課題。'
            ],

            // 北海道自然エネルギー株式会社
            [
                'company_id' => 5,
                'user_id' => $adminUser->id,
                'contact_id' => 9, // 吉田大輔
                'title' => '風力発電所新設プロジェクト',
                'amount' => 50000000,
                'status' => 'negotiation',
                'expected_closing_date' => now()->addDays(120),
                'probability' => 80,
                'description' => '北海道東部での新規風力発電所建設に関するコンサルティングと設備導入。',
                'notes' => '環境アセスメントが完了し、地元自治体との協議も進展中。資金調達面での最終調整段階。'
            ],
            [
                'company_id' => 5,
                'user_id' => $adminUser->id,
                'contact_id' => 10, // 山本直子
                'title' => '太陽光パネルメンテナンス契約',
                'amount' => 3600000,
                'status' => 'closed_won',
                'expected_closing_date' => now()->subDays(5),
                'probability' => 100,
                'description' => '既存の太陽光発電設備の年間メンテナンス契約。',
                'notes' => '3年間の長期契約として締結。定期点検に加えて緊急対応サービスも含む。'
            ],

            // 九州メディカルケア株式会社
            [
                'company_id' => 6,
                'user_id' => $adminUser->id,
                'contact_id' => 11, // 中村隆
                'title' => '医療機器開発パートナーシップ',
                'amount' => 30000000,
                'status' => 'needs_analysis',
                'expected_closing_date' => now()->addDays(180),
                'probability' => 40,
                'description' => '新型医療機器の共同開発に関する提携。',
                'notes' => '技術的な実現可能性の検証段階。特許出願の準備も並行して進めている。'
            ],
            [
                'company_id' => 6,
                'user_id' => $adminUser->id,
                'contact_id' => 12, // 小林裕子
                'title' => '介護施設向けシステム導入',
                'amount' => 7500000,
                'status' => 'proposal',
                'expected_closing_date' => now()->addDays(45),
                'probability' => 65,
                'description' => '介護記録管理と施設運営効率化のためのシステム導入。',
                'notes' => 'デモンストレーションを実施済み。導入コストと運用体制について協議中。'
            ],

            // 東京建設工業株式会社
            [
                'company_id' => 7,
                'user_id' => $adminUser->id,
                'contact_id' => 13, // 松本浩二
                'title' => '商業施設設計プロジェクト',
                'amount' => 25000000,
                'status' => 'closed_won',
                'expected_closing_date' => now()->subDays(20),
                'probability' => 100,
                'description' => '都内新規商業施設の設計および施工監理。',
                'notes' => '環境配慮型設計として注目されるプロジェクト。今後の類似案件獲得にも重要。'
            ],
            [
                'company_id' => 7,
                'user_id' => $adminUser->id,
                'contact_id' => 14, // 井上真理子
                'title' => '社員研修プログラム開発',
                'amount' => 4200000,
                'status' => 'qualification',
                'expected_closing_date' => now()->addDays(60),
                'probability' => 55,
                'description' => '若手技術者向けの専門研修プログラムの開発と実施。',
                'notes' => '人材育成部門との初回ミーティングを完了。具体的なカリキュラム内容を検討中。'
            ],

            // 関西教育システム株式会社
            [
                'company_id' => 8,
                'user_id' => $adminUser->id,
                'contact_id' => 15, // 木村誠
                'title' => 'オンライン学習プラットフォーム拡張',
                'amount' => 18000000,
                'status' => 'negotiation',
                'expected_closing_date' => now()->addDays(30),
                'probability' => 85,
                'description' => '既存のオンライン学習システムへのAI機能追加と拡張開発。',
                'notes' => '技術仕様は合意済み。契約条件と開発スケジュールの最終調整中。'
            ],
            [
                'company_id' => 8,
                'user_id' => $adminUser->id,
                'contact_id' => 16, // 林由美
                'title' => '教育コンテンツ制作委託',
                'amount' => 6500000,
                'status' => 'prospecting',
                'expected_closing_date' => now()->addDays(90),
                'probability' => 20,
                'description' => '高校向け理系科目の教育コンテンツ制作プロジェクト。',
                'notes' => '初期提案段階。競合他社も複数参入している状況。'
            ],

            // 中部物流株式会社
            [
                'company_id' => 9,
                'user_id' => $adminUser->id,
                'contact_id' => 17, // 清水健
                'title' => '物流倉庫自動化システム導入',
                'amount' => 35000000,
                'status' => 'proposal',
                'expected_closing_date' => now()->addDays(75),
                'probability' => 60,
                'description' => '最新の自動化技術を活用した物流倉庫のシステム刷新。',
                'notes' => '現地調査と要件定義を完了。投資対効果の検証段階。'
            ],
            [
                'company_id' => 9,
                'user_id' => $adminUser->id,
                'contact_id' => 18, // 斎藤拓也
                'title' => '配送ルート最適化コンサルティング',
                'amount' => 4800000,
                'status' => 'closed_won',
                'expected_closing_date' => now()->subDays(15),
                'probability' => 100,
                'description' => '配送ルートと積載効率の最適化によるコスト削減コンサルティング。',
                'notes' => '初期分析で15%のコスト削減効果を実証。本格導入のフェーズに移行。'
            ],

            // 日本クリエイティブデザイン株式会社
            [
                'company_id' => 10,
                'user_id' => $adminUser->id,
                'contact_id' => 19, // 橋本千尋
                'title' => 'コーポレートブランディング刷新',
                'amount' => 12000000,
                'status' => 'closed_lost',
                'expected_closing_date' => now()->subDays(30),
                'probability' => 0,
                'description' => '企業イメージの刷新とブランディング戦略の再構築。',
                'notes' => '予算削減により計画が中止。将来的な再開の可能性あり。'
            ],
            [
                'company_id' => 10,
                'user_id' => $adminUser->id,
                'contact_id' => 20, // 近藤翔太
                'title' => 'ECサイトUIデザインリニューアル',
                'amount' => 5500000,
                'status' => 'negotiation',
                'expected_closing_date' => now()->addDays(20),
                'probability' => 90,
                'description' => 'オンラインショップのユーザーインターフェース刷新プロジェクト。',
                'notes' => 'デザイン案は承認済み。実装スケジュールと追加要件について最終調整中。'
            ]
        ];

        foreach ($deals as $dealData) {
            Deal::create($dealData);
        }
    }
}
