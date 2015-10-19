#!/usr/bin/python
#coding=utf-8
import MySQLdb
import time
import sys
conn= MySQLdb.connect(
        host='localhost',
        port = 3306,
        user=sys.argv[1],
        passwd=sys.argv[2],
        db =sys.argv[3],
        )
cur = conn.cursor()
#只删除显示表信息，保留日志表信息
cur.execute("DELETE FROM ticket_view WHERE info <> 0;")
cur.execute("TRUNCATE TABLE timetable")
var=[time.strftime('%Y-%m-%d %X')]
cur.execute("INSERT INTO timetable values (%s);",var)
cur.close()
conn.commit()
conn.close()