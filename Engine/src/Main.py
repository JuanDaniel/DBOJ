# -*- coding: utf-8 -*-
#!/usr/bin/python
'''
Created on 28/01/2014

@author: jdsantana
'''

from Common.Configuration import Configuration
from Common.Socket import Socket

if __name__ == '__main__':
    '''
    Load configuration
    '''
    config = Configuration()

    '''
    Load Socket connection
    '''
    socket = Socket(config.getEngineHost(), config.getEnginePort())
    socket.run()
