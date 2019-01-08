#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import sys
import find_names as fn 
param = sys.argv[1:]

filename = param[0]

def converter(filename):
	if fn.convert_and_extract(filename) == True:
		return True

converter(filename)
