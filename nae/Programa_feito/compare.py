#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import sys
import xlrd
import pandas as pd
import unidecode
from itertools import islice


param = sys.argv[1:]
nae = param[0]
nti = param[1]
aba = param[2]

data_frame = pd.read_excel(nae,sheet_name=str(aba),skiprows=[0])

'''for i in data_frame['NOME']:
	print(i.lower())'''

file = open(nti,"r")
lista_completa = file.readlines()
nao_consta=[]

num=0
for i in lista_completa:
	num=num+1
	nao_existe=False
	for j in data_frame['NOME']:
		#print(type(j))
		try:
			nti = unidecode.unidecode(i)
			nae = unidecode.unidecode(j)
			if nti.replace('\n','').lower() == nae.lower():
				nao_existe=False
				break
			else:
				nao_existe=True
		except:
			pass
	if nao_existe==True:
		nao_consta.append([i.replace('\n','').lower(),num])

for i in range(0,len(nao_consta)):
	print(str(nao_consta[i])+"<br>")
print(len(nao_consta))
