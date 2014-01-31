'''
Created on 31/01/2014

@author: jdsantana
'''

from httplib import HTTPConnection
from Common.Configuration import Configuration
import urllib

class Request:

    def __init__(self):
        self.__config = Configuration()

    def send(self, action, parameters):
        server = HTTPConnection(host=self.__config.getWebAppHost(), port=self.__config.getWebAppPort(), timeout=5)

        print "Sending: '%s' to %s:%s" % (action, self.__config.getWebAppHost(), self.__config.getWebAppPort())

        arguments = urllib.urlencode({'action': action, 'parameters': parameters})
        headers = {"Content-type": "application/x-www-form-urlencoded", "Accept": "text/plain"}

        server.request("POST", '/comunication/', arguments, headers)

        return server.getresponse()
