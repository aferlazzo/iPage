#
# in order to test that the form works 'automagically' let's try writing a bot in python

import urllib
import urllib2

url = 'http://prontocommercial.com/FundingRequest.php'

user_agent = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT)'

values = {
# FullName, Phone, Skype, Email, Amount, SwiftType, LengthBox,  Comments, Captcha
'FullName' : 'Robbie Robot', 'Phone' : '123-456-7899', 'Skype' : 'skype.address',
'Email' : 'robbie@hardwareworld.net', 'Amount' : '9,876,543,210,000',
'SwiftType' : 'MT760', 'LengthBox' : '1',
'Comments' : 'This is your neighborhood bot',
'Captcha' : 'zzzzzz'
 }
headers = { 'User-Agent' : user_agent }

data = urllib.urlencode(values)
req = urllib2.Request(url, data)
response = urllib2.urlopen(req)
the_page = response.read()

# now send the submit button


