'''
Created on 30/01/2014

@author: jdsantana
'''

class InterfaceDB:

    def __init__(self, host, port, user, password):
        self.__host = host
        self.__port = port
        self.__user = user
        self.__password = password

    def connect(self):
        raise NotImplementedError('No implemented yet')

    def execute(self, sql):
        raise NotImplementedError('No implemented yet')

    def checkDB(self, db):
        raise NotImplementedError('No implemented yet')

    def createDB(self, db, schema):
        raise NotImplementedError('No implemented yet')


