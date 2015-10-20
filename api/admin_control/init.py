#!/usr/bin/env python
# -*- coding: utf-8 -*-
import web
import login
urls = ('/','index',
        '/login',login.app_client)
app = web.application(urls, globals())
class index:
    def GET(self):
        web.HTTPError('302', {'Location': 'http://smxybbs.net'})
if __name__ == '__main__':
    app.run()