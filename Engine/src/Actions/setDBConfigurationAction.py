'''
Created on 29/01/2014

@author: jdsantana
'''
from Actions.InterfaceAction import InterfaceAction
from Common.Configuration import Configuration

class setDBConfigurationAction(InterfaceAction):

    def __init__(self, configuration):
        self.__configuration = configuration

    def execute(self):
        config = Configuration()
        config.setDBConfiguration(self.__configuration)
