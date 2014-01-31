'''
Created on 30/01/2014

@author: jdsantana
'''

import threading
import time
from Common.Request import Request
import json

class qualifieldThread(threading.Thread):

    def __init__(self, dbManager, parameters):
        threading.Thread.__init__(self)
        self.__dbManager = dbManager
        self.__parameters = parameters

    def run(self):
        '''
        Check if the DB exists
        '''
        self.__dbManager.connect()
        if not self.__dbManager.checkDB(self.__parameters['db']):
            '''
            Get the schema
            '''
            request = Request()
            schema  = request.send('getSchema', {'id': self.__parameters['idProblema']}).read()

            schema = json.loads(schema)

            self.__dbManager.createDB(self.__parameters['db'], schema['schema'])

        if self.__dbManager.execute("SELECT compare('%s', '%s')" %(self.__parameters['sqlUser'], self.__parameters['sqlSolution'])):
            qualifield = 'Aceptado'
        else:
            qualifield = 'Incorrecto'
        request = Request()
        response = request.send('setResultSending', {'id': self.__parameters['id'], 'qualifield': qualifield}).read()

        print response

        #time.sleep(60)

        print 'Termine'
