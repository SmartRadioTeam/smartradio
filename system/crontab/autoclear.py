#!/usr/bin/python
#coding=utf-8
import MySQLdb
import time
conn= MySQLdb.connect(
        host='localhost',
        port = 3306,
        user='qwe7002',
        passwd='123456',
        db ='qwe7002_smxyradio',
        )
cur = conn.cursor()
cur.execute("DELETE FROM radio WHERE info <> 0;")
cur.execute("TRUNCATE TABLE timetable")
var=[time.strftime('%Y-%m-%d %X')]
cur.execute("INSERT INTO timetable values (%s);",var)
cur.close()
conn.commit()
conn.close()
