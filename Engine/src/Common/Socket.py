# -*- coding: utf-8 -*-
#!/usr/bin/python
'''
Created on 02/10/2013

@author: jdsantana
'''

import socket
from Common.Recived import Recived

class Socket():

    def __init__(self, host='127.0.0.1', port=8080):
        self.__host = host
        self.__port = port

    def run(self):
        s = socket.socket()
        s.bind((self.__host, self.__port))

        while True:
            s.listen(1)

            sc, (host_c, puerto_c) = s.accept()

            try:
                print 'Conected to %s' %host_c

                recived = Recived(sc.recv(1024))
                action = recived.getAction()
                sc.send(action.run())
            except Exception, ex:
                print 'Invalid petition from %r\n The server responsed:\n %s' % (host_c, ex)
            print "close connection"
            sc.close()

        s.close()