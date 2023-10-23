<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            'title' => 'デフォルトの招待メール',
'content' => '<p style="text-align:center;">こんにちは、{candidate_full_name} さん</p><p style="text-align:center;">{interview_name}、{company_name} のポジションにご興味をお持ちいただきありがとうございます。 短い一方通行のビデオインタビューであなたのことをもっと知りたいと思っています。</p><p style="text-align:center;">面接は、カメラとマイクを使用して答える一連の質問で構成されます。 パソコンにアクセスできない場合は、スマートフォンやタブレットを使用して面接を完了することもできます。</p><p style="text-align:center;">使い方：</p><p style="text-align:center;">一方的な面接に慣れていない方のために説明しておくと、これは、事前に作成された質問による単純な面接であり、都合の良いときにビデオ回答を録画することができます。 次の質問に進む前に、各質問に回答する必要があります。</p><p style="text-align:center;">このインタビューを完了すると、電話やビデオ通話よりも早くあなたのことを知ることができ、いつでもどこでも完了できます。</p><p style="text-align:center;">面接を開始する前に、このガイドをお読みください。<br>素晴らしい面接への 5 つの簡単なステップ</p>
<p style="text-align:center;">ありがとう、{interview_owner_name}</p>',
            'type' => "email",
            'trigger' => 'invite',
            'editable' => '0',
            'writer' => '',
            'user_id' => 0,
            'updated_at' => Carbon::now(),
            'created_at' =>Carbon::now(),
        ]);
        DB::table('messages')->insert([
            'title' => 'デフォルトの招待SMS',
            'content' => 'こんにちは、{candidate_first_name} さん。{company_name} との面接に招待されました。 クリックして開始: {link}。 ありがとう、{interview_owner_name}',
            'type' => "sms",
            'trigger' => 'invite',
            'editable' => '0',
            'writer' => '',
            'user_id' => 0,
            'updated_at' => Carbon::now(),
            'created_at' =>Carbon::now(),
        ]);
        DB::table('messages')->insert([
            'title' => 'デフォルトのリマインダメール',
'content' => '<p style="text-align: center">こんにちは、{candidate_full_name} さん</p>
<p style="text-align: center">これは、{company_name} との面接を完了するためのリマインダーです。</p><p style="text-align: center">一方向の面接を開始するには、以下のリンクをクリックしてください。できるだけ早く完了していただければ幸いです。</p><p style="text-align: center">完全に準備が整うまで面接は始まりません。</p><p style="text-align: center">質問があれば何でも構いません。また、これらの面接に関する重要なヒントを確認することをお勧めします。</p><p style="text-align: center">幸運を、</p><p style="text-align: center">{interview_owner_name}</p>',
            'type' => "email",
            'trigger' => 'reminder',
            'editable' => '0',
            'writer' => '',
            'user_id' => 0,
            'updated_at' => Carbon::now(),
            'created_at' =>Carbon::now(),
        ]);
        DB::table('messages')->insert([
            'title' => 'デフォルトのリマインダーSMS',
            'content' => 'こんにちは、{candidate_first_name} さん。{company_name} との面接を忘れないでください。 クリックして開始: {link}。 ありがとう、{interview_owner_name}',
            'type' => "sms",
            'trigger' => 'success',
            'editable' => '0',
            'writer' => '',
            'user_id' => 0,
            'updated_at' => Carbon::now(),
            'created_at' =>Carbon::now(),
        ]);
        DB::table('messages')->insert([
            'title' => 'デフォルトの招待メール',
'content' => '<p style="text-align:center">こんにちは、{candidate_full_name} さん</p><p style="text-align:center">{interview_name}、{company_name} のポジションにご興味をお持ちいただきありがとうございます。 短い一方通行のビデオインタビューであなたのことをもっと知りたいと思っています。</p><p style="text-align:center">面接は、カメラとマイクを使用して答える一連の質問で構成されます。 パソコンにアクセスできない場合は、スマートフォンやタブレットを使用して面接を完了することもできます。</p><p style="text-align:center">使い方：</p><p style="text-align:center">一方的な面接に慣れていない方のために説明しておくと、これは、事前に作成された質問による単純な面接であり、都合の良いときにビデオ回答を録画することができます。 次の質問に進む前に、各質問に回答する必要があります。<br>このインタビューを完了すると、電話やビデオ通話よりも早くあなたのことを知ることができ、いつでもどこでも完了できます。</p><p style="text-align:center">面接を開始する前に、このガイドをお読みください。<br>
素晴らしい面接への 5 つの簡単なステップ</p><p style="text-align:center">ありがとう、{interview_owner_name}</p>',
            'type' => "email",
            'trigger' => 'success',
            'editable' => '0',
            'writer' => '',
            'user_id' => 0,
            'updated_at' => Carbon::now(),
            'created_at' =>Carbon::now(),
        ]);
    }
}
