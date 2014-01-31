'''
Created on 04/10/2013

@author: jdsantana
'''

from _pyio import __metaclass__
from Common.Singleton import Singleton
from configobj import ConfigObj

class Configuration():
    __metaclass__ = Singleton

    def __init__(self, configuration='engine.conf'):
        self.__config = ConfigObj(configuration)

        '''
        Engine Configuration
        '''
        self.__engine_host = self.__config['engine']['host']
        self.__engine_port = self.__config['engine']['port']

        '''
        AppWeb Configuration
        '''
        self.__webApp_host = self.__config['web_app']['host']
        self.__webApp_port = self.__config['web_app']['port']

        '''
        DB Configuration
        '''
        self.__db_host = self.__config['db']['host']
        self.__db_port = self.__config['db']['port']
        self.__db_user = self.__config['db']['user']
        self.__db_password = self.__config['db']['password']

    def getEngineHost(self):
        return self.__engine_host

    def getEnginePort(self):
        return int(self.__engine_port)

    def getWebAppHost(self):
        return self.__webApp_host

    def getWebAppPort(self):
        return int(self.__webApp_port)

    def getDBHost(self):
        return self.__db_host

    def getDBPort(self):
        return self.__db_port

    def getDBUser(self):
        return self.__db_user

    def getDBPassword(self):
        return self.__db_password

    def setDBConfiguration(self, configuration):
        self.__config['db'] = {
          'host' : configuration['db']['host'],
          'port' : configuration['db']['port'],
          'user' : configuration['db']['user'],
          'password' : configuration['db']['password']
        }

        self.__config.write()