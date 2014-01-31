'''
Created on 30/01/2014

@author: jdsantana
'''
from Actions.InterfaceAction import InterfaceAction
from Common.Configuration import Configuration
from DB.Postgres import Postgres
from Execute.qualifieldThread import qualifieldThread

class qualifieldAction(InterfaceAction):

    def __init__(self, parameters):
        self.__parameters = parameters
        self.__config = Configuration()

    def run(self):
        thread = qualifieldThread(self.__getManager(), self.__parameters)
        thread.start()

        return 'OK'

    def __getManager(self):
        if self.__parameters['language'] == 'plpgsql':
            return Postgres(self.__config.getDBHost(), self.__config.getDBPort(), self.__config.getDBUser(), self.__config.getDBPassword())
