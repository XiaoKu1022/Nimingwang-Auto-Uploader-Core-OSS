"""
輸入格式
http://127.0.0.1/upload_new_post

Form Return:
  niming            # 投稿內容
  reply_mod         # 回復模式 (人、AI、無)
  reply_for_editor  # 回復模式 (人、AI、無)
  post_time         # 投稿日期
  post_id           # 投稿id

"""

from flask import Flask, request, redirect # web server
from instagrapi import Client # ig auto upload
from instagrapi.exceptions import LoginRequired
from email.mime.multipart import MIMEMultipart # email
from email.mime.text import MIMEText # email
from PIL import ImageFont, ImageDraw, Image # text to img
import google.generativeai as genai # ai
import logging
import smtplib # email
import cv2
import numpy as np
import unicodedata





############# SET #############
test_mod = True
ig_user_name = "{IG 帳號}"
ig_user_password = "{IG 密碼}"
google_gmail_login_key = "{Gmail login Key}"
web_ui_url = "{網頁首頁位置}"
dir = "{程式檔案所在位置}"
###############################



######## Google AI SET ########
genai.configure(api_key="{API Key}") # API
google_gemini_model = "gemini-1.5-pro-latest" # ver: gemini-1.5-pro-latest 、 gemini-pro
generation_config = { # 生成設定
  "temperature": 1,
  "top_p": 0.95,
  "top_k": 0,
  "max_output_tokens": 8192,
}
safety_settings = [ # 安全設定 (過濾選項)
  {
    "category": "HARM_CATEGORY_HARASSMENT",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
  {
    "category": "HARM_CATEGORY_HATE_SPEECH",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
  {
    "category": "HARM_CATEGORY_SEXUALLY_EXPLICIT",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
  {
    "category": "HARM_CATEGORY_DANGEROUS_CONTENT",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
]
###############################




# ---- Login IG ----
logger = logging.getLogger()
if test_mod != True:
  cl = Client()
  try:
    session = cl.load_settings("session.json") # 載入已儲存的cookie
  except: # 無法載入儲存的cookie時
    cl.login(ig_user_name,ig_user_password)
    cl.dump_settings("session.json")

  login_via_session = False
  login_via_pw = False

  if session:
      try:
          cl.set_settings(session)
          cl.login(ig_user_name,ig_user_password)

          # check if session is valid
          try:
              cl.get_timeline_feed()
          except LoginRequired:
              logger.info("Session is invalid, need to login via username and password")

              old_session = cl.get_settings()

              # use the same device uuids across logins
              cl.set_settings({})
              cl.set_uuids(old_session["uuids"])

              cl.login(ig_user_name,ig_user_password)
          login_via_session = True
      except Exception as e:
          logger.info("Couldn't login user using session information: %s" % e)

  if not login_via_session:
      try:
          logger.info("Attempting to login via username and password. username: %s" % ig_user_name)
          if cl.login(ig_user_name,ig_user_password):
              login_via_pw = True
      except Exception as e:
          logger.info("Couldn't login user using username and password: %s" % e)

  if not login_via_pw and not login_via_session:
      raise Exception("Couldn't login user with either password or session")
      exit()
else:
  print("==== 測試模式 ====")
# ---- Login IG END ----



def send_mail(mail_title,mail_to,mail_content): # (郵件標題,郵件收件人,郵件內容)
  content = MIMEMultipart()  #建立MIMEMultipart物件
  content["subject"] = f"{mail_title}"  #郵件標題
  content["from"] = "no-reply@nimingwang.eu.org"  #寄件者
  content["to"] = f"{mail_to}" #收件者
  content.attach(MIMEText(f"{mail_content}"))  #郵件內容
  with smtplib.SMTP(host="smtp.gmail.com", port="587") as smtp:  # 設定SMTP伺服器
      try:
          smtp.ehlo()  # 驗證SMTP伺服器
          smtp.starttls()  # 建立加密傳輸
          smtp.login("nimingwang.service@gmail.com", google_gmail_login_key)  # 登入寄件者gmail
          smtp.send_message(content)  # 寄送郵件
          print("Complete!")
      except Exception as e:
          print("Error message: ", e)


def ig_auto_post(photo_path,photo_caption): # (慾上傳圖片path,圖片說明)
  if test_mod != True:
    cl.photo_upload(path=photo_path, caption=photo_caption)
  else:
    pass


def ai(message): # AI 回復 (匿名訊息), return (AI回覆內容)
  model = genai.GenerativeModel(model_name=google_gemini_model,
                                generation_config=generation_config,
                                safety_settings=safety_settings)
  convo = model.start_chat(history=[])
  convo.send_message(message)
  return str(convo.last.text) 
  


def img_draw(id,time,niming): # 圖片生成 (匿名編號,投稿日期時間,匿名內容) , return (File Name)
  def wrap(text, max_units=40): # 單行最多40個單位長
    def count_units(char):
      width = unicodedata.east_asian_width(char)
      if width in ('F', 'W', 'A'): # 全形佔2單位
          return 2
      elif width in ('Na', 'H'): # 半形佔0.9單位
          return 0.9
      else: # 全形佔2單位
          return 2
    wrapped_text = ''
    current_units = 0
    for char in text: # 逐一確認文字類型
        char_units = count_units(char)
        if current_units + char_units <= max_units: # 當單行空間未滿
            wrapped_text += char
            current_units += char_units 
        else: # 當單行空間不足
            wrapped_text += '\n' + char
            current_units = char_units
    return wrapped_text # 會傳格式化結果
  
  # 載入背景圖
  pattern = cv2.imread(f'{dir}background_pattern.jpg')  
  pattern = cv2.resize(pattern, (1200, 1200))  # 設定解析度

  # Create a PIL image with the background pattern
  imgPil = Image.fromarray(pattern)

  # 載入字體
  fontpath = f'{dir}GenJyuuGothicX-Bold.otf'
  font = ImageFont.truetype(fontpath, 50)

  # 繪製文字在畫布上
  draw = ImageDraw.Draw(imgPil)
  draw.text((100, 100) ,wrap(niming), fill=(255, 255, 255), font=font)  # 繪製匿名訊息
  draw.text((230, 1105) ,f"{time}", fill=(27, 27, 30), font=font)  # 繪製投稿時間
  draw.text(((1200 - 29.166*len(str(id))-30), 1105), f"{id}" ,fill=(27, 27, 30), font=font)  # 繪製匿名編號
  # Convert PIL image back to numpy array for display
  img = np.array(imgPil)

  #cv2.imshow('oxxostudio', img) # 預覽結果
  cv2.waitKey(0)
  # cv2.destroyAllWindows()  # Uncomment if needed
  cv2.imwrite(f'{dir}output.jpg', img) # 儲存結果
  return f'{dir}output.jpg'




# ---- Flask HTTP Server ----

app = Flask(__name__)

@app.route('/upload_new_post', methods=['POST']) # 新投稿處理
def index():
  niming = request.form['niming'] # 投稿內容
  reply_mod = request.form['reply_mod'] # 回復模式 (人、AI、無)
  reply_for_editor = request.form['reply_for_editor'] # 回復模式 (人、AI、無)
  post_time = request.form['post_time'] # 投稿日期
  post_id = request.form['post_id'] # 投稿id
  review_content =f"""
{open(f'{dir}rules.txt', 'r')},請判斷以下投稿內容是否符合使用規範(只能回答 y/n)
=================投稿內容=================
{niming}
===============投稿內容結束===============
  """

  try:
    if ai(review_content) == "y" or "Y" or "yes" or "Yes":
      img = img_draw(f"#{post_id}",post_time,niming.replace('\r\n', '\n')) # 圖檔生成

      if reply_mod == "ai": # 投稿者選擇AI回復
        reply = ai(f"〔{niming}〕請給予這則匿名有趣的回復，立場必須中立")
        
      elif reply_mod == "na": # 投稿者選擇沒有回復
        reply = ""
      
      elif reply_mod == "editor": # 投稿者選擇小編回復
        reply = reply_for_editor.replace('\r\n', '\n')
      
      else: # 錯誤的格式
        return redirect(web_ui_url)
      

      ig_auto_post(img,reply) # 上傳
      return redirect(web_ui_url) # 返回 Home Page


  except Exception as e:
    print(e)
    return f'<h1>Failed！<br><a href="{web_ui_url}">Back To Home Page...</a><h1>' # 出錯

@app.route('/send_mail', methods=['POST']) # 郵件寄送處理
def mail():
  mail_title = request.form['mail_title'] # 投稿內容
  mail_to = request.form['mail_to'] # 回復模式 (人、AI、無)
  mail_content = request.form['mail_content'] # 回復模式 (人、AI、無)
  send_mail(mail_title,mail_to,mail_content)
  return "OK"


if __name__ == '__main__':
  app.run(host="0.0.0.0", port=5000)

# ---- Flask HTTP Server END ----
