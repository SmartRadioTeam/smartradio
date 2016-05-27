import trace
redis_connect = redis.Redis(host='127.0.0.1', port=6379, db=0)
keylist = redis_connect.keys()
for key in keylist:
    redis_connect[key]=Get163music(key)
    redis_connect.save()