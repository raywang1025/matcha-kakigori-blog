# 抹茶刨冰部落格 (Matcha Kakigori Blog)

這是一個專門介紹日本抹茶刨冰的 WordPress 部落格網站。

## 功能特點

- 多語言支援（日文、中文、英文）
- 店家資訊分類系統
- 詳細的抹茶刨冰評價
- 響應式設計
- 整合 Google 翻譯功能

## 技術架構

- WordPress CMS
- 自定義主題
- 多語言插件
- SEO 優化
- 響應式設計

## 安裝說明

1. 下載並安裝 WordPress
2. 克隆此倉庫到 `wp-content/themes/` 目錄：
   ```bash
   cd wp-content/themes/
   git clone https://github.com/raywang1025/matcha-kakigori-blog.git
   ```
3. 在 WordPress 後台啟用主題
4. 安裝並啟用必要插件
5. 配置主題設置

## 必要插件

- WPML（多語言支援）
- Yoast SEO（搜索引擎優化）
- Advanced Custom Fields（自定義欄位）
- WP Super Cache（快取優化）

## 開發指南

1. Fork 此倉庫
2. 創建您的功能分支：`git checkout -b feature/AmazingFeature`
3. 提交您的更改：`git commit -m '添加一些很棒的功能'`
4. 推送到分支：`git push origin feature/AmazingFeature`
5. 開啟一個 Pull Request

## 貢獻指南

歡迎提交 Pull Request 來改進網站功能和內容。請確保您的代碼符合 WordPress 編碼標準。

## 部署說明

### 使用 Heroku 免費部署
1. 註冊 Heroku 帳戶：https://signup.heroku.com/
2. 安裝 Heroku CLI
3. 在專案根目錄執行：
   ```bash
   heroku create matcha-kakigori-blog
   git push heroku main
   ```
4. 設定環境變數：
   ```bash
   heroku config:set WP_ENV=production
   ```
5. 設定資料庫：
   ```bash
   heroku addons:create jawsdb:kitefin
   ```

### 使用 000webhost 免費部署
1. 註冊 000webhost 帳戶：https://www.000webhost.com/
2. 創建新網站
3. 使用檔案管理器上傳 WordPress 檔案
4. 創建資料庫並配置 wp-config.php
5. 完成安裝步驟

注意事項：
- 免費方案可能有流量和存儲限制
- 建議定期備份資料
- 可能會有短暫的停機維護時間
- 網址將會是 yoursite.000webhostapp.com 格式

## 授權

MIT License

Copyright (c) 2024 Ray Wang

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE. 