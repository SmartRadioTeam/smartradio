#!/usr/bin/env python
# -*- coding: utf-8 -*-
import urllib2
import zlib
import web
import thread
def Get163music(music_id):
    resp_cid = urlfetch("http://music.163.com/api/song/detail/?id="+music_id+"&ids=%5B"+music_id+"%5D")
    return resp_cid
def urlfetch(url):
    req_headers = {'Referer':'http://music.163.com/','Cookie':'appver=1.9.2.109452'}
    req = urllib2.Request(url=url, headers=req_headers)
    return urllib2.urlopen(req).read()

urlgrub = ("/","index",'/getmusic','getmusic')
app = web.application(urlgrub, globals())
web.config.debug = False
application = app.wsgifunc()
class index:
    def GET(self):
        return "server is run"
class getmusic:
    def GET(self):
        return "server is run"
    def POST(self):
        return Get163music(web.input().musicid)
if __name__ == '__main__':
    app.run()