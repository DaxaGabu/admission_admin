import requests
from bs4 import BeautifulSoup
import mysql.connector
import json
from datetime import datetime

conn = mysql.connector.connect(host="localhost", user="root", password="", database="db")
cursor = conn.cursor()

with open("universities.json", "r") as file:
    universities = json.load(file)

for uni in universities:
    print(f"Scraping {uni['name']} - {uni['state']}")
    try:
        res = requests.get(uni['url'], timeout=10)
        soup = BeautifulSoup(res.text, "html.parser")

        for item in soup.select(".news_item"):  # Change based on actual site
            title = item.find("h4").text.strip()
            description = item.find("p").text.strip()
            link = item.find("a")["href"]
            deadline = datetime.now().strftime("%Y-%m-%d")

            cursor.execute("""
                INSERT INTO announcements (title, description, course, deadline, apply_link, state, university)
                VALUES (%s, %s, %s, %s, %s, %s, %s)
            """, (title, description, 'UG/PG', deadline, link, uni['state'], uni['name']))
            conn.commit()

    except Exception as e:
        print(f"Error scraping {uni['name']}: {e}")

cursor.close()
conn.close()