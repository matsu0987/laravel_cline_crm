<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 会社、担当者、商談、ユーザーデータを取得
        $companies = Company::all();
        $contacts = Contact::all();
        $deals = Deal::all();
        $users = User::all();

        if ($companies->isEmpty()) {
            $this->command->info('会社データが存在しません。先にCompanySeederを実行してください。');
            return;
        }

        if ($contacts->isEmpty()) {
            $this->command->info('担当者データが存在しません。先にContactSeederを実行してください。');
            return;
        }

        if ($deals->isEmpty()) {
            $this->command->info('商談データが存在しません。先にDealSeederを実行してください。');
            return;
        }

        if ($users->isEmpty()) {
            $this->command->info('ユーザーデータが存在しません。先にUserSeederを実行してください。');
            return;
        }

        // 管理者ユーザーを取得（存在しない場合は最初のユーザー）
        $adminUser = $users->firstWhere('role', 'admin') ?? $users->first();

        $activities = [
            // 株式会社テクノソリューション - クラウドAIソリューション導入案件
            [
                'user_id' => $adminUser->id,
                'company_id' => 1,
                'contact_id' => 1,
                'deal_id' => 1,
                'type' => 'meeting',
                'title' => '初回提案ミーティング',
                'description' => 'クラウドAIソリューションの初回提案を実施。顧客のニーズと課題をヒアリングし、ソリューションの概要を説明した。',
                'scheduled_at' => now()->subDays(20),
                'completed_at' => now()->subDays(20),
                'status' => 'completed',
                'outcome' => '顧客は興味を示し、詳細な提案書の提出を依頼された。競合他社も提案中とのこと。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 1,
                'contact_id' => 1,
                'deal_id' => 1,
                'type' => 'email',
                'title' => '提案書送付',
                'description' => '詳細な提案書と見積もりを作成し、メールで送付。',
                'scheduled_at' => now()->subDays(15),
                'completed_at' => now()->subDays(15),
                'status' => 'completed',
                'outcome' => '提案書を送付し、確認の返信あり。検討するとのこと。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 1,
                'contact_id' => 1,
                'deal_id' => 1,
                'type' => 'call',
                'title' => 'フォローアップ電話',
                'description' => '提案書送付後のフォローアップ。質問事項の確認と次のステップについて協議。',
                'scheduled_at' => now()->subDays(10),
                'completed_at' => now()->subDays(10),
                'status' => 'completed',
                'outcome' => '技術的な質問に回答。デモンストレーションの実施を依頼された。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 1,
                'contact_id' => 1,
                'deal_id' => 1,
                'type' => 'meeting',
                'title' => 'デモンストレーション',
                'description' => 'クラウドAIソリューションのデモンストレーションを実施。実際の使用シナリオに基づいた機能紹介。',
                'scheduled_at' => now()->addDays(5),
                'completed_at' => null,
                'status' => 'scheduled',
                'outcome' => null
            ],

            // 株式会社日本商事 - 中国向け輸出拡大プロジェクト
            [
                'user_id' => $adminUser->id,
                'company_id' => 2,
                'contact_id' => 3,
                'deal_id' => 3,
                'type' => 'meeting',
                'title' => '戦略会議',
                'description' => '中国市場向け輸出拡大戦略についての会議。市場分析と現地パートナー候補の検討。',
                'scheduled_at' => now()->subDays(45),
                'completed_at' => now()->subDays(45),
                'status' => 'completed',
                'outcome' => '主要な市場セグメントと潜在的なパートナー5社をリストアップ。次のステップとして現地代理店との面談を設定。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 2,
                'contact_id' => 3,
                'deal_id' => 3,
                'type' => 'meeting',
                'title' => '現地代理店とのミーティング',
                'description' => '上海の代理店候補との初回ミーティング。パートナーシップの可能性と条件について協議。',
                'scheduled_at' => now()->subDays(30),
                'completed_at' => now()->subDays(30),
                'status' => 'completed',
                'outcome' => '代理店の販売ネットワークと実績を確認。基本的な条件面で合意できる見込み。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 2,
                'contact_id' => 3,
                'deal_id' => 3,
                'type' => 'task',
                'title' => '契約書ドラフト作成',
                'description' => '中国代理店との契約書ドラフトを作成。法務部と連携して条件を整理。',
                'scheduled_at' => now()->subDays(15),
                'completed_at' => now()->subDays(12),
                'status' => 'completed',
                'outcome' => '契約書ドラフトを完成させ、社内承認を取得。代理店側に送付済み。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 2,
                'contact_id' => 3,
                'deal_id' => 3,
                'type' => 'call',
                'title' => '契約条件の最終調整',
                'description' => '代理店との電話会議。契約条件の最終調整と合意形成。',
                'scheduled_at' => now()->addDays(3),
                'completed_at' => null,
                'status' => 'scheduled',
                'outcome' => null
            ],

            // 株式会社フードデリバリー - デリバリーシステム刷新プロジェクト
            [
                'user_id' => $adminUser->id,
                'company_id' => 4,
                'contact_id' => 7,
                'deal_id' => 7,
                'type' => 'meeting',
                'title' => '要件定義ワークショップ',
                'description' => 'デリバリーシステム刷新に向けた要件定義ワークショップ。現状の課題と改善ポイントの洗い出し。',
                'scheduled_at' => now()->subDays(25),
                'completed_at' => now()->subDays(25),
                'status' => 'completed',
                'outcome' => '主要な機能要件と非機能要件をドキュメント化。モバイルアプリとの連携が最重要課題として特定された。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 4,
                'contact_id' => 7,
                'deal_id' => 7,
                'type' => 'task',
                'title' => 'システム設計書作成',
                'description' => '要件に基づいたシステム設計書の作成。アーキテクチャと主要コンポーネントの定義。',
                'scheduled_at' => now()->subDays(18),
                'completed_at' => now()->subDays(16),
                'status' => 'completed',
                'outcome' => 'システム設計書を完成。クラウドベースのマイクロサービスアーキテクチャを採用することで合意。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 4,
                'contact_id' => 7,
                'deal_id' => 7,
                'type' => 'meeting',
                'title' => '技術検証ミーティング',
                'description' => '提案システムの技術的な検証と実現可能性の確認。開発チームとの協議。',
                'scheduled_at' => now()->subDays(10),
                'completed_at' => now()->subDays(10),
                'status' => 'completed',
                'outcome' => '技術的な課題点を特定し、解決策を提示。開発スケジュールの初期案を作成。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 4,
                'contact_id' => 8,
                'deal_id' => 7,
                'type' => 'meeting',
                'title' => '見積もり提示',
                'description' => 'システム開発の見積もりと導入スケジュールの提示。コスト面での協議。',
                'scheduled_at' => now()->subDays(5),
                'completed_at' => now()->subDays(5),
                'status' => 'completed',
                'outcome' => '見積もりを提示し、基本的な合意を得た。一部機能の優先順位付けについて再検討の要請あり。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 4,
                'contact_id' => 7,
                'deal_id' => 7,
                'type' => 'task',
                'title' => '提案書の修正',
                'description' => '顧客フィードバックに基づく提案書の修正。機能の優先順位付けとフェーズ分けの見直し。',
                'scheduled_at' => now()->addDays(2),
                'completed_at' => null,
                'status' => 'scheduled',
                'outcome' => null
            ],

            // 北海道自然エネルギー株式会社 - 風力発電所新設プロジェクト
            [
                'user_id' => $adminUser->id,
                'company_id' => 5,
                'contact_id' => 9,
                'deal_id' => 9,
                'type' => 'meeting',
                'title' => '現地調査',
                'description' => '風力発電所建設予定地の現地調査。地形や風況の確認、周辺環境の評価。',
                'scheduled_at' => now()->subDays(60),
                'completed_at' => now()->subDays(60),
                'status' => 'completed',
                'outcome' => '建設予定地の適性を確認。風況データの収集を開始し、初期的な発電量予測を実施。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 5,
                'contact_id' => 9,
                'deal_id' => 9,
                'type' => 'meeting',
                'title' => '地元自治体との協議',
                'description' => '地元自治体との協議。プロジェクト概要の説明と協力関係の構築。',
                'scheduled_at' => now()->subDays(45),
                'completed_at' => now()->subDays(45),
                'status' => 'completed',
                'outcome' => '自治体からの基本的な理解と支持を得た。地域住民への説明会の開催が提案された。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 5,
                'contact_id' => 9,
                'deal_id' => 9,
                'type' => 'meeting',
                'title' => '住民説明会',
                'description' => '地域住民向けの説明会。プロジェクトの概要と環境への配慮について説明。',
                'scheduled_at' => now()->subDays(30),
                'completed_at' => now()->subDays(30),
                'status' => 'completed',
                'outcome' => '住民からの質問に回答し、概ね好意的な反応を得た。一部懸念事項については追加調査を約束。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 5,
                'contact_id' => 10,
                'deal_id' => 9,
                'type' => 'task',
                'title' => '資金調達計画の策定',
                'description' => 'プロジェクトの資金調達計画の策定。金融機関との協議と条件の検討。',
                'scheduled_at' => now()->subDays(20),
                'completed_at' => now()->subDays(18),
                'status' => 'completed',
                'outcome' => '複数の金融機関から融資の内諾を得た。最終的な条件交渉の段階に移行。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 5,
                'contact_id' => 10,
                'deal_id' => 9,
                'type' => 'meeting',
                'title' => '金融機関との最終協議',
                'description' => '主要金融機関との最終協議。融資条件の確定と契約内容の詰め。',
                'scheduled_at' => now()->addDays(10),
                'completed_at' => null,
                'status' => 'scheduled',
                'outcome' => null
            ],

            // 関西教育システム株式会社 - オンライン学習プラットフォーム拡張
            [
                'user_id' => $adminUser->id,
                'company_id' => 8,
                'contact_id' => 15,
                'deal_id' => 15,
                'type' => 'meeting',
                'title' => '機能要件ヒアリング',
                'description' => 'オンライン学習プラットフォームの拡張に関する機能要件のヒアリング。AI機能の詳細検討。',
                'scheduled_at' => now()->subDays(40),
                'completed_at' => now()->subDays(40),
                'status' => 'completed',
                'outcome' => '学習進捗分析、個別最適化学習パス生成、自動採点機能などの要件を特定。優先順位付けを実施。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 8,
                'contact_id' => 16,
                'deal_id' => 15,
                'type' => 'task',
                'title' => 'プロトタイプ開発',
                'description' => 'AI機能のプロトタイプ開発。主要機能の実現可能性検証と効果測定。',
                'scheduled_at' => now()->subDays(30),
                'completed_at' => now()->subDays(28),
                'status' => 'completed',
                'outcome' => 'プロトタイプを完成させ、内部テストを実施。基本機能の動作を確認。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 8,
                'contact_id' => 15,
                'deal_id' => 15,
                'type' => 'meeting',
                'title' => 'プロトタイプデモ',
                'description' => '開発したプロトタイプのデモンストレーション。機能の有効性と改善点の協議。',
                'scheduled_at' => now()->subDays(20),
                'completed_at' => now()->subDays(20),
                'status' => 'completed',
                'outcome' => 'デモに対して好評価を得た。いくつかの改善提案があり、開発計画に反映することで合意。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 8,
                'contact_id' => 15,
                'deal_id' => 15,
                'type' => 'task',
                'title' => '開発計画と見積もり作成',
                'description' => '本格開発に向けた計画と見積もりの作成。スケジュールとリソース配分の検討。',
                'scheduled_at' => now()->subDays(15),
                'completed_at' => now()->subDays(13),
                'status' => 'completed',
                'outcome' => '開発計画と見積もりを完成。フェーズ分けによる段階的な開発アプローチを提案。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 8,
                'contact_id' => 15,
                'deal_id' => 15,
                'type' => 'meeting',
                'title' => '契約条件協議',
                'description' => '開発契約の条件協議。スコープ、スケジュール、コスト、保守体制などの詳細決定。',
                'scheduled_at' => now()->subDays(5),
                'completed_at' => now()->subDays(5),
                'status' => 'completed',
                'outcome' => '主要な契約条件で合意。法務部門による最終確認を経て契約締結の見込み。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 8,
                'contact_id' => 15,
                'deal_id' => 15,
                'type' => 'task',
                'title' => '契約書最終確認',
                'description' => '契約書の最終確認と調整。法務部門との連携による契約内容の精査。',
                'scheduled_at' => now()->addDays(3),
                'completed_at' => null,
                'status' => 'scheduled',
                'outcome' => null
            ],

            // 日本クリエイティブデザイン株式会社 - ECサイトUIデザインリニューアル
            [
                'user_id' => $adminUser->id,
                'company_id' => 10,
                'contact_id' => 20,
                'deal_id' => 20,
                'type' => 'meeting',
                'title' => 'デザイン要件ヒアリング',
                'description' => 'ECサイトのUIデザインリニューアルに関する要件ヒアリング。現状の課題と改善目標の確認。',
                'scheduled_at' => now()->subDays(35),
                'completed_at' => now()->subDays(35),
                'status' => 'completed',
                'outcome' => 'ユーザビリティ向上、モバイル対応強化、ブランドイメージ一貫性の確保などの要件を特定。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 10,
                'contact_id' => 19,
                'deal_id' => 20,
                'type' => 'task',
                'title' => 'ユーザー調査',
                'description' => '現行ECサイトのユーザー調査。利用状況の分析とペインポイントの特定。',
                'scheduled_at' => now()->subDays(30),
                'completed_at' => now()->subDays(28),
                'status' => 'completed',
                'outcome' => 'ユーザー調査レポートを作成。主要な改善ポイントとして、商品検索機能、チェックアウトプロセス、商品詳細表示を特定。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 10,
                'contact_id' => 20,
                'deal_id' => 20,
                'type' => 'task',
                'title' => 'デザインコンセプト作成',
                'description' => '新UIのデザインコンセプト作成。ビジュアルデザインの方向性とユーザー体験の設計。',
                'scheduled_at' => now()->subDays(20),
                'completed_at' => now()->subDays(18),
                'status' => 'completed',
                'outcome' => '3つのデザインコンセプト案を作成。モダンでクリーンな印象を重視したミニマルデザインが好評。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 10,
                'contact_id' => 20,
                'deal_id' => 20,
                'type' => 'meeting',
                'title' => 'デザイン案プレゼンテーション',
                'description' => 'デザインコンセプトと主要画面のモックアッププレゼンテーション。',
                'scheduled_at' => now()->subDays(15),
                'completed_at' => now()->subDays(15),
                'status' => 'completed',
                'outcome' => 'デザイン案が承認された。いくつかの細部調整の要望があり、修正作業を進めることになった。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 10,
                'contact_id' => 20,
                'deal_id' => 20,
                'type' => 'task',
                'title' => 'デザイン詳細化',
                'description' => '承認されたコンセプトに基づく詳細デザインの作成。全画面のデザインと仕様書の作成。',
                'scheduled_at' => now()->subDays(10),
                'completed_at' => now()->subDays(8),
                'status' => 'completed',
                'outcome' => '全画面のデザインと仕様書を完成。デザインシステムとコンポーネントライブラリも整備。'
            ],
            [
                'user_id' => $adminUser->id,
                'company_id' => 10,
                'contact_id' => 20,
                'deal_id' => 20,
                'type' => 'meeting',
                'title' => '実装計画協議',
                'description' => 'デザイン実装に向けた計画協議。開発チームとの連携方法とスケジュールの確認。',
                'scheduled_at' => now()->addDays(5),
                'completed_at' => null,
                'status' => 'scheduled',
                'outcome' => null
            ]
        ];

        foreach ($activities as $activityData) {
            Activity::create($activityData);
        }
    }
}
