'''
Created on 02/10/2013

@author: jdsantana
'''

import json
from Actions.qualifieldAction import qualifieldAction

class Recived():

    def __init__(self, data):
        jdata = json.loads(data)

        self.__action = jdata['action']

        self.__createAction(jdata['parameters'])

    def __createAction(self, parameters):
        if(self.__action == 'qualifield'):
            print parameters
            self.__action = qualifieldAction(parameters)
        else:
            raise Exception('The action is not valid')

    def getAction(self):
        return self.__action


