# InvoiceCheck 發票對獎系統
## 基本資訊&使用說明
````
預設網址為：http://127.0.0.1/invoice/index.php/Homepage/index

此專案沒有使用到資料庫，是使用財政部的API
如果有設定host，請修改app->config->config.php->$config['base_url']為你的網址，最後面記得帶有"/"符號
修改過後網址會變成http://XXXXX/index.php/Homepage/index
由於每個人的架構不同，所以沒有寫htaccess去隱藏網址裡的index.php
因此如果沒有修改過的話，index.php為網址裡必填的項目
此專案是用codeigniter3開發，前後端的收發大部分採用AJAX完成
````
