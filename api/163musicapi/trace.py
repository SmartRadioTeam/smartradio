#!/usr/bin/env python
# -*- coding: utf-8 -*-
import urllib2
import thread
import redis
import json
def Get163music(music_id):
    resp_cid = urlfetch("http://music.163.com/api/song/detail/?id="+music_id+"&ids=%5B"+music_id+"%5D")
    jsonarr = json.loads(resp_cid)
    result = {}
    result["songurl"]=jsonarr["songs"][0]["mp3Url"]
    for artist in jsonarr["songs"][0]["artists"]:
        if locals().('artists'):
           artists += "/"+artist["name"]
        else:
           artists = artist["name"]
    result["songtitle"] = jsonarr["songs"][0]["name"]." - ".$artists
    result["songcover"] = jsonarr["songs"][0]["album"]["picUrl"]
    return json.dump(result)
def urlfetch(url):
    req_headers = {'Referer':'http://music.163.com/','Cookie':'appver=1.9.2.109452'}
    req = urllib2.Request(url=url, headers=req_headers)
    return urllib2.urlopen(req).read()