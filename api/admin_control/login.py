import web
import hashlib
class login:
	def POST(self):
		if 'user' in web.input() and 'passwd' in web.input():
			db=web.database(dbn='mysql', user='reallct', pw='frDzMxENYnHn9B5w', db='reallct_OA')
			user=web.input().user
			passwd=web.input().passwd
			passwdencode = hashlib.md5()   
			passwdencode.update(passwd)   
			passwd=passwdencode.hexdigest()
			result = db.query("SELECT * FROM `user` WHERE `user`=$user", vars={"user":user})
			if len(result) == 0:
				return "unknow"
			for row in result:
				if passwd == row.password:
					if row.weight<>0:
						return "nouser"
					else:
						returnstring=row.name
						returnstring+="|"
						result2 = db.query("SELECT * FROM `user_type` WHERE `id`=$type", vars={"type":row.type})
						for row2 in result2:
							returnstring+=row2.name
						return returnstring
				else:
					return "unknow"
urls = ('','login')
app_client = web.application(urls, globals())