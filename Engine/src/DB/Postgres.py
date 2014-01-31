'''
Created on 30/01/2014

@author: jdsantana
'''
from DB.InterfaceBD import InterfaceDB
import psycopg2

class Postgres(InterfaceDB):

    def __init__(self, host, port, user, password):
        self.__host = host
        self.__port = port
        self.__user = user
        self.__password = password
        self.__con = None
        self.__cursor = None

    def connect(self, database=None):
        self.__con = psycopg2.connect(host=self.__host, port=self.__port, user=self.__user, password=self.__password, database=database)
        self.__cursor = self.__con.cursor()

    def close(self):
        self.__con.close()

    def checkDB(self, db):
        if not self.__cursor:
            raise Exception('No database connet open')

        self.__cursor.execute("SELECT datname FROM pg_database WHERE datname = '%s';" %db)

        result = self.__cursor.fetchone()

        if result:
            return True

        return False

    def createDB(self, db, schema=None):
        self.__con.set_isolation_level(0)

        print 'Creating the database %s' %db
        self.__cursor.execute("CREATE DATABASE %s;" %db)

        self.__con.set_isolation_level(1)
        self.close()

        self.connect(db)
        if schema:
            self.__con.set_isolation_level(0)

            print 'Creating the schema'
            self.__cursor.execute(schema)

            print 'Creating the compare function'
            self.__createCompareFunction()

            self.__con.set_isolation_level(1)

    def execute(self, sql):
        try:
            result = self.__cursor.execute(sql)
            self.__cursor.commit()

            return True
        except psycopg2.DatabaseError, e:
            print e
            if self.__con:
                self.__con.rollback()

            return False

    def __createCompareFunction(self):
        file = open('compare.sql')
        sql = file.read()

        self.execute(sql)
