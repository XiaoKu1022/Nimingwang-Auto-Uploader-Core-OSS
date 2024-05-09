# Nimingwang-Auto-Uploader-Core-OSS
Open Source Software Ver


過去方法：

(一) 上傳投稿內容：

訪客投稿 -> 上傳至第三方網站
小編輸入回覆 -> 截圖並儲存
小編登入Instagram並上傳匿名截圖
(二) 確認使用者身分，再同意Instagram追蹤請求：

使用者按下 追蹤請求
小編收到使用者的 追蹤請求 -> 查看他是否為 OO學校學生
同意追蹤請求
自動化方案目標：

(一) 上傳投稿內容：

訪客投稿 -> 上傳至後端伺服器 及 SQL伺服器
後端伺服器收到請求 -> AI審核投稿內容是否違反使用條款 (if 違反 -> 刪除該投稿)
按使用者要求回覆內容 ( 回覆方式 = {AI回覆、小編回覆、無回覆} ) 。AI回覆 -> 使用AI生成回覆 。小編回覆 -> 儲存至SQL伺服器 -> 等待小編回覆 。無回覆 -> 直接上傳
後端伺服器處理 -> 文字生成圖檔 -> 儲存
上傳至Instagram
(二) 確認使用者身分，再同意Instagram追蹤請求：

使用者登入Google帳戶
前端檢查Email格式是否為 oooooooo@ooo.tp.edu.tw ( if false -> exit)
使用者輸入Instagram用戶ID
後端SQL新增此ID為白名單 (if ig收到最終請求 and ig-user-id 在 白名單 -> 去認追蹤請求)
