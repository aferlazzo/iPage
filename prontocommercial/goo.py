import urllib

urllib.urlretrieve("http://www.google.com/", "somefile.html", lambda x,y,z:0, urllib.urlencode({"username": "aferlazzo@gmail.com", "password": "1commguru"}))
