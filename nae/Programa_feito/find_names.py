# -*- coding: utf-8 -*-

import re
from tabula import convert_into

def get_nome(palavra,cont):
     resultado = re.findall("{0} [a-zA-Z\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+,,,".format(cont),palavra)
     if len(resultado) > 0 and len(resultado[0]) <= len(palavra):
             return re.findall("{0} ([a-zA-Z\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+),,,".format(cont),palavra)[0]
     else:
             return None

def get_name_list(lista_completa, maximo_nomes):
	cont_lista = 0
	cont_nomes = 1
	lista_nomes = []
	while(cont_nomes<=maximo_nomes and cont_lista < len(lista_completa)):
		response = get_nome(lista_completa[cont_lista], cont_nomes)
		if response:
			lista_nomes.append(response)
			cont_nomes+=1

		cont_lista+=1

	return lista_nomes

def convert_and_extract(arquivo):
	convert_into(str(arquivo), "convertido.csv", output_format="csv", pages="all")

	file = open("convertido.csv","r",encoding='utf-8')
	lista_completa = file.readlines()
	lista_nomes = get_name_list(lista_completa,len(lista_completa))

	with open('nomes_extraidos.csv', 'w') as f:
		f.writelines([d+'\n' for d in lista_nomes])
		f.close()
		return True
	
