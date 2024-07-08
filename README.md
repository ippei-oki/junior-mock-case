# 勤怠管理システム
メールアドレスとパスワードでログインし、各従業員の勤務時間と休憩時間を管理する

## 作成した目的
勤怠管理の効率化、ペーパーレス化

## アプリケーションURL
https://github.com/ippei-oki/junior-mock-case

## 機能一覧
・会員登録　・ログイン　・ログアウト　・勤務開始　・勤務終了　・休憩開始　・休憩終了
・日付別勤怠情報取得　・ページネーション

## 使用技術（実行環境）
・Laravel 8.83.27　・NGINX 1.21.1　・PHP 8.3.7　・MySQL 8.0.26

## テーブル設計
![image](https://github.com/ippei-oki/junior-mock-case/assets/169340443/cf8e1302-25b9-4779-b810-769dcbb833c0)

## ER図
![image](https://github.com/ippei-oki/junior-mock-case/assets/169340443/b4fc8a7b-12dc-457e-894e-3e4baae671ef)

## 環境構築
**Dockerビルド**
1. `git clone git@github.com/ippei-oki/junior-mock-case.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```
6. マイグレーションの実行
``` bash
php artisan migrate
```
